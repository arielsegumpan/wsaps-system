<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ContactPage extends Component
{
    #[Layout('layouts.app')]
    #[Title('Contact')]
    public function render()
    {
        return view('livewire.pages.contact-page');
    }
}
