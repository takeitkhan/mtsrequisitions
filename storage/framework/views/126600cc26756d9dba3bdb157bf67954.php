
<?php $__env->startSection('title'); ?>
    Basic Information
<?php $__env->stopSection(); ?>

<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Basic Information',
            'spSubTitle' => 'Edit user basic information',
            'spShowTitleSet' => true
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => null,
            'spAddUrl' => route('users.create'),
            'spAllData' => route('users.index'),
            'spSearchData' => route('users.search'),
            'spTitle' => 'Users',
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.filter_set', [
            'spShowFilterSet' => true,
            'spPlaceholder' => 'Search user...',
            'spMessage' => $message ?? NULL,
            'spStatus' => $status ?? NULL
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>

<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a href="<?php echo e(route('users.basic_info', $id)); ?>" class="is-active">Basic Information</a>
            <a href="<?php echo e(route('users.contact_info', $id)); ?>">Other Information</a>
            <a href="<?php echo e(route('users.user_photos', $id)); ?>">Images</a>
            <a href="<?php echo e(route('users.user_permissions', $id)); ?>">Permissions</a>
            <a href="<?php echo e(route('users.financial_info', $id)); ?>">Financial Information</a>
        </p>

        <div class="customContainer">
            <?php echo e(html()->form('PUT', route('users.basic_info', $id))
                ->attribute('id', 'add_user')
                ->attribute('files', true)
                ->attribute('autocomplete', 'off')
                ->open()); ?>


            <div class="columns">
                <div class="column is-6">
                    <?php echo e(html()->label('Name', 'name')->class('label')); ?>

                    <?php echo e(html()->text('name', $user->name)->required()->class('input')->placeholder('Enter name...')); ?>

                </div>
                <div class="column is-6">
                    <?php echo e(html()->label('Employee no', 'employee_no')->class('label')); ?>

                    <?php echo e(html()->number('employee_no', $user->employee_no)->class('input')->required()->placeholder('Enter employee no...')); ?>

                </div>
            </div>

            <div class="columns">
                <div class="column is-6">
                    <?php echo e(html()->label('Mobile', 'phone')->class('label')); ?>

                    <?php echo e(html()->number('phone', $user->phone)->required()->class('input')->placeholder('Enter phone no...')->maxlength(11)->minlength(11)); ?>

                </div>
                <div class="column is-6">
                    <?php echo e(html()->label('Emergency mobile', 'emergency_phone')->class('label')); ?>

                    <?php echo e(html()->number('emergency_phone', $user->emergency_phone)->class('input')->required()->placeholder('Enter phone no...')->maxlength(11)->minlength(11)); ?>

                </div>
            </div>

            <div class="columns">
                <div class="column is-4">
                    <?php echo e(html()->label('Email', 'email')->class('label')); ?>

                    <?php echo e(html()->email('email', $user->email)->class('input')->placeholder('Enter email...')); ?>

                </div>
                <div class="column is-2">
                    <?php echo e(html()->label('Department', 'department')->class('label')); ?>

                    <?php echo e(html()->select('department', [
                        '' => 'Select a department',
                        'Accounts & Finance' => 'Accounts & Finance',
                        'Administration' => 'Administration',
                        'Maintenance' => 'Maintenance',
                        'Management' => 'Management',
                        'E-Commerce' => 'E-Commerce',
                        'Tourism' => 'Tourism',
                        'Technical' => 'Technical',
                        'HR' => 'HR',
                        'Office Staff' => 'Office Staff',
                    ], $user->department)->class('input is-small')); ?>

                </div>
                <div class="column is-3">
                    <?php echo e(html()->label('Designation', 'designation')->class('label')); ?>

                    <?php echo e(html()->select('designation', \App\Models\Designation::pluck('name', 'id'), $user->designation)->class('input is-small')); ?>

                </div>
                <div class="column is-3">
                    <?php echo e(html()->label('User Group', 'role')->class('label')); ?>

                    <?php echo e(html()->select('role', \App\Models\Role::pluck('name', 'id'), $user->role)->class('input is-small')); ?>

                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            <input type="submit" name="basic_info" class="button is-success is-small" value="Save Changes"/>
                        </div>
                    </div>
                </div>
            </div>

            <?php echo e(html()->form()->close()); ?>

        </div>
    </article>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('column_right'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\resources\views/users/basic_info.blade.php ENDPATH**/ ?>