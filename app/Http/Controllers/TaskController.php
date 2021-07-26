<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = User::find(auth()->user()->id)->tasks;

        return response()->json(['data' => $tasks, 'access_token' => $request->bearerToken()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
        
        $task = new Task();
        $task->description = $request->description;
        $task->completed = $request->completed ?? false;
        $task->user_id = auth()->user()->id;
        $task->save();
            
        return response()->json(['data' => $task, 'access_token' => $request->bearerToken()], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $task = User::find(auth()->user()->id)->tasks->where('id', '=', $id)->first();

        if (!$task)
            return response()->json(['message' => 'not found', 'access_token' => $request->bearerToken()], 404);

        return response()->json(['data' => $task, 'access_token' => $request->bearerToken()]);
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
        $task = User::find(auth()->user()->id)->tasks->where('id', '=', $id)->first();

        if (!$task)
            return response()->json(['message' => 'not found', 'access_token' => $request->bearerToken()], 404);

        $task->update($request->all());

        return response()->json(['data' => $task, 'access_token' => $request->bearerToken()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $task = User::find(auth()->user()->id)->tasks->where('id', '=', $id)->first();

        if (!$task)
            return response()->json(['message' => 'not found', 'access_token' => $request->bearerToken()], 404);

        $task->delete();

        return response(['message' => 'Deleted Successfully', 'access_token' => $request->bearerToken()]);
    }
}
