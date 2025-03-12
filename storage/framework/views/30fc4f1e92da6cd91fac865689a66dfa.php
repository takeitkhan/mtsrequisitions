
<?php $__env->startSection('title'); ?>
    Create User
<?php $__env->stopSection(); ?>
<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Create User',
            'spSubTitle' => 'start with basic information',
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
            'spMessage' => $message = $message ?? NULl,
            'spStatus' => $status = $status ?? NULL
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>
<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Basic Information</a>
        </p>

        <div class="customContainer">
            <?php echo e(html()->form('PUT', route('users.store'))
                ->attribute('id', 'add_user')
                ->attribute('files', true)
                ->attribute('autocomplete', 'off')
                ->open()); ?>

                        
            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <?php echo e(html()->label('Name', 'name')->class('label')); ?>                        
                        <div class="control">
                            <?php echo e(html()->text('name', NULL)->required()->class('input')->placeholder('Enter name...')); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="field">
                        <?php echo e(html()->label('Employee no', 'employee_no')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->number('employee_no', NULL)->class('input')->required()->placeholder('Enter employee no...')); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <?php echo e(html()->label('Mobile no', 'phone')->class('label')); ?>                        
                        <div class="control">
                            <?php echo e(html()->number('phone', NULL)->required()->class('input')->placeholder('Enter phone no...')->maxlength(11)->minlength(11)); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="field">
                        <?php echo e(html()->label('Emergency mobile', 'emergency_phone')->class('label')); ?>                        
                        <div class="control">
                            <?php echo e(html()->number('emergency_phone', NULL)->class('input')->placeholder('Enter phone no...')->maxlength(11)->minlength(11)); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('Email', 'email')->class('label')); ?>                        
                        <div class="control">
                            <?php echo e(html()->email('email', NULL)->class('input')->placeholder('Enter email...')); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('Department', 'department')->class('label')); ?>                        
                        <div class="control">
                            <div class="select" style="width: 100%">
                                <?php
                                $departments = [
                                    '' => 'Select a department',
                                    'Accounts & Finance' => 'Accounts & Finance',
                                    'Administration'  => 'Administration',
                                    'Maintenance' => 'Maintenance',
                                    'Management' => 'Management',
                                    'E-Commerce' => 'E-Commerce',
                                    'Tourism'   => 'Tourism',
                                    'Technical' => 'Technical',
                                    'HR' => 'HR',
                                    'Office Staff' => 'Office Staff',
                                ];
                                ?>

                                <?php echo e(html()->select('department', $departments, NULL, ['class' => 'input is-small'])); ?>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('Designation', 'designation')->class('label')); ?>                        
                        <div class="control">
                            <div class="select" style="width: 100%">
                                <?php $designations = \App\Models\Designation::pluck('name', 'id'); ?>
                                <?php echo e(html()->select('designation', $designations, NULL, ['class' => 'input is-small'])); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('User Role', 'role')->class('label')); ?>                        
                        <div class="control">
                            <div class="select" style="width: 100%">
                                <?php $designations = \App\Models\Role::pluck('name', 'id'); ?>
                                <?php echo e(html()->select('role', $designations ?? NULL, NULL, ['class' => 'input is-small'])); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-success is-small">Save Changes</button>
                </div>
            </div>
            <?php echo html()->form()->close(); ?>

        </div>
    </article>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('column_right'); ?>

    <div class="box">
        <h1 class="title is-5">Important Note</h1>
        <p>
            The default password is stored in the database when the admin authority creates the user.
            <br/>
            Default password: <strong>mtsbd123</strong>
        </p>
        <br/>
        <p>
            After you provide the basic information, you create a list of users, now you will find the created user and
            update the information for your user.
        </p>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\resources\views/users/create.blade.php ENDPATH**/ ?>