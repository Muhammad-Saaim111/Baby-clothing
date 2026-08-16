<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;

class Banners extends Component
{
    use WithFileUploads;

    public $homeBanner;
    public $boysBanner;
    public $girlsBanner;

    public function updateHomeBanner()
    {
        $this->validate([
            'homeBanner' => 'image|max:10240', // 10MB Max
        ]);

        $this->homeBanner->move(public_path('assets/images'), 'untitled_design.jpg');
        
        session()->flash('success', 'Home Banner updated successfully.');
        $this->reset('homeBanner');
    }

    public function updateBoysBanner()
    {
        $this->validate([
            'boysBanner' => 'image|max:15360', // 15MB Max due to high res
        ]);

        $this->boysBanner->move(public_path('assets/images'), 'Aimee_Boys_Banner_High_Quality.png');
        
        session()->flash('success', 'Little Boys Banner updated successfully.');
        $this->reset('boysBanner');
    }

    public function updateGirlsBanner()
    {
        $this->validate([
            'girlsBanner' => 'image|max:15360', // 15MB Max due to high res
        ]);

        $this->girlsBanner->move(public_path('assets/images'), 'Aimee_Girls_Banner_High_Quality.png');
        
        session()->flash('success', 'Little Girls Banner updated successfully.');
        $this->reset('girlsBanner');
    }

    public function render()
    {
        return view('livewire.admin.banners')->layout('layouts.admin');
    }
}
