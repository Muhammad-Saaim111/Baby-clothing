<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ReviewInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $product;
    public $reviewUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, Product $product)
    {
        $this->order = $order;
        $this->product = $product;
        
        // Generate signed URL valid for 30 days
        $this->reviewUrl = URL::temporarySignedRoute(
            'review.create', now()->addDays(30), [
                'product' => $product->id,
                'order_id' => $order->id,
            ]
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'How did you like ' . $this->product->name . '?',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.review-invitation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

