<?php

namespace Tadcms\Backend\Livewire\Theme;

use Livewire\Component;
use Theanh\MultiTheme\Facades\Theme;

class ThemeList extends Component
{
    public $themes = [];
    
    public function loadThemes()
    {
        $this->themes = Theme::all();
    }
    
    public function render()
    {
        return view('tadcms::livewire.theme.theme-list');
    }
}
