<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $icon;
    public $url;
    public $active;

    public function __construct($name, $icon, $url)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->url = $url;
        $this->active = request()->is(trim($url, '/'));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-item');
    }
}
