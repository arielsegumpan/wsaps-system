<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use WithPagination;

    public $products;
    public function getShopProduct() {
        $this->products = Product::with([
            'productImages' => function ($query) {
                $query->limit(1);
            },
            'brand:id,brand_name',
            'productCategories:id,prod_cat_name,prod_cat_slug'
        ])->orderBy('created_at', 'asc')->get();
    }


    #[Layout('layouts.app')]
    #[Title('Shop')]
    public function render()
    {

        $this->getShopProduct();
        return view('livewire.pages.shop-page', [
            'products' => $this->products
        ]);
    }
}
