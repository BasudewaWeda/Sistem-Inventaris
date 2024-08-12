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
    public $isLogOut;

    public function __construct($name, $icon, $url, $isLogOut = false)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->url = $url;
        $this->isLogOut = $isLogOut;
        
        $currentUrl = request()->path();
        $basePath = trim($url, '/');
        $this->active = $currentUrl === $basePath || str_starts_with($currentUrl, $basePath . '/');

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-item');
    }
}
