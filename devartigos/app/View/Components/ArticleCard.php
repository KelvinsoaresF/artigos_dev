<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleCard extends Component
{

    public $title;
    public $content;
    public $author;
    public $developers;
    public $showReadMore;
    public $readMoreUrl;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title,
        $content,
        $author = null,
        $developers = [],
        $showReadMore = false,
        $readMoreUrl = '#'
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->developers = $developers;
        $this->showReadMore = $showReadMore;
        $this->readMoreUrl = $readMoreUrl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article-card');
    }
}
