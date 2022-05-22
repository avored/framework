<?php

namespace AvoRed\Framework\System\Components\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ProductImage extends Component
{
    use WithFileUploads;

    public $images;

    public function uploadImages()
    {
        $this->validate([
            'images.*' => 'image|max:10240', // 10MB Max
        ]);
    }

    public function render()
    {
        return view('avored::catalog.product.livewire.images');
    }
}
