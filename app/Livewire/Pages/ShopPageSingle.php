<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;

class ShopPageSingle extends Component
{

    public $prod_slug;
    public $prod_single;
    public function mount($prod_slug)
    {
        $this->prod_single = Product::with(['productImages','brand','productCategories'])
        ->where('prod_slug', $prod_slug)
        ->whereHas('productImages', function($query){
            $query->where('is_primary', 0);
        })
        ->whereHas('productCategories', function($query){
            $query->where('is_visible', true);
        })->first();
    }
    public function render()
    {
        dd($this->prod_single);
        return view('livewire.pages.shop-page-single',[
            'prod_single' => $this->prod_single
        ]);
    }
}
