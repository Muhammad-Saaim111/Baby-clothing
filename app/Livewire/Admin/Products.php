<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Products extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isModalOpen = false;
    public $productId, $name, $price, $old_price, $description, $category, $subcategory, $stock;
    public $image_path, $new_image;
    public $new_back_image, $new_lifestyle_image, $back_image_path, $lifestyle_image_path;
    public $is_active = true;
    public $sizes = [];
    public $features = '[]';

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'old_price' => 'nullable|numeric|min:0',
        'description' => 'required|string',
        'category' => 'required|string|max:255',
        'subcategory' => 'nullable|string|max:255',
        'stock' => 'required|integer|min:0',
        'is_active' => 'boolean',
        'new_image' => 'nullable|image|max:2048',
        'new_back_image' => 'nullable|image|max:2048',
        'new_lifestyle_image' => 'nullable|image|max:2048',
    ];

    public function render()
    {
        $products = \App\Models\Product::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.products', compact('products'))->layout('layouts.admin');
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
        $this->productId = null;
        $this->name = '';
        $this->price = '';
        $this->old_price = '';
        $this->description = '';
        $this->category = '';
        $this->subcategory = '';
        $this->stock = 0;
        $this->image_path = null;
        $this->new_image = null;
        $this->new_back_image = null;
        $this->new_lifestyle_image = null;
        $this->back_image_path = null;
        $this->lifestyle_image_path = null;
        $this->is_active = true;
        $this->sizes = [];
    }

    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $this->productId = $id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->old_price = $product->old_price;
        $this->description = $product->description;
        $this->category = $product->category;
        $this->subcategory = $product->subcategory;
        $this->stock = $product->stock;
        $this->image_path = $product->image_path;
        $this->is_active = $product->is_active;
        $this->sizes = is_array($product->sizes) ? $product->sizes : (json_decode($product->sizes, true) ?: []);
        
        // Infer back and lifestyle images
        $this->back_image_path = null;
        $this->lifestyle_image_path = null;
        if ($product->image_path && str_contains($product->image_path, '_front.jpg')) {
            $base = basename($product->image_path);
            $backBase = str_replace('_front.jpg', '_back.jpg', $base);
            $lifestyleBase = str_replace('_front.jpg', '_lifestyle.jpg', $base);
            
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists('products/' . $backBase)) {
                $this->back_image_path = '/storage/products/' . $backBase;
            }
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists('products/' . $lifestyleBase)) {
                $this->lifestyle_image_path = '/storage/products/' . $lifestyleBase;
            }
        }

        $this->isModalOpen = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'description' => $this->description,
            'category' => $this->category,
            'subcategory' => $this->subcategory,
            'stock' => $this->stock,
            'is_active' => $this->is_active,
            'sizes' => $this->sizes,
            'features' => json_decode($this->features)
        ];

        // Determine base name for images
        $baseName = '';
        if ($this->image_path) {
            $baseName = pathinfo(basename($this->image_path), PATHINFO_FILENAME);
            if (str_ends_with($baseName, '_front')) {
                $baseName = substr($baseName, 0, -6);
            }
        } else {
            $baseName = time() . '_' . uniqid();
        }

        if ($this->new_image) {
            $this->new_image->storeAs('products', $baseName . '_front.jpg', 'public');
            $data['image_path'] = '/storage/products/' . $baseName . '_front.jpg';
            $this->image_path = $data['image_path'];
        } elseif (!$this->productId) {
            $this->addError('new_image', 'Front view image is required for new products.');
            return;
        } elseif (($this->new_back_image || $this->new_lifestyle_image) && $this->image_path && !str_contains($this->image_path, '_front.jpg')) {
            // Existing product, uploading back/lifestyle, but main image lacks _front.jpg!
            // We must copy it to the _front.jpg convention so the storefront and backend can link them.
            $newPath = 'products/' . $baseName . '_front.jpg';
            $success = false;
            
            if (str_starts_with($this->image_path, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $this->image_path);
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($oldPath)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->copy($oldPath, $newPath);
                    $success = true;
                }
            } else {
                $absPath = public_path(ltrim($this->image_path, '/'));
                if (file_exists($absPath)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->put($newPath, file_get_contents($absPath));
                    $success = true;
                }
            }
            
            if ($success) {
                $data['image_path'] = '/storage/' . $newPath;
                $this->image_path = $data['image_path'];
            }
        }

        if ($this->new_back_image) {
            $this->new_back_image->storeAs('products', $baseName . '_back.jpg', 'public');
        }

        if ($this->new_lifestyle_image) {
            $this->new_lifestyle_image->storeAs('products', $baseName . '_lifestyle.jpg', 'public');
        }

        \App\Models\Product::updateOrCreate(['id' => $this->productId], $data);
        
        session()->flash('message', $this->productId ? 'Product Updated Successfully.' : 'Product Created Successfully.');
        $this->closeModal();
    }

    public function toggleActive($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->update(['is_active' => !$product->is_active]);
        session()->flash('message', 'Product status updated.');
    }
}
