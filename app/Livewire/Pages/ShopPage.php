<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ShopPage extends Component
{
    #[Layout('layouts.app')]
    #[Title('Shop')]
    public function render()
    {
        return view('livewire.pages.shop-page');
    }
}
