<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTimeTableRequest;
use App\Http\Requests\UpdateTimeTableRequest;
use App\Http\Resources\Admin\TimeTableResource;
use App\Models\TimeTable;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TimeTableApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('time_table_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TimeTableResource(TimeTable::with(['department_name'])->get());
    }

    public function store(StoreTimeTableRequest $request)
    {
        $timeTable = TimeTable::create($request->all());

        foreach ($request->input('time_table', []) as $file) {
            $timeTable->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('time_table');
        }

        return (new TimeTableResource($timeTable))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TimeTable $timeTable)
    {
        abort_if(Gate::denies('time_table_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TimeTableResource($timeTable->load(['department_name']));
    }

    public function update(UpdateTimeTableRequest $request, TimeTable $timeTable)
    {
        $timeTable->update($request->all());

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

        return (new TimeTableResource($timeTable))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TimeTable $timeTable)
    {
        abort_if(Gate::denies('time_table_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeTable->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
