<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $customers = \App\Models\User::where('is_admin', false)
            ->withCount('orders')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('livewire.admin.customers', compact('customers'))->layout('layouts.admin');
    }

    public function toggleBlock($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Prevent blocking admins
        if ($user->is_admin) {
            session()->flash('error', 'Cannot block an admin user.');
            return;
        }
        
        $user->update(['is_blocked' => !$user->is_blocked]);
        session()->flash('message', 'User status updated successfully.');
    }
}
