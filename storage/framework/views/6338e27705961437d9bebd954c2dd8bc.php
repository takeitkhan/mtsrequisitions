<?php $__env->startSection('title', 'Create Project'); ?>

<?php if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id)): ?>
    <?php $addUrl = route('projects.create'); ?>
<?php else: ?>
    <?php $addUrl = '#'; ?>
<?php endif; ?>

<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Create Project',
            'spSubTitle' => 'create a single project',
            'spShowTitleSet' => true
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => $addUrl,
            'spAllData' => route('projects.index'),
            'spSearchData' => route('projects.search'),
            'spTitle' => 'Projects',
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.filter_set', [
            'spShowFilterSet' => true,
            'spAddUrl' => route('projects.create'),
            'spAllData' => route('projects.index'),
            'spSearchData' => route('projects.search'),
            'spPlaceholder' => 'Search projects...',
            'spMessage' => $message ?? null,
            'spStatus' => $status ?? null
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>

<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Project Information</a>
        </p>

        <div class="customContainer">
            <?php echo html()->form('POST', route('projects.store'))->attribute('id', 'add_route')->acceptsFiles()->open(); ?>


            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('Project Name', 'name')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->text('name', $project->name ?? null)->class('input')->placeholder('Enter project name...')->required()); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('Project Code', 'code')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->text('code', $project->code ?? null)->class('input')->placeholder('Enter project code...')->required()); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('Project Type', 'type')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->select('type', ['' => 'Select a project type', 'Recurring' => 'Recurring', 'Not Recurring' => 'Not Recurring'])->class('input is-small')); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-9">
                    <div class="field">
                        <?php echo e(html()->label('Project Manager', 'manager')->class('label')); ?>

                        <div class="control">
                            <?php
                                $managers = \App\Models\User::where('role', 3)
                                    ->whereNotIn('employee_status', ['Left Job', 'Terminated'])
                                    ->pluck('name', 'id')
                                    ->prepend('Select manager', '');
                            ?>
                            <?php echo e(html()->select('manager', $managers, $project->manager ?? null)->class('input')); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('Project Customer', 'customer')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->text('customer', $project->customer ?? null)->class('input')->placeholder('Enter project customer...')); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('Project Vendor', 'vendor')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->text('vendor', $project->vendor ?? null)->class('input')->placeholder('Enter project vendor...')); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('Project Supplier', 'supplier')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->text('supplier', $project->supplier ?? null)->class('input')->placeholder('Enter project supplier...')->required()); ?>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('Project Start', 'start')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->date('start', $project->start ?? null)->class('input')); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo e(html()->label('Approximate Project End', 'end')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->date('end', $project->end ?? null)->class('input')); ?>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="columns">
                <div class="column is-9">
                    <div class="field">
                        <?php echo e(html()->label('Project Summary', 'summary')->class('label')); ?>

                        <div class="control">
                            <?php echo e(html()->textarea('summary', $project->summary ?? null)->class('textarea')->placeholder('Enter project summary...')->required()); ?>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            <?php echo e(html()->button('Save Changes')->class('button is-success is-small')->type('submit')); ?>

                        </div>
                    </div>
                </div>
            </div>
            
            <?php echo html()->form()->close(); ?>

        </div>
    </article>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\vendor\tritiyo\project\src/views/create.blade.php ENDPATH**/ ?>