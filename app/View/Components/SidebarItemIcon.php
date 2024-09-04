<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarItemIcon extends Component
{
    /**
     * Create a new component instance.
     */

    public $icon;
    public $active;
    public $url;

    public function __construct($icon, $url)
    {
        $this->icon = $icon;
        $currentUrl = request()->path();
        $basePath = trim($url, '/');
        $this->active = $currentUrl === $basePath || str_starts_with($currentUrl, $basePath . '/');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-item-icon');
    }
}
