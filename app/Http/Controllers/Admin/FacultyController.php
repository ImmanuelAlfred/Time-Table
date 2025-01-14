<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\MassDestroyFacultyRequest;
// use App\Http\Requests\StoreFacultyRequest;
// use App\Http\Requests\UpdateFacultyRequest;
use App\Models\Faculty;
use Gate;
//use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacultyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('faculty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faculties = Faculty::all();

        return view('admin.faculties.index', compact('faculties'));
    }

    public function create()
    {
        abort_if(Gate::denies('faculty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.faculties.create');
    }

    public function store(StoreFacultyRequest $request)
    {
       $request->validate([
            'name' => [
                'string',
                'required',
            ],
            'code' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
       ]);
        return redirect()->route('admin.faculties.index');
    }

    public function edit(Faculty $faculty)
    {
        abort_if(Gate::denies('faculty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.faculties.edit', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $request->validate([
            'name' => [
                'string',
                'required',
            ],
            'code' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ]);

        return redirect()->route('admin.faculties.index');
    }

    public function show(Faculty $faculty)
    {
        abort_if(Gate::denies('faculty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faculty->load('nameDepartments');

        return view('admin.faculties.show', compact('faculty'));
    }

    public function destroy(Faculty $faculty)
    {
        abort_if(Gate::denies('faculty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faculty->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:faculties,id',
        ]);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
