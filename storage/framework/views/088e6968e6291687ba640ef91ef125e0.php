<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.create')); ?> <?php echo e(trans('cruds.timeTable.title_singular')); ?>

    </div>

    <div class="card-body">
        <form method="POST" action="<?php echo e(route("admin.time-tables.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="time_table"><?php echo e(trans('cruds.timeTable.fields.time_table')); ?></label>
                <div class="needsclick dropzone <?php echo e($errors->has('time_table') ? 'is-invalid' : ''); ?>" id="time_table-dropzone">
                </div>
                <?php if($errors->has('time_table')): ?>
                    <span class="text-danger"><?php echo e($errors->first('time_table')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.timeTable.fields.time_table_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="department_name_id"><?php echo e(trans('cruds.timeTable.fields.department_name')); ?></label>
                <select class="form-control select2 <?php echo e($errors->has('department_name') ? 'is-invalid' : ''); ?>" name="department_name_id" id="department_name_id" required>
                    <?php $__currentLoopData = $department_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('department_name_id') == $id ? 'selected' : ''); ?>><?php echo e($entry); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('department_name')): ?>
                    <span class="text-danger"><?php echo e($errors->first('department_name')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.timeTable.fields.department_name_helper')); ?></span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    <?php echo e(trans('global.save')); ?>

                </button>
            </div>
        </form>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    var uploadedTimeTableMap = {}
Dropzone.options.timeTableDropzone = {
    url: '<?php echo e(route('admin.time-tables.storeMedia')); ?>',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
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
<?php if(isset($timeTable) && $timeTable->time_table): ?>
          var files =
            <?php echo json_encode($timeTable->time_table); ?>

              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="time_table[]" value="' + file.file_name + '">')
            }
<?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aimmanuel\Pictures\Timetable-master (1)\Timetable-master\resources\views/admin/timeTables/create.blade.php ENDPATH**/ ?>