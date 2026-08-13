<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $viewingOrder = null;
    public $isViewModalOpen = false;

    public function render()
    {
        $orders = \App\Models\Order::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('livewire.admin.orders', compact('orders'))->layout('layouts.admin');
    }

    public function openViewModal($id)
    {
        $this->viewingOrder = \App\Models\Order::with(['user', 'items.product', 'coupon'])->findOrFail($id);
        $this->isViewModalOpen = true;
    }

    public function closeViewModal()
    {
        $this->isViewModalOpen = false;
        $this->viewingOrder = null;
    }

    public function updateStatus($orderId, $status)
    {
        $order = \App\Models\Order::findOrFail($orderId);
        $order->update(['status' => $status]);
        session()->flash('message', 'Order status updated successfully.');
        
        if ($this->viewingOrder && $this->viewingOrder->id == $orderId) {
            $this->viewingOrder->status = $status;
        }
    }
}
