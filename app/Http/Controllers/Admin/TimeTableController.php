<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
// use App\Http\Requests\MassDestroyTimeTableRequest;
// use App\Http\Requests\StoreTimeTableRequest;
// use App\Http\Requests\UpdateTimeTableRequest;
use App\Models\Department;
use App\Models\TimeTable;
use Gate;
//use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TimeTableController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('time_table_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeTables = TimeTable::with(['department_name', 'media'])->get();

        return view('admin.timeTables.index', compact('timeTables'));
    }

    public function create()
    {
        abort_if(Gate::denies('time_table_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $department_names = Department::pluck('department_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.timeTables.create', compact('department_names'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'time_table' => [
                'array',
            ],
            'department_name_id' => [
                'required',
                'integer',
            ],
        ]);


        $timeTable = TimeTable::create($request->all());

        foreach ($request->input('time_table', []) as $file) {
            $timeTable->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('time_table');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $timeTable->id]);
        }

        return redirect()->route('admin.time-tables.index');
    }

    public function edit(TimeTable $timeTable)
    {
        abort_if(Gate::denies('time_table_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $department_names = Department::pluck('department_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $timeTable->load('department_name');

        return view('admin.timeTables.edit', compact('department_names', 'timeTable'));
    }

    public function update(Request $request, TimeTable $timeTable)
    {
        $request->validate([
            'time_table' => [
                'array',
            ],
            'department_name_id' => [
                'required',
                'integer',
            ],
        ]);

        if (count($timeTable->time_table) > 0) {
            foreach ($timeTable->time_table as $media) {
                if (! in_array($media->file_name, $request->input('time_table', []))) {
                    $media->delete();
                }
            }
        }
        $media = $timeTable->time_table->pluck('file_name')->toArray();
        foreach ($request->input('time_table', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $timeTable->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('time_table');
            }
        }

        return redirect()->route('admin.time-tables.index');
    }

    public function show(TimeTable $timeTable)
    {
        abort_if(Gate::denies('time_table_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeTable->load('department_name');

        return view('admin.timeTables.show', compact('timeTable'));
    }

    public function destroy(TimeTable $timeTable)
    {
        abort_if(Gate::denies('time_table_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeTable->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:time_tables,id',
        ]);

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('time_table_create') && Gate::denies('time_table_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TimeTable();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
