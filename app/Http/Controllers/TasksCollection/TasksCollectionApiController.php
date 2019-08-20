<?php

namespace App\Http\Controllers\TasksCollection;

use App\Task;
use App\TasksCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksCollectionApiController extends Controller
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
        // creating the collection
        $collection = new TasksCollection();
        $collection->name = $request->input('name');
        $collection->save();

        // getting the collection id that will be used in the creation of the tasks
        $collectionId = $collection->id;

        
        // since adding a new key to the original array throws an exception
        // we create a new one
        $data = [];
        $tasks = $request->input('tasks');
        foreach ($tasks as $key => $task) {
            $data[$key]['task_owner_id'] = $task['taskOwnerId'];
            $data[$key]['task_collection_id'] = $collectionId;
            $data[$key]['name'] = $task['name'];
            $data[$key]['date'] = \Carbon\Carbon::parse($task['date']);
            $data[$key]['task_completed'] = 0;
            $data[$key]['status'] = $task['status'];
            // $data[$key]['task_completed'] = $task['completed'];
            // insert in laravel doesnt add timestamps
            $data[$key]['created_at'] = \Carbon\Carbon::now();
            $data[$key]['updated_at'] = \Carbon\Carbon::now();
        }

        Task::insert($data);

        
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
