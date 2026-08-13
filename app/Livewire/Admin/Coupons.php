<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class Coupons extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isModalOpen = false;
    public $couponId, $code, $type = 'percentage', $value, $min_order_amount = 0, $max_uses, $expires_at;
    public $is_active = true;

    protected $rules = [
        'code' => 'required|string|max:50',
        'type' => 'required|in:percentage,fixed',
        'value' => 'required|numeric|min:0',
        'min_order_amount' => 'required|numeric|min:0',
        'max_uses' => 'nullable|integer|min:1',
        'expires_at' => 'nullable|date',
        'is_active' => 'boolean',
    ];

    public function render()
    {
        $coupons = \App\Models\Coupon::orderBy('created_at', 'desc')->paginate(15);
        return view('livewire.admin.coupons', compact('coupons'))->layout('layouts.admin');
    }

    public function openModal()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->couponId = null;
        $this->code = strtoupper(\Illuminate\Support\Str::random(8));
        $this->type = 'percentage';
        $this->value = '';
        $this->min_order_amount = 0;
        $this->max_uses = null;
        $this->expires_at = null;
        $this->is_active = true;
    }

    public function edit($id)
    {
        $coupon = \App\Models\Coupon::findOrFail($id);
        $this->couponId = $id;
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->min_order_amount = $coupon->min_order_amount;
        $this->max_uses = $coupon->max_uses;
        $this->expires_at = $coupon->expires_at ? \Carbon\Carbon::parse($coupon->expires_at)->format('Y-m-d\TH:i') : null;
        $this->is_active = $coupon->is_active;
        
        $this->isModalOpen = true;
    }

    public function save()
    {
        // Unique validation rule for update/create
        $this->rules['code'] = 'required|string|max:50|unique:coupons,code' . ($this->couponId ? ',' . $this->couponId : '');
        $this->validate();

        \App\Models\Coupon::updateOrCreate(['id' => $this->couponId], [
            'code' => strtoupper($this->code),
            'type' => $this->type,
            'value' => $this->value,
            'min_order_amount' => $this->min_order_amount,
            'max_uses' => $this->max_uses ?: null,
            'expires_at' => $this->expires_at,
            'is_active' => $this->is_active,
        ]);
        
        session()->flash('message', $this->couponId ? 'Coupon Updated Successfully.' : 'Coupon Created Successfully.');
        $this->closeModal();
    }

    public function toggleActive($id)
    {
        $coupon = \App\Models\Coupon::findOrFail($id);
        $coupon->update(['is_active' => !$coupon->is_active]);
        session()->flash('message', 'Coupon status updated.');
    }
}
