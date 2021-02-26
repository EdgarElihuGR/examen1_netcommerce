<?php

namespace App\Http\Controllers;

use App\Models\{Task, User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tasks');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Declaration of vars in order to use the same form template
        $task = new Task;
        $title = "Nueva Tarea";
        $txtButton = "Agregar";
        $route = route('tasks.store');
        $users = User::all();
        return view('create-task', compact('task','title','txtButton','route','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'start_date' => 'required|date|after_or_equal:yesterday',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        //Save validated fields to task
        $task = new Task;
        $task->name = $validated['name'];
        $task->start_date = $validated['start_date'];
        $task->end_date = $validated['end_date'];

        //Save related users to task
        $loggedUserId = Auth::id();
        $creator_user = User::find($loggedUserId);
        $assigned_user = User::find($request->assigned_user);
        $task->creator_user()->associate($creator_user);
        $task->assigned_user()->associate($assigned_user);

        $task->save();

        return view('tasks');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //Declaration of vars in order to use the same form template
        $update = true;
        $title = "Actualizar Tarea";
        $txtButton = "Actualizar";
        $route = route('tasks.update',['task' => $task]);
        $users = User::all();
        return view('edit-task', compact('task','title','txtButton','route','users','update'));
    }

    //Get the specified resource
    public function getTask($id)
    {
        $task = Task::find($id);

        return response()->json(['status' => 'success', 'task' => 'task']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'name' => 'required|max:100|unique:tasks,name,' . $task->id,
            'start_date' => 'required|date|after_or_equal:yesterday',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // $validated = $request->validate([
        //     'name' => 'required|max:100',
        //     'start_date' => 'required|date|after_or_equal:yesterday',
        //     'end_date' => 'required|date|after_or_equal:start_date',
        // ]);

        //Update task's fields
        $task->name = $request->name;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;

        //Save related users to task
        $assigned_user = User::find($request->assigned_user);
        $task->assigned_user()->associate($assigned_user);

        $task->save();

        return view('tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return back();
    }
}
