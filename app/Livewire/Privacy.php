<?php

namespace App\Livewire;

use Livewire\Component;

class Privacy extends Component
{
    public function render()
    {
        return view('livewire.privacy')
            ->layout('components.layouts.app', ['title' => __('sites/legal.privacy.tab_title')]);
    }
}
