<?php $__env->startSection('title'); ?>
    Create Vehicle
<?php $__env->stopSection(); ?>
<?php if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id)): ?>
    <?php
        $addUrl = route('vehicles.create');
    ?>
<?php else: ?>
    <?php
        $addUrl = '#';
    ?>
<?php endif; ?>
<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Create Vehicle',
            'spSubTitle' => 'create a single vehicle',
            'spShowTitleSet' => true
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => null,
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
            'spMessage' => $message = $message ?? NULL,
            'spStatus' => $status = $status ?? NULL
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>

<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Vehicle Information</a>
        </p>

        <div class="customContainer">
            <?php echo Html::form()
                ->attribute('action', route('vehicles.store'))
                ->method('POST')
                ->attribute('id', 'add_route')
                ->acceptsFiles()
                ->attribute('autocomplete', 'off')
                ->open(); ?>


            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        <?php echo Html::label('name', 'Name')->class('label'); ?>

                        <div class="control">
                            <?php echo Html::input('text', 'name', $vehicle->name ?? null)
                                ->class('input')
                                ->placeholder('Enter name...'); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <?php echo Html::label('size', 'Vehicle Size')->class('label'); ?>

                        <div class="control">
                            <?php echo Html::input('text', 'size', $vehicle->size ?? null)
                                ->class('input')
                                ->placeholder('Enter Vehicle Size...'); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        <?php echo Html::label('probably_cost', 'Probably Cost')->class('label'); ?>

                        <div class="control">
                            <?php echo Html::input('text', 'probably_cost', $vehicle->probably_cost ?? null)
                                ->class('input')
                                ->placeholder('Enter probably cost...'); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            <?php echo Html::button('Save Changes')
                                ->class('button is-success is-small')
                                ->type('submit'); ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php echo Html::form()->close(); ?>

        </div>
    </article>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('column_right'); ?>
    <!-- <article class="is-primary">
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
    </article> -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\vendor\tritiyo\vehicle\src/views/create.blade.php ENDPATH**/ ?>