
<?php $__env->startSection('title'); ?>
    User Photos
<?php $__env->stopSection(); ?>

<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'User Photos',
            'spSubTitle' => 'user avatar and signature',
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
        <div class="panel-tabs">
            <a href="<?php echo e(route('users.basic_info', $id)); ?>">Basic Information</a>
            <a href="<?php echo e(route('users.contact_info', $id)); ?>">Other Information</a>
            <a href="<?php echo e(route('users.user_photos', $id)); ?>" class="is-active">Images</a>
            <a href="<?php echo e(route('users.user_permissions', $id)); ?>">Permissions</a>
            <a href="<?php echo e(route('users.financial_info', $id)); ?>">Financial Information</a>
        </div>

        <div class="customContainer">
            <?php echo e(html()->form('POST', route('users.user_photos', $id))
                ->attribute('id', 'add_user')
                ->attribute('enctype', 'multipart/form-data') // Add this line
                ->attribute('autocomplete', 'off')
                ->open()); ?>


            <div class="columns">
                <div class="column is-4">
                    <div class="field">
                        <?php echo e(html()->label('User Avatar', 'avatar')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->file('avatar')->name('avatar')); ?>

                        </div>
                    </div>

                    <div class="field">
                        <?php echo e(html()->label('User Signature', 'signature')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->file('signature')->name('signature')); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-4">

                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            <?php echo e(html()->submit('Save Changes')->class('button is-success is-small')); ?>

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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\resources\views/users/user_photos.blade.php ENDPATH**/ ?>