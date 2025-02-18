<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class BlogPage extends Component
{
    #[Layout('layouts.app')]
    #[Title('Blog')]
    public function render()
    {
        return view('livewire.pages.blog-page');
    }
}
