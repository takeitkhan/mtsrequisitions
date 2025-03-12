<?php $__env->startSection('title'); ?>
    Edit Site
<?php $__env->stopSection(); ?>

<?php if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id)): ?>
    <?php
        $addUrl = route('sites.create');
    ?>
<?php else: ?>
    <?php
        $addUrl = '#';
    ?>
<?php endif; ?>

<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Edit Site',
            'spSubTitle' => 'Edit a single site',
            'spShowTitleSet' => true
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => $addUrl,
            'spAllData' => route('sites.index'),
            'spSearchData' => route('sites.search'),
            'spTitle' => 'Sites',
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.filter_set', [
            'spShowFilterSet' => true,
            'spAddUrl' => route('sites.create'),
            'spAllData' => route('sites.index'),
            'spSearchData' => route('sites.search'),
            'spPlaceholder' => 'Search sites...',
            'spMessage' => $message ?? NULL,
            'spStatus' => $status ?? NULL
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>

<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Site Information</a>
        </p>

        <div class="customContainer">
            
            <?php echo html()->form('PUT', route('sites.update', $site->id))
                ->id('add_route')
                ->attribute('enctype', 'multipart/form-data')  
                ->autocomplete('off')
                ->open(); ?>

            
            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        <?php echo html()->label('Project')->for('project_id')->class('label'); ?>

                        <div class="control">
                            <?php $projects = \Tritiyo\Project\Models\Project::pluck('name', 'id')->prepend('Select Project', ''); ?>
                            <?php echo html()->select('project_id', $projects, $site->project_id ?? NULL)
                                ->class('input is-small'); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <?php echo html()->label('Location')->for('location')->class('label'); ?>

                        <div class="control">
                            <div class="select is-small">
                                <?php
                                $upazilas = \DB::table('upazilas')->get()->pluck('name', 'name');
                                ?>
                                <?php echo html()->select('location', $upazilas ?? NULL, $site->location ?? NULL)
                                    ->class('input')
                                    ->required(); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <?php echo html()->label('Site Code')->for('site_code')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('site_code', $site->site_code ?? NULL)
                                ->class('input is-small')
                                ->placeholder('Enter Site Code...'); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <?php echo html()->label('Limit Of Task')->for('task_limit')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('task_limit', $site->task_limit ?? NULL)
                                ->class('input is-small')
                                ->placeholder('Enter limit of task...'); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <?php echo html()->label('Completion Status')->for('completion_status')->class('label'); ?>

                        <div class="control">
                            <?php
                                $completion_statuses = ['' => '', 'Running' => 'Running', 'Rejected' => 'Rejected', 'Completed' => 'Completed', 'Pending' => 'Pending', 'Discard' => 'Discard'];
                            ?>
                            <?php echo html()->select('completion_status', $completion_statuses, $site->completion_status ?? NULL)
                                ->class('input is-small')
                                ->required(); ?>

                        </div>
                    </div>
                </div>
            </div>

            
            <?php echo html()->hidden('budget', $site->budget ?? NULL); ?>

            
            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            <?php echo html()->submit('Save Changes')->class('button is-success is-small'); ?>

                        </div>
                    </div>
                </div>
            </div>

            
            <?php echo html()->form()->close(); ?>

        </div>
    </article>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('column_right'); ?>
    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\vendor\tritiyo\site\src/views/edit.blade.php ENDPATH**/ ?>