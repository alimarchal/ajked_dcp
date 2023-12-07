<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleBranch extends Component
{
    public $selectedRole = null;
    public $roles = null;
    public function render()
    {
        $this->roles = Role::pluck('name', 'id');
        return view('livewire.role-branch');
    }
}
