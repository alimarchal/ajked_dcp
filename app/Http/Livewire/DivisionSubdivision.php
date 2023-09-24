<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DivisionSubdivision extends Component
{

    public $division = null;
    public $subdivision = null;
    public $branchname = null;

    public function render()
    {
        return view('livewire.division-subdivision');
    }
}
