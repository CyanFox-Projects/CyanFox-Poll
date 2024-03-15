<?php

namespace App\Livewire;

use Livewire\Component;

class Impress extends Component
{
    public function render()
    {
        return view('livewire.impress')
            ->layout('components.layouts.app', ['title' => __('sites/legal.impress.tab_title')]);
    }
}
