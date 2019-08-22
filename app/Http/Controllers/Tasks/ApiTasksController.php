<?php

namespace App\Http\Controllers\Tasks;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $task = new Task();

        $task->name = $request->input('name');
        $task->task_owner_id = $request->input('taskOwnerId');
        $task->task_collection_id = $request->input('tasksCollectionId');
        $task->status = $request->input('status');
        if($request->input('date') !== null) {
            $task->date = \Carbon\Carbon::parse($request->input(['date']));
        } else {
            $task->date = null;
        }
        $task->task_completed = $request->input('completed');

        $task->save();

        $data = [];
        $data['id'] = $task->id;
        $data['name'] = $task->name;
        $data['taskOwnerId'] = $task->task_owner_id;
        $data['date'] = $task->date;
        $data['completed'] = $task->task_completed;
        $data['status'] = $task->status;
        $data['taskCollectionId'] = $task->task_collection_id;

        return response()->json([
            'task' => $data
        ]);
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
        $task = Task::destroy($id);
    }
}
