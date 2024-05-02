<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{


    public function index()
    {
        $projects = Project::all();
        return view('pages.home')->with('projects', $projects);
    }

    public function showProjects()
    {
        $projects = Project::all();
        return view('pages.projects')->with('projects', $projects);
    }

    public function projectTaskList($id)
    {

        $taskLists = Task::where('project_id', $id)->orderBy('priority', 'asc')->get();
        return view('pages.task-lists',['taskLists' => $taskLists, 'projectId' => $id]);
    }

    public function store($projectId, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_task' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            // Check if there are existing tasks with the same project_id
        $existingTasks = Task::where('project_id', $projectId)->orderBy('priority', 'desc')->get();

        if ($existingTasks->isEmpty()) {
            // If no existing tasks, set priority to 1
            $priority = 1;
        } else {
            // If existing tasks are present, increment the priority of the last task by 1
            $lastTask = $existingTasks->first();
            $priority = $lastTask->priority + 1;
        }

        $task               = new Task();
        $task->title        = $request->new_task;
        $task->description  = $request->new_task;
        $task->priority     = $priority;
        $task->status       = 0;
        $task->project_id   = $projectId;
        $task->save();

        return redirect()->back();
    }


    public function updatePriority(Request $request)
    {
        $taskData = $request->data;
        $bulkUpdateData = [];
        foreach ($taskData as $task) {
           DB::table('tasks')->where('id', $task['id'])->update(['priority' => $task['priority']]);
        }

        return response()->json(['success' => true]);
    }

    public function update($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $task = Task::find($id);
        $task->title = $request->task;
        $task->save();

        return redirect()->back();
    } 

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->back();
    }
}
