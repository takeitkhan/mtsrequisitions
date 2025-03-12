<?php $__env->startSection('title'); ?>
    Create Material
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
            'spTitle' => 'Create Material',
            'spSubTitle' => 'create a single material',
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
            'spMessage' => $message = $message ?? NULL,
            'spStatus' => $status = $status ?? NULL
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>
<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Material Information</a>
        </p>

        <div class="customContainer">
            <?php echo html()->form('POST', route('materials.store'))->id('add_route')->attribute('autocomplete', 'off')->open(); ?>

            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        <?php echo html()->label('Name', 'name')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('name', $material->name ?? '')->class('input')->placeholder('Enter material name...'); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo html()->label('Material Unit', 'unit')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('unit', $material->unit ?? '')->class('input')->placeholder('Enter Material Unit...'); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            <?php echo html()->button('Save Changes')->class('button is-success is-small'); ?>

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
                The default password is stored in the database when the admin authority creates the user.
                <br/>
                Default password: <strong>bizradix@123</strong>
            </p>
            <br/>
            <p>
                After you provide the basic information, you create a list of users, now you will find the created user
                and
                update the information for your user.
            </p>
        </div>
    </article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\vendor\tritiyo\material\src/views/create.blade.php ENDPATH**/ ?>