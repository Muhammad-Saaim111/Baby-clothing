<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        // Calculate basic stats
        $totalSales = \App\Models\Order::where('status', '!=', 'cancelled')->sum('total');
        $totalOrders = \App\Models\Order::count();
        $totalCustomers = \App\Models\User::where('is_admin', false)->count();
        $recentOrders = \App\Models\Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();

        return view('livewire.admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'totalCustomers',
            'recentOrders'
        ))->layout('layouts.admin');
    }
}
