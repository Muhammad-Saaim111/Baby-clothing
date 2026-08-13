<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AbandonedCart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RunCartFunnel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cart:funnel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the 3-step automated greedy marketing funnel for abandoned carts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Cart Funnel Check...');

        // Retrieve all active abandoned carts (even without emails)
        $carts = AbandonedCart::whereIn('funnel_step', [0, 1, 2, 3])
            ->whereNotNull('last_active_at')
            ->get();

        foreach ($carts as $cart) {
            $lastActive = Carbon::parse($cart->last_active_at);
            $hoursPassed = $lastActive->diffInMinutes(now()) / 60;

            // Step 1: Reminder (> 1 hour)
            if ($cart->funnel_step == 0 && $hoursPassed >= 1 && $hoursPassed < 2) {
                if ($cart->email) {
                    $this->info("Sending Step 1 (Reminder) to {$cart->email}");
                    Mail::to($cart->email)->send(new \App\Mail\CartReminderMail($cart));
                }
                $cart->funnel_step = 1;
                $cart->save();
            }

            // Step 2: Greedy Discount (> 2 hours)
            elseif ($cart->funnel_step == 1 && $hoursPassed >= 2 && $hoursPassed < 3) {
                if ($cart->email) {
                    $this->info("Sending Step 2 (Greedy Discount) to {$cart->email}");
                    
                    // --- GREEDY ALGORITHM ---
                    $itemsCount = 0;
                    if (is_array($cart->cart_data)) {
                        foreach ($cart->cart_data as $item) {
                            $itemsCount += ($item['quantity'] ?? 1);
                        }
                    }
                    
                    $discountPercent = 5;
                    if ($itemsCount == 2) {
                        $discountPercent = 10;
                    } elseif ($itemsCount >= 3 || $cart->total_value > 5000) {
                        $discountPercent = 15;
                    }

                    // Generate Unique Coupon
                    $couponCode = 'GREEDY' . $discountPercent . '-' . strtoupper(Str::random(5));
                    $coupon = Coupon::create([
                        'code' => $couponCode,
                        'type' => 'percentage',
                        'value' => $discountPercent,
                        'is_active' => true,
                        'usage_limit' => 1,
                        'used_count' => 0,
                        'expiry_date' => now()->addDays(3),
                    ]);

                    $cart->generated_coupon_id = $coupon->id;
                    Mail::to($cart->email)->send(new \App\Mail\CartGreedyDiscountMail($cart, $couponCode, $discountPercent));
                }
                
                $cart->funnel_step = 2;
                $cart->save();
            }

            // Step 3: FOMO Alert (> 3 hours)
            elseif ($cart->funnel_step == 2 && $hoursPassed >= 3 && $hoursPassed < 3.5) {
                if ($cart->email) {
                    $this->info("Sending Step 3 (FOMO Alert) to {$cart->email}");
                    Mail::to($cart->email)->send(new \App\Mail\CartFomoAlertMail($cart));
                }
                $cart->funnel_step = 3;
                $cart->save();
            }

            // Step 4: Cart Cleared (> 3.5 hours)
            elseif ($cart->funnel_step == 3 && $hoursPassed >= 3.5) {
                $identifier = $cart->email ?? "Guest User ({$cart->id})";
                $this->info("Step 4 (Clearing Cart) for {$identifier}");
                
                // Delete coupon if not used
                if ($cart->generated_coupon_id) {
                    $c = Coupon::find($cart->generated_coupon_id);
                    if ($c && $c->used_count == 0) {
                        $c->delete();
                    }
                }

                $cart->funnel_step = 4; // Cleared
                $cart->cart_data = null;
                $cart->save();
            }
        }

        $this->info('Cart Funnel Check Complete.');
    }
}
