<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class BlogSinglePage extends Component
{
    #[Layout('layouts.app')]
    #[Title('Blog Single')]
    public function render()
    {
        return view('livewire.pages.blog-single-page');
    }
}
