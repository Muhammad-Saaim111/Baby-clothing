<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\AbandonedCart;

class Marketing extends Component
{
    public function render()
    {
        $funnels = AbandonedCart::orderBy('updated_at', 'desc')->get();
        return view('livewire.admin.marketing', compact('funnels'))->layout('layouts.admin');
    }
}
