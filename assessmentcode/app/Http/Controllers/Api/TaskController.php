<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Http\Requests\Api\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('user')->get();
        if ($tasks && $tasks->count() > 0) {
            return response()->json([
                'message' => 'Data fetched successfully',
                'data' => $tasks,
                'status' => true,
                'statusCode' => 200,
            ]);
        }
        return response()->json([
            'message' => 'Data not found',
            'data' => null,
            'status' => true,
            'statusCode' => 200,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $task = Task::create($data);
        if ($task) {
            return response()->json([
                'message' => 'Task created successfully',
                'data' => $task,
                'status' => true,
                'statusCode' => 201,
            ]);
        }
        return response()->json([
            'message' => 'Task not created',
            'data' => null,
            'status' => false,
            'statusCode' => 400,
        ]);
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $data = Task::find($id);
    //     if ($data) {
    //         return response()->json([
    //             'message' => 'Task fetched successfully',
    //             'data' => $data,
    //             'status' => true,
    //             'statusCode' => 200,
    //         ]);
    //     }
    //     return response()->json([
    //         'message' => 'Task not found',
    //         'data' => null,
    //         'status' => false,
    //         'statusCode' => 404,
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::find($id);
        if (! $task) {
            return response()->json([
                'message' => 'Task not found',
                'data' => null,
                'status' => false,
                'statusCode' => 404,
            ]);
        }
        $data = $request->validated();
        $task->update($data);
        $task = Task::find($id);
        return response()->json([
            'message' => 'Task updated successfully',
            'data' => $task,
            'status' => true,
            'statusCode' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if (! $task) {
            return response()->json([
                'message' => 'Task not found',
                'data' => null,
                'status' => false,
                'statusCode' => 404,
            ]);
        }
        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully',
            'data' => null,
            'status' => true,
            'statusCode' => 200,
        ]);
    }
}
