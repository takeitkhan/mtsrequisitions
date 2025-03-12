
<?php $__env->startSection('title'); ?>
    Other Information
<?php $__env->stopSection(); ?>

<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Other Information',
            'spSubTitle' => 'Edit user other information',
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
            'spMessage' => $message = $message ?? NULL,
            'spStatus' => $status = $status ?? NULL
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>
<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a href="<?php echo e(route('users.basic_info', $id)); ?>">Basic Information</a>
            <a href="<?php echo e(route('users.contact_info', $id)); ?>" class="is-active">Other Information</a>
            <a href="<?php echo e(route('users.user_photos', $id)); ?>">Images</a>
            <a href="<?php echo e(route('users.user_permissions', $id)); ?>">Permissions</a>
            <a href="<?php echo e(route('users.financial_info', $id)); ?>">Financial Information</a>
        </p>

        <div class="customContainer">
            <?php echo e(html()->form('POST', route('users.contact_info', $id))
                ->attribute('id', 'add_user')
                ->attribute('method', 'PATCH')
                ->attribute('files', true)
                ->attribute('autocomplete', 'off')
                ->open()); ?>


            <div class="columns">
                <div class="column is-4">
                    <div class="field">
                        <strong>Personal Information</strong>
                    </div>


                    <?php echo e(html()->label('Join Date', 'join_date')->class('label')); ?>

                    <?php echo e(html()->date('join_date', $user->join_date)->required()->class('input')->placeholder('Enter join_date...')); ?>


                    <?php echo e(html()->label('Employee Status', 'employee_status')->class('label')); ?>

                    <div class="select">
                        <?php echo e(html()->select('employee_status', ['' => 'Select status', 'Enroll' => 'Enroll', 'Terminated' => 'Terminated', 'Long Leave' => 'Long Leave', 'Left Job' => 'Left Job', 'On Hold'], $user->employee_status)->required()->class('input')); ?>

                    </div>

                    <?php echo e(html()->label('Father Name', 'father')->class('label')); ?>

                    <?php echo e(html()->text('father', $user->father)->class('input')->placeholder('Enter father name...')); ?>


                    <?php echo e(html()->label('Mother Name', 'mother')->class('label')); ?>

                    <?php echo e(html()->text('mother', $user->mother)->class('input')->placeholder('Enter mother name...')); ?>


                    <?php echo e(html()->label('Permanent Address', 'address')->class('label')); ?>

                    <?php echo e(html()->textarea('address', $user->address)->class('textarea')->rows(2)); ?>


                    <?php echo e(html()->label('Post Code', 'postcode')->class('label')); ?>

                    <?php echo e(html()->number('postcode', $user->postcode)->class('input')); ?>


                    <?php echo e(html()->label('District', 'district')->class('label')); ?>

                    <div class="control">
                        <div class="select">
                            <?php
                            $districts = \DB::table('districts')->get()->pluck('name', 'name');
                            ?>
                            <?php echo e(html()->select('district', $districts ?? NULL, $user->district)->class('input')); ?>

                        </div>
                    </div>

                    <?php echo e(html()->label('Gender', 'gender')->class('label')); ?>

                    <?php echo e(html()->select('gender', ['' => 'Select gender', 'Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'], $user->gender)->class('input')); ?>


                    <?php echo e(html()->label('Marital Status', 'marital_status')->class('label')); ?>

                    <?php echo e(html()->select('marital_status', ['' => 'Select marital status', 'Married' => 'Married', 'Unmarried' => 'Unmarried', 'Other' => 'Other'], $user->marital_status)->class('input')); ?>


                    <?php echo e(html()->label('Birthday', 'birthday')->class('label')); ?>

                    <?php echo e(html()->date('birthday', $user->birthday)->class('input')->placeholder('Enter birthday...')); ?>


                    <?php echo e(html()->label('Alternative Email', 'alternative_email')->class('label')); ?>

                    <?php echo e(html()->text('alternative_email', $user->alternative_email)->class('input')->type('email')->placeholder('Enter email...')); ?>


                    <?php echo e(html()->label('Basic Salary', 'basic_salary')->class('label')); ?>

                    <?php echo e(html()->text('basic_salary', $user->basic_salary)->class('input')->placeholder('Enter basic_salary...')); ?>

                </div>
                <div class="column is-4">
                    <div class="field">
                        <strong>Old Company Information</strong>
                    </div>

                    <?php echo e(html()->label('Company Name', 'company')->class('label')); ?>

                    <?php echo e(html()->text('company', $user->company)->class('input')->placeholder('Enter company name...')); ?>


                    <?php echo e(html()->label('Company Address', 'company_address')->class('label')); ?>

                    <?php echo e(html()->textarea('company_address', $user->company_address)->class('textarea')->rows(5)); ?>


                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            <input type="submit"
                                   name="contact_info"
                                   class="button is-success is-small"
                                   value="Save Changes"/>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\resources\views/users/contact_info.blade.php ENDPATH**/ ?>