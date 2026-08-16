<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Deal;

class Deals extends Component
{
    use WithFileUploads;

    public $deals;
    
    // Edit Form State
    public $edit_id;
    public $edit_discount;
    public $edit_title;
    public $edit_description;
    public $edit_image; // for new uploaded image
    public $current_image_path;

    public $isEditModalOpen = false;

    public function mount()
    {
        $this->loadDeals();
    }

    public function loadDeals()
    {
        $this->deals = Deal::all();
    }

    public function editDeal($id)
    {
        $deal = Deal::findOrFail($id);
        $this->edit_id = $deal->id;
        $this->edit_discount = $deal->discount;
        $this->edit_title = $deal->title;
        $this->edit_description = $deal->description;
        $this->current_image_path = $deal->image_path;
        
        $this->isEditModalOpen = true;
    }

    public function closeEditModal()
    {
        $this->isEditModalOpen = false;
        $this->reset(['edit_id', 'edit_discount', 'edit_title', 'edit_description', 'edit_image', 'current_image_path']);
    }

    public function updateDeal()
    {
        $this->validate([
            'edit_discount' => 'required|string|max:50',
            'edit_title' => 'required|string|max:255',
            'edit_description' => 'required|string',
            'edit_image' => 'nullable|image|max:10240',
        ]);

        $deal = Deal::findOrFail($this->edit_id);
        $deal->discount = $this->edit_discount;
        $deal->title = $this->edit_title;
        $deal->description = $this->edit_description;

        if ($this->edit_image) {
            $filename = 'deal_' . time() . '.' . $this->edit_image->getClientOriginalExtension();
            $this->edit_image->move(public_path('assets/images/deals'), $filename);
            $deal->image_path = 'assets/images/deals/' . $filename;
        }

        $deal->save();

        session()->flash('success', 'Deal updated successfully.');
        
        $this->loadDeals();
        $this->closeEditModal();
    }

    public function render()
    {
        return view('livewire.admin.deals')->layout('layouts.admin');
    }
}
