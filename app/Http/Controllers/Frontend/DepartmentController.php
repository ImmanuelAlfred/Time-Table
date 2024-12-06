<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDepartmentRequest;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\Faculty;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::with(['name'])->get();

        return view('frontend.departments.index', compact('departments'));
    }

    public function create()
    {
        abort_if(Gate::denies('department_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.departments.create', compact('names'));
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->all());

        return redirect()->route('frontend.departments.index');
    }

    public function edit(Department $department)
    {
        abort_if(Gate::denies('department_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $department->load('name');

        return view('frontend.departments.edit', compact('department', 'names'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->all());

        return redirect()->route('frontend.departments.index');
    }

    public function show(Department $department)
    {
        abort_if(Gate::denies('department_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $department->load('name', 'departmentNameTimeTables');

        return view('frontend.departments.show', compact('department'));
    }

    public function destroy(Department $department)
    {
        abort_if(Gate::denies('department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $department->delete();

        return back();
    }

    public function massDestroy(MassDestroyDepartmentRequest $request)
    {
        $departments = Department::find(request('ids'));

        foreach ($departments as $department) {
            $department->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
