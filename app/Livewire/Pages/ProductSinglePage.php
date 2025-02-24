<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class ProductSinglePage extends Component
{

    public $prod_slug;
    public $prod_single;
    public function mount($prod_slug)
    {
        $this->prod_single = Product::with([
            'productImages',
            'brand:id,brand_name',
            'productCategories' => function($query) {
                $query->where('is_visible', 1); // Ensures only visible categories are retrieved
            }
        ])
        ->where('prod_slug', $prod_slug)
        ->first();
    }

    #[Layout('layouts.app')]
    #[Title('Shop')]
    public function render()
    {
        return view('livewire.pages.shop-page-single',[
            'product' => $this->prod_single
        ]);
    }
}
