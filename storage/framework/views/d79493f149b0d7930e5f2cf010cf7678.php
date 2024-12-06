<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('time_table_create')): ?>
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="<?php echo e(route('frontend.time-tables.create')); ?>">
                            <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.timeTable.title_singular')); ?>

                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <?php echo e(trans('cruds.timeTable.title_singular')); ?> <?php echo e(trans('global.list')); ?>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-TimeTable">
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.timeTable.fields.id')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.timeTable.fields.time_table')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.timeTable.fields.department_name')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.department.fields.code')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.timeTable.fields.created_at')); ?>

                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $timeTables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $timeTable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr data-entry-id="<?php echo e($timeTable->id); ?>">
                                        <td>
                                            <?php echo e($timeTable->id ?? ''); ?>

                                        </td>
                                        <td>
                                            <?php $__currentLoopData = $timeTable->time_table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e($media->getUrl()); ?>" target="_blank">
                                                    <?php echo e(trans('global.view_file')); ?>

                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td>
                                            <?php echo e($timeTable->department_name->department_name ?? ''); ?>

                                        </td>
                                        <td>
                                            <?php echo e($timeTable->department_name->code ?? ''); ?>

                                        </td>
                                        <td>
                                            <?php echo e($timeTable->created_at ?? ''); ?>

                                        </td>
                                        <td>
                                            

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('time_table_edit')): ?>
                                                <a class="btn btn-xs btn-info" href="<?php echo e(route('frontend.time-tables.edit', $timeTable->id)); ?>">
                                                    <?php echo e(trans('global.edit')); ?>

                                                </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('time_table_delete')): ?>
                                                <form action="<?php echo e(route('frontend.time-tables.destroy', $timeTable->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
                                                </form>
                                            <?php endif; ?>

                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('time_table_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('frontend.time-tables.massDestroy')); ?>",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('<?php echo e(trans('global.datatables.zero_selected')); ?>')

        return
      }

      if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
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
<?php endif; ?>

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-TimeTable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aimmanuel\Pictures\Timetable-master (1)\Timetable-master\resources\views/frontend/timeTables/index.blade.php ENDPATH**/ ?>