<?php $__env->startSection('content'); ?>
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="<?php echo e(route('admin.home')); ?>">
                <?php echo e(trans('panel.site_title')); ?>

            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                <?php echo e(trans('global.reset_password')); ?>

            </p>

            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('password.email')); ?>">
                <?php echo csrf_field(); ?>

                <div>
                    <div class="form-group">
                        <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" required autocomplete="email" autofocus placeholder="<?php echo e(trans('global.login_email')); ?>" value="<?php echo e(old('email')); ?>">

                        <?php if($errors->has('email')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('email')); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary btn-flat btn-block">
                            <?php echo e(trans('global.send_password')); ?>

                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aimmanuel\Pictures\Timetable-master (1)\Timetable-master\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>