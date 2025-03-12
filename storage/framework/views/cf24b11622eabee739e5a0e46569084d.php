<?php $__env->startSection('title', 'Edit Vehicle'); ?>

<?php if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id)): ?>
    <?php $addUrl = route('vehicles.create'); ?>
<?php else: ?>
    <?php $addUrl = '#'; ?>
<?php endif; ?>

<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Edit Vehicle',
            'spSubTitle' => 'Edit a single vehicle',
            'spShowTitleSet' => true
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => $addUrl,
            'spAllData' => route('vehicles.index'),
            'spSearchData' => route('vehicles.search'),
            'spTitle' => 'Vehicles',
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.filter_set', [
            'spShowFilterSet' => true,
            'spAddUrl' => route('vehicles.create'),
            'spAllData' => route('vehicles.index'),
            'spSearchData' => route('vehicles.search'),
            'spPlaceholder' => 'Search vehicles...',
            'spMessage' => $message ?? null,
            'spStatus' => $status ?? null
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>

<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Vehicle Information</a>
        </p>

        <div class="customContainer">
            <?php echo html()->form('PUT', route('vehicles.update', $vehicle->id))->id('add_route')->attribute('autocomplete', 'off')->open(); ?>

            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        <?php echo html()->label('Name', 'name')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('name', $vehicle->name ?? '')->class('input')->placeholder('Enter name...'); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo html()->label('Vehicle Size', 'size')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('size', $vehicle->size ?? '')->class('input')->placeholder('Enter Vehicle Size...'); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        <?php echo html()->label('Probably Cost', 'probably_cost')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('probably_cost', $vehicle->probably_cost ?? '')->class('input')->placeholder('Enter probably cost...'); ?>

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
                Please select project manager and budget properly
            </p>
        </div>
    </article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\vendor\tritiyo\vehicle\src/views/edit.blade.php ENDPATH**/ ?>