<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.create')); ?> <?php echo e(trans('cruds.department.title_singular')); ?>

    </div>

    <div class="card-body">
        <form method="POST" action="<?php echo e(route("admin.departments.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="name_id"><?php echo e(trans('cruds.department.fields.name')); ?></label>
                <select class="form-control select2 <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" name="name_id" id="name_id">
                    <?php $__currentLoopData = $names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('name_id') == $id ? 'selected' : ''); ?>><?php echo e($entry); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('name')): ?>
                    <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.department.fields.name_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="department_name"><?php echo e(trans('cruds.department.fields.department_name')); ?></label>
                <input class="form-control <?php echo e($errors->has('department_name') ? 'is-invalid' : ''); ?>" type="text" name="department_name" id="department_name" value="<?php echo e(old('department_name', '')); ?>" required>
                <?php if($errors->has('department_name')): ?>
                    <span class="text-danger"><?php echo e($errors->first('department_name')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.department.fields.department_name_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="code"><?php echo e(trans('cruds.department.fields.code')); ?></label>
                <input class="form-control <?php echo e($errors->has('code') ? 'is-invalid' : ''); ?>" type="number" name="code" id="code" value="<?php echo e(old('code', '')); ?>" step="1">
                <?php if($errors->has('code')): ?>
                    <span class="text-danger"><?php echo e($errors->first('code')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.department.fields.code_helper')); ?></span>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aimmanuel\Pictures\Timetable-master (1)\Timetable-master\resources\views/admin/departments/create.blade.php ENDPATH**/ ?>