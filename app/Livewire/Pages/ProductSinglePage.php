<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductSinglePage extends Component
{

    #[Layout('layouts.app')]
    #[Title('Product Single')]
    public function render()
    {
        return view('livewire.pages.product-single-page');
    }
}
