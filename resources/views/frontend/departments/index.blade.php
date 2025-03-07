@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('department_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.departments.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.department.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.department.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Department">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.department.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.department.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.faculty.fields.code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.department.fields.department_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.department.fields.code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.department.fields.created_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $key => $department)
                                    <tr data-entry-id="{{ $department->id }}">
                                        <td>
                                            {{ $department->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $department->name->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $department->name->code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $department->department_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $department->code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $department->created_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('department_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.departments.show', $department->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('department_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.departments.edit', $department->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('department_delete')
                                                <form action="{{ route('frontend.departments.destroy', $department->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('department_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.departments.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Department:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection