<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home')
            ->layout('components.layouts.app', ['title' => __('sites/home.tab_title')]);
    }
}
