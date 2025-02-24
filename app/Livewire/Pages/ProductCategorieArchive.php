<?php

namespace App\Livewire\Pages;

use App\Models\ProductCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductCategorieArchive extends Component
{
    public $getProductCategories;

    public function mount($prod_cat_slug)
    {
        $this->getProductCategories = ProductCategory::with([
            'products','products.productImages', 'products.brand:id,brand_name'
        ])->where('prod_cat_slug', $prod_cat_slug)->where('is_visible', 1)->first();
    }

    #[Layout('layouts.app')]
    #[Title('Shop')]
    public function render()
    {
        return view('livewire.pages.product-categorie-archive',[
            'productCategories' => $this->getProductCategories
        ]);
    }
}
