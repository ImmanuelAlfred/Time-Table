<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.create')); ?> <?php echo e(trans('cruds.faculty.title_singular')); ?>

    </div>

    <div class="card-body">
        <form method="POST" action="<?php echo e(route("admin.faculties.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="required" for="name"><?php echo e(trans('cruds.faculty.fields.name')); ?></label>
                <input class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" type="text" name="name" id="name" value="<?php echo e(old('name', '')); ?>" required>
                <?php if($errors->has('name')): ?>
                    <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.faculty.fields.name_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="code"><?php echo e(trans('cruds.faculty.fields.code')); ?></label>
                <input class="form-control <?php echo e($errors->has('code') ? 'is-invalid' : ''); ?>" type="number" name="code" id="code" value="<?php echo e(old('code', '')); ?>" step="1" required>
                <?php if($errors->has('code')): ?>
                    <span class="text-danger"><?php echo e($errors->first('code')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.faculty.fields.code_helper')); ?></span>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aimmanuel\Pictures\Timetable-master (1)\Timetable-master\resources\views/admin/faculties/create.blade.php ENDPATH**/ ?>