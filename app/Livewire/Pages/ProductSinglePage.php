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
    public $related_products;
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

        if ($this->prod_single) {
            $this->getRelatedProducts();
        }
    }

    private function getRelatedProducts()
    {
        // Get category IDs of the current product
        $categoryIds = $this->prod_single->productCategories->pluck('id')->toArray();

        $this->related_products = Product::with(['productImages', 'brand:id,brand_name'])
            ->whereHas('productCategories', function ($query) use ($categoryIds) {
                $query->whereIn('product_categories.id', $categoryIds); // Ensure correct table alias if needed
            })
            ->where('id', '!=', $this->prod_single->id) // Exclude current product
            ->limit(6) // Get a limited number of related products
            ->get();
    }

    #[Layout('layouts.app')]
    #[Title('Shop')]
    public function render()
    {

        // dd($this->related_products);
        return view('livewire.pages.product-single-page',[
            'product' => $this->prod_single,
            'related_products' => $this->related_products
        ]);
    }
}
