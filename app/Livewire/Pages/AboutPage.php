<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class AboutPage extends Component
{
    #[Layout('layouts.app')]
    #[Title('About')]
    public function render()
    {
        return view('livewire.pages.about-page');
    }
}
