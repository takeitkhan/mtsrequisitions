
<?php $__env->startSection('title'); ?>
    Change Password
<?php $__env->stopSection(); ?>

<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Change Password',
            'spSubTitle' => 'set your new password',
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
    <div class="columns">
        <div class="column is-4"></div>
        <div class="column is-4">
            <article class="panel is-primary">
                <div class="customContainer">
                    <?php echo e(html()->form('PUT', route('users.update_password', auth()->user()->id))
                        ->attribute('id', 'add_user')
                        ->attribute('files', true)
                        ->attribute('autocomplete', 'off')
                        ->open()); ?>


                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <?php echo e(html()->label('E-Mail Address', 'email')->class('label')); ?>

                                <div class="control">
                                    <?php echo e(html()->email('email')
                                        ->class('input ' . ($errors->has('email') ? 'is-invalid' : ''))
                                        ->value($user->email ?? '')
                                        ->attribute('readonly', true)
                                        ->required()
                                        ->autofocus()); ?>

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <?php echo e(html()->label('Password', 'password')->class('label')); ?>

                                <div class="control">
                                    <?php echo e(html()->password('password')
                                        ->class('input ' . ($errors->has('password') ? 'is-invalid' : ''))
                                        ->required()); ?>

                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <?php echo e(html()->label('Confirm Password', 'password_confirmation')->class('label')); ?>

                                <div class="control">
                                    <?php echo e(html()->password('password_confirmation')
                                        ->class('input')
                                        ->required()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <?php echo e(html()->submit('Reset Password')->class('button is-success is-small')); ?>

                        </div>
                    </div>

                    <?php echo html()->form()->close(); ?>

                </div>
            </article>
        </div>
        <div class="column is-4"></div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('column_right'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\resources\views/auth/passwords/reset.blade.php ENDPATH**/ ?>