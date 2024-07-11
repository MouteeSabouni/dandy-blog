<?php

namespace App\Livewire;

use Livewire\Component;

class UserOptions extends Component
{
    public $expanded = false;

    public function toggleExpanded()
    {
        $this->expanded = !$this->expanded;
    }

    public function render()
    {
        return view('livewire.user-options');
    }
}
