<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\TaskPicture;
use Illuminate\Http\Request;
use App\Http\Requests\TaskPictureStoreRequest;

class TaskPictureController extends Controller
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
     * @param  \app\Http\Requests\TaskPictureStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskPictureStoreRequest $request, Project $project, Task $task)
    {
        $validated = $request->validated();

        if (TaskPicture::create([
            'task_id' => $task->id,
            'file_path' => $validated['file_path'],
            'created_user_id' => $request->user()->id,
        ])) {
            $flash = ['success' => __('Picture uploaded successfully.')];
        } else {
            $flash = ['error' => __('Failed to upload the picture.')];
        }

        return redirect()->route('tasks.edit', ['project' => $project->id, 'task' => $task->id])
            ->with($flash);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskPicture  $taskPicture
     * @return \Illuminate\Http\Response
     */
    public function show(TaskPicture $taskPicture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskPicture  $taskPicture
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskPicture $taskPicture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskPicture  $taskPicture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskPicture $taskPicture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskPicture  $taskPicture
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskPicture $taskPicture)
    {
        //
    }
}
