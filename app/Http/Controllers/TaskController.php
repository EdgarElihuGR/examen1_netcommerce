<?php

namespace App\Http\Controllers;

use App\Models\{Task, User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
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

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
