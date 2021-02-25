<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskList extends Component
{
    public function render()
    {
        // $tasks = Task::select('name', 'due_date', 'created_at')->with(['creator_user_id','assigned_user_id'])->get();
        $tasks = Task::with(['creator_user','assigned_user'])->get();
        // dd($tasks);
        return view('livewire.task-list', compact('tasks'));
    }
}
