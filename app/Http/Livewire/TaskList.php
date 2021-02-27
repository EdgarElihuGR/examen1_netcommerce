<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskList extends Component
{
    public function render()
    {
        $tasks = Task::with(['creator_user','assigned_user'])->get();
        return view('livewire.task-list', compact('tasks'));
    }
}
