<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;

class SubmitReview extends Component
{
    use WithFileUploads;

    public $product;
    public $order;
    public $rating = 5;
    public $reviewer_name;
    public $reviewer_email;
    public $review_title;
    public $review_text;
    public $images = [];
    public $isSubmitted = false;
    public $errorMessage = '';

    public function mount(Product $product, $orderId = null)
    {
        $this->product = $product;
        
        if ($orderId) {
            $this->order = Order::find($orderId);
            if ($this->order) {
                $this->reviewer_name = $this->order->first_name . ' ' . $this->order->last_name;
                $this->reviewer_email = $this->order->email;
            }
        } else {
            // Check if logged in user has an order for this product
            if (auth()->check()) {
                $this->order = Order::where('user_id', auth()->id())
                    ->where('status', 'delivered')
                    ->whereHas('items', function ($query) use ($product) {
                        $query->where('product_id', $product->id)->where('is_reviewed', false);
                    })->first();

                if ($this->order) {
                    $this->reviewer_name = auth()->user()->name;
                    $this->reviewer_email = auth()->user()->email;
                }
            }
        }
    }

    public function setRating($val)
    {
        $this->rating = $val;
    }

    public function submit()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'reviewer_name' => 'required|string|max:255',
            'reviewer_email' => 'required|email|max:255',
            'review_title' => 'nullable|string|max:255',
            'review_text' => 'required|string|min:10',
            'images.*' => 'image|max:2048', // 2MB max per image
        ]);

        if (!$this->order) {
            $this->errorMessage = 'You must have a verified, delivered order to submit a review.';
            return;
        }

        // Check for duplicate review
        $existing = Review::where('order_id', $this->order->id)
                          ->where('product_id', $this->product->id)
                          ->first();
                          
        if ($existing) {
            $this->errorMessage = 'You have already reviewed this product for this order.';
            return;
        }

        $imagePaths = [];
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $imagePaths[] = $image->store('reviews', 'public');
            }
        }

        Review::create([
            'product_id' => $this->product->id,
            'user_id' => $this->order->user_id,
            'order_id' => $this->order->id,
            'rating' => $this->rating,
            'reviewer_name' => $this->reviewer_name,
            'reviewer_email' => $this->reviewer_email,
            'review_title' => $this->review_title,
            'review_text' => $this->review_text,
            'images' => empty($imagePaths) ? null : $imagePaths,
            'is_verified' => true,
            'status' => 'pending', // Requires admin approval
        ]);

        // Mark item as reviewed
        $orderItem = $this->order->items()->where('product_id', $this->product->id)->first();
        if ($orderItem) {
            $orderItem->update(['is_reviewed' => true]);
        }

        $this->isSubmitted = true;
        
        // Let the list component know if it's on the same page
        $this->dispatch('reviewSubmitted');
    }

    public function render()
    {
        return view('livewire.submit-review')->layout('layouts.app');
    }
}
