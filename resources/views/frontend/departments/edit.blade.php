@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.department.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.departments.update", [$department->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name_id">{{ trans('cruds.department.fields.name') }}</label>
                            <select class="form-control select2" name="name_id" id="name_id">
                                @foreach($names as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('name_id') ? old('name_id') : $department->name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="department_name">{{ trans('cruds.department.fields.department_name') }}</label>
                            <input class="form-control" type="text" name="department_name" id="department_name" value="{{ old('department_name', $department->department_name) }}" required>
                            @if($errors->has('department_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('department_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.department_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="code">{{ trans('cruds.department.fields.code') }}</label>
                            <input class="form-control" type="number" name="code" id="code" value="{{ old('code', $department->code) }}" step="1">
                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection