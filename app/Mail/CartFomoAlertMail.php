<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CartFomoAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;

    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    public function build()
    {
        return $this->subject('Last Chance: Your items & discount expire soon!')
                    ->view('emails.cart_fomo_alert');
    }
}
