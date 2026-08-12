<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductReviews extends Component
{
    use WithPagination;

    public $product;
    public $filterRating = null;

    protected $listeners = ['reviewSubmitted' => '$refresh'];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function setFilter($rating)
    {
        $this->filterRating = $rating;
        $this->resetPage();
    }

    public function render()
    {
        $query = $this->product->reviews()->where('status', 'approved')->latest();

        if ($this->filterRating) {
            $query->where('rating', $this->filterRating);
        }

        $reviews = $query->paginate(5);
        $totalReviews = $this->product->reviews()->where('status', 'approved')->count();
        $averageRating = $this->product->reviews()->where('status', 'approved')->avg('rating') ?? 0;

        // Calculate rating distribution
        $distribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $this->product->reviews()->where('status', 'approved')->where('rating', $i)->count();
            $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
            $distribution[$i] = [
                'count' => $count,
                'percentage' => $percentage
            ];
        }

        return view('livewire.product-reviews', [
            'reviews' => $reviews,
            'totalReviews' => $totalReviews,
            'averageRating' => round($averageRating, 1),
            'distribution' => $distribution,
        ]);
    }
}
