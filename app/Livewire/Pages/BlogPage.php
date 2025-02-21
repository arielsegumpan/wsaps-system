<?php

namespace App\Livewire\Pages;

use App\Models\BlogPost;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class BlogPage extends Component
{
    public $posts;
    public function getBlogPost()
    {
        $this->posts = BlogPost::with('blogCategory:id,cat_name,cat_slug')
        ->where('is_visible', true)->orderBy('created_at', 'asc')->get();
    }
    #[Layout('layouts.app')]
    #[Title('Blog')]
    public function render()
    {
        $this->getBlogPost();
        return view('livewire.pages.blog-page',[
            'posts' => $this->posts
        ]);
    }
}
