<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CartGreedyDiscountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $couponCode;
    public $discountPercent;

    public function __construct($cart, $couponCode, $discountPercent)
    {
        $this->cart = $cart;
        $this->couponCode = $couponCode;
        $this->discountPercent = $discountPercent;
    }

    public function build()
    {
        return $this->subject("Wait! Take {$this->discountPercent}% OFF your cart!")
                    ->view('emails.cart_greedy_discount');
    }
}
