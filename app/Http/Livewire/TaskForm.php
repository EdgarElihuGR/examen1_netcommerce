<?php

namespace App\Http\Livewire;

use \App\Models\User;
use Livewire\Component;

class TaskForm extends Component
{
    public function render()
    {
        $users = User::all();
        return view('livewire.task-form', compact('users'));
    }
}
