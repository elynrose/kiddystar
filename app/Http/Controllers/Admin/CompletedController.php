<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompletedRequest;
use App\Http\Requests\StoreCompletedRequest;
use App\Http\Requests\UpdateCompletedRequest;
use App\Models\Child;
use App\Models\Completed;
use App\Models\Task;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompletedController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('completed_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $completeds = Completed::with(['child', 'task', 'created_by'])->get();

        return view('admin.completeds.index', compact('completeds'));
    }

    public function create()
    {
        abort_if(Gate::denies('completed_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $children = Child::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tasks = Task::pluck('task_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.completeds.create', compact('children', 'tasks'));
    }

    public function store(StoreCompletedRequest $request)
    {
        $completed = Completed::create($request->all());

        return redirect()->route('admin.completeds.index');
    }

    public function edit(Completed $completed)
    {
        abort_if(Gate::denies('completed_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $children = Child::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tasks = Task::pluck('task_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $completed->load('child', 'task', 'created_by');

        return view('admin.completeds.edit', compact('children', 'completed', 'tasks'));
    }

    public function update(UpdateCompletedRequest $request, Completed $completed)
    {
        $completed->update($request->all());

        return redirect()->route('admin.completeds.index');
    }

    public function show(Completed $completed)
    {
        abort_if(Gate::denies('completed_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $completed->load('child', 'task', 'created_by');

        return view('admin.completeds.show', compact('completed'));
    }

    public function destroy(Completed $completed)
    {
        abort_if(Gate::denies('completed_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $completed->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompletedRequest $request)
    {
        $completeds = Completed::find(request('ids'));

        foreach ($completeds as $completed) {
            $completed->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
