@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.timeTable.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.time-tables.update", [$timeTable->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="time_table">{{ trans('cruds.timeTable.fields.time_table') }}</label>
                            <div class="needsclick dropzone" id="time_table-dropzone">
                            </div>
                            @if($errors->has('time_table'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('time_table') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.timeTable.fields.time_table_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="department_name_id">{{ trans('cruds.timeTable.fields.department_name') }}</label>
                            <select class="form-control select2" name="department_name_id" id="department_name_id" required>
                                @foreach($department_names as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('department_name_id') ? old('department_name_id') : $timeTable->department_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('department_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('department_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.timeTable.fields.department_name_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedTimeTableMap = {}
Dropzone.options.timeTableDropzone = {
    url: '{{ route('frontend.time-tables.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="time_table[]" value="' + response.name + '">')
      uploadedTimeTableMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedTimeTableMap[file.name]
      }
      $('form').find('input[name="time_table[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($timeTable) && $timeTable->time_table)
          var files =
            {!! json_encode($timeTable->time_table) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="time_table[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection