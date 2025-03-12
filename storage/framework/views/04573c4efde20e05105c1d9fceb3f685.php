<?php $__env->startSection('title'); ?>
    Include Anonymous Proof information of task
<?php $__env->stopSection(); ?>

<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Vehicle',
            'spSubTitle' => 'Add Anonymous Proof of task',
            'spShowTitleSet' => true
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => null,
            'spAddUrl' => route('tasks.create'),
            'spAllData' => route('tasks.index'),
            'spSearchData' => route('tasks.search'),
            'spTitle' => 'Tasks',
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.filter_set', [
            'spShowFilterSet' => true,
            'spPlaceholder' => 'Search tasks...',
            'spMessage' => $message = $message ?? NULl,
            'spStatus' => $status = $status ?? NULL
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>
<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary" id="app">

        <?php
        $disabled = 'disabled="disabled"';
        $task_id = request()->get('task_id');
        ?>

        <?php echo $__env->make('task::layouts.tab', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


        <div class="customContainer">

            <?php echo Html::form()
                ->attribute('action', route('tasks.update', $task_id))
                ->method('PUT')
                ->attribute('id', 'add_route')
                ->acceptsFiles()
                ->attribute('autocomplete', 'off')
                ->open(); ?>

            
            <div class="columns">
                <div class="column is-9">
                    <div class="field">
                        <label for="task_details" class="label">Task Anonymous Proof Details</label>
                        <div class="control">
                            <?php if(auth()->user()->isManager(auth()->user()->id)): ?>
                                <?php
                                    $disabled = '';
                                ?>
                            <?php endif; ?>
                            <input type="hidden" name="anonymousproof_details" value="anonymousproof_details">
                            <textarea  class="textarea" rows="5" placeholder="Enter Task Anonymous Proof Details..."
                                      name="anonymous_proof_details" cols="50"
                                      id="anonymous_proof_details" <?php echo e($disabled); ?>><?php echo e($task->anonymous_proof_details); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(auth()->user()->isManager(auth()->user()->id)): ?>
                <div class="columns">
                    <div class="column">
                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-success is-small">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>

            <?php endif; ?>
            <?php echo Html::form()->close(); ?>

        </div>
    </article>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('column_right'); ?>
    <?php
        $task = \Tritiyo\Task\Models\Task::where('id', $task_id)->first();
    ?>
    <?php echo $__env->make('task::task_status_sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('cusjs'); ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\vendor\tritiyo\task\src/views/taskanonymousproof/create.blade.php ENDPATH**/ ?>