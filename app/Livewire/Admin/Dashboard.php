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

        // Calculate pending & low stock stats
        $pendingOrders = \App\Models\Order::whereIn('status', ['pending', 'processing'])->count();
        $lowStockCount = \App\Models\Product::where('stock', '<', 5)->count();
        $lowStockProducts = \App\Models\Product::where('stock', '<', 5)->take(5)->get();

        // Get 30-day trends for Chart.js
        $trends = \App\Models\Order::where('status', '!=', 'cancelled')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, SUM(total) as sales, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Get Top 5 Selling Products
        $topProducts = \App\Models\OrderItem::with('product')
            ->selectRaw('product_id, product_name, SUM(quantity) as qty_sold, SUM(price * quantity) as revenue')
            ->groupBy('product_id', 'product_name')
            ->orderBy('qty_sold', 'desc')
            ->take(5)
            ->get();

        return view('livewire.admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'totalCustomers',
            'pendingOrders',
            'lowStockCount',
            'lowStockProducts',
            'trends',
            'topProducts',
            'recentOrders'
        ))->layout('layouts.admin');
    }
}
