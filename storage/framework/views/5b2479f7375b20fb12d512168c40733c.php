<?php $__env->startSection('title'); ?>
    Edit Material
<?php $__env->stopSection(); ?>

<?php if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id)): ?>
    <?php
        $addUrl = route('materials.create');
    ?>
<?php else: ?>
    <?php
        $addUrl = '#';
    ?>
<?php endif; ?>

<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Edit Material',
            'spSubTitle' => 'Edit a single material',
            'spShowTitleSet' => true
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => $addUrl,
            'spAllData' => route('materials.index'),
            'spSearchData' => route('materials.search'),
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.filter_set', [
            'spShowFilterSet' => true,
            'spAddUrl' => route('materials.create'),
            'spAllData' => route('materials.index'),
            'spSearchData' => route('materials.search'),
            'spPlaceholder' => 'Search materials...',
            'spMessage' => $message ?? NULL,
            'spStatus' => $status ?? NULL
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>

<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Material Information</a>
        </p>

        <div class="customContainer">
            
            <?php echo html()->form('PUT', route('materials.update', $material->id))
                ->id('add_route')
                ->open(); ?>

            
            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        <?php echo html()->label('Name')->for('name')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('name', $material->name ?? null)
                                ->class('input')
                                ->placeholder('Enter Name...'); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo html()->label('Unit')->for('unit')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('unit', $material->unit ?? null)
                                ->class('input')
                                ->placeholder('Enter Material Unit...'); ?>

                        </div>
                    </div>
                </div>
            </div>
            
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
    <article class="is-primary">
        <div class="box">
            <h1 class="title is-5">Important Note</h1>
            <p>
                Please select project manager and budget properly
            </p>
        </div>
    </article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\vendor\tritiyo\material\src/views/edit.blade.php ENDPATH**/ ?>