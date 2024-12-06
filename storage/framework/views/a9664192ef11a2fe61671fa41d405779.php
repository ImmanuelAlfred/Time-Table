<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light"><?php echo e(trans('panel.site_title')); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs("admin.home") ? "active" : ""); ?>" href="<?php echo e(route("admin.home")); ?>">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            <?php echo e(trans('global.dashboard')); ?>

                        </p>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_management_access')): ?>
                    <li class="nav-item has-treeview <?php echo e(request()->is("admin/permissions*") ? "menu-open" : ""); ?> <?php echo e(request()->is("admin/roles*") ? "menu-open" : ""); ?> <?php echo e(request()->is("admin/users*") ? "menu-open" : ""); ?>">
                        <a class="nav-link nav-dropdown-toggle <?php echo e(request()->is("admin/permissions*") ? "active" : ""); ?> <?php echo e(request()->is("admin/roles*") ? "active" : ""); ?> <?php echo e(request()->is("admin/users*") ? "active" : ""); ?>" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                <?php echo e(trans('cruds.userManagement.title')); ?>

                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.permissions.index")); ?>" class="nav-link <?php echo e(request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : ""); ?>">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.permission.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.roles.index")); ?>" class="nav-link <?php echo e(request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : ""); ?>">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.role.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.users.index")); ?>" class="nav-link <?php echo e(request()->is("admin/users") || request()->is("admin/users/*") ? "active" : ""); ?>">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.user.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('time_table_management_access')): ?>
                    <li class="nav-item has-treeview <?php echo e(request()->is("admin/faculties*") ? "menu-open" : ""); ?> <?php echo e(request()->is("admin/departments*") ? "menu-open" : ""); ?> <?php echo e(request()->is("admin/time-tables*") ? "menu-open" : ""); ?>">
                        <a class="nav-link nav-dropdown-toggle <?php echo e(request()->is("admin/faculties*") ? "active" : ""); ?> <?php echo e(request()->is("admin/departments*") ? "active" : ""); ?> <?php echo e(request()->is("admin/time-tables*") ? "active" : ""); ?>" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                <?php echo e(trans('cruds.timeTableManagement.title')); ?>

                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('faculty_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.faculties.index")); ?>" class="nav-link <?php echo e(request()->is("admin/faculties") || request()->is("admin/faculties/*") ? "active" : ""); ?>">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.faculty.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('department_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.departments.index")); ?>" class="nav-link <?php echo e(request()->is("admin/departments") || request()->is("admin/departments/*") ? "active" : ""); ?>">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.department.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('time_table_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.time-tables.index")); ?>" class="nav-link <?php echo e(request()->is("admin/time-tables") || request()->is("admin/time-tables/*") ? "active" : ""); ?>">
                                        <i class="fa-fw nav-icon fas fa-book">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.timeTable.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('profile_password_edit')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : ''); ?>" href="<?php echo e(route('profile.password.edit')); ?>">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    <?php echo e(trans('global.change_password')); ?>

                                </p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p><?php echo e(trans('global.logout')); ?></p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside><?php /**PATH C:\Users\aimmanuel\Pictures\Timetable-master (1)\Timetable-master\resources\views/partials/menu.blade.php ENDPATH**/ ?>