<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class Reviews extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $replyingTo = null;
    public $replyContent = '';

    public function render()
    {
        $reviews = \App\Models\Review::with(['user', 'product'])->orderBy('created_at', 'desc')->paginate(15);
        return view('livewire.admin.reviews', compact('reviews'))->layout('layouts.admin');
    }

    public function updateStatus($reviewId, $status)
    {
        $review = \App\Models\Review::findOrFail($reviewId);
        $review->update(['status' => $status]);
        session()->flash('message', "Review status updated to {$status}.");
    }

    public function initiateReply($reviewId)
    {
        $this->replyingTo = $reviewId;
        $review = \App\Models\Review::findOrFail($reviewId);
        $this->replyContent = $review->admin_reply ?? '';
    }

    public function saveReply()
    {
        $review = \App\Models\Review::findOrFail($this->replyingTo);
        $review->update(['admin_reply' => $this->replyContent]);
        $this->replyingTo = null;
        $this->replyContent = '';
        session()->flash('message', 'Admin reply saved successfully.');
    }

    public function cancelReply()
    {
        $this->replyingTo = null;
        $this->replyContent = '';
    }
}
