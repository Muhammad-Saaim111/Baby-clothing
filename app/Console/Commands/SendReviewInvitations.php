<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\ReviewInvitationMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReviewInvitations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reviews:send-invitations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send review invitation emails for orders delivered 3-5 days ago';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find order items that are eligible for review, haven't been reviewed,
        // and belong to an order delivered between 3 and 5 days ago.
        
        $startDate = Carbon::now()->subDays(5)->startOfDay();
        $endDate = Carbon::now()->subDays(3)->endOfDay();

        $orderItems = OrderItem::where('is_eligible_for_review', true)
            ->where('is_reviewed', false)
            ->whereHas('order', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('delivered_at', [$startDate, $endDate]);
            })
            ->with(['order', 'product']) // Eager load
            ->get();

        $count = 0;
        foreach ($orderItems as $item) {
            if ($item->order && $item->product) {
                Mail::to($item->order->email)->send(new ReviewInvitationMail($item->order, $item->product));
                
                // Set eligible to false so we don't send again? Or just rely on dates.
                // Usually rely on dates is fine, or we can mark "invitation_sent". 
                // Let's rely on date window for now.
                
                $this->info('Sent review invitation to ' . $item->order->email . ' for product ' . $item->product->name);
                $count++;
            }
        }

        $this->info("Completed sending {$count} review invitations.");
    }
}

