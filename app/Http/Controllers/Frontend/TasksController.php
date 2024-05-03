<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Child;
use App\Models\Task;
use App\Models\Category;
use App\Models\Completed;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Carbon\Carbon;


class TasksController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $today = Carbon::today()->toDateString();

        $tasks = Task::leftJoin('completeds', 'tasks.id', '=', 'completeds.task_id')
                     ->select('tasks.*', 'completeds.task_id as is_completed')
                     ->where('tasks.created_by_id', '=', Auth::id())
                     //->whereDate('completeds.created_at', '>=', $today)
                     ->get();

        return view('frontend.pages.all-tasks', compact('tasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = Child::pluck('first_name', 'id');

        return view('frontend.pages.add-task', compact('assigned_tos', 'categories'));
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());
        $task->assigned_tos()->sync($request->input('assigned_tos', []));

        return redirect()->route('frontend.tasks.index');
    }

    public function edit(Task $task)
    {

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = Child::pluck('first_name', 'id');

        $task->load('category', 'assigned_tos', 'created_by');

        return view('frontend.pages.edit-task', compact('assigned_tos', 'categories', 'task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        $task->assigned_tos()->sync($request->input('assigned_tos', []));

        return redirect()->route('frontend.tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->load('assigned_tos');

        return view('frontend.tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskRequest $request)
    {
        $tasks = Task::find(request('ids'));

        foreach ($tasks as $task) {
            $task->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
