<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    #[Layout('layouts.app')]
    #[Title('Home')]
    public function render()
    {
        return view('livewire.pages.home-page');
    }
}
