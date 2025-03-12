
<?php $__env->startSection('title'); ?>
    Create a route
<?php $__env->stopSection(); ?>

<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Create a route',
            'spSubTitle' => 'create route',
            'spShowTitleSet' => true
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => route('routelists.create'),
            'spAllData' => route('routelists.index'),
            'spSearchData' => route('routelists.search'),
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.filter_set', [
            'spShowFilterSet' => true,
            'spPlaceholder' => 'Search routes...',
            'spMessage' => $message ?? null,
            'spStatus' => $status ?? null
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>
<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Route Information</a>
        </p>

        <div class="customContainer">
            <?php echo html()->form('POST', route('routelists.store'))->id('add_route')->attribute('autocomplete', 'off')->open(); ?>

            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <?php echo html()->label('Software Role', 'to_role')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->select('to_role[]', \App\Models\Role::pluck('name', 'id')->prepend('Select Role', ''), null)->class('input')->multiple(); ?>

                            <small>Use CTRL + Click to select multiple roles</small>
                        </div>
                    </div>
                    <div class="field">
                        <?php echo html()->label('Parent Route', 'parent_route_id')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->select('parent_route_id', \App\Models\Routelist::pluck('route_name', 'id')->prepend('Select parent if needed', ''), null)->class('form-control'); ?>

                        </div>
                    </div>
                    <div class="field">
                        <?php echo html()->label('Route Name in Capitalized Form', 'route_name')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('route_name')->required()->class('input')->placeholder('Enter route name...'); ?>

                        </div>
                    </div>
                    <div class="field">
                        <?php echo html()->label('Route URL', 'route_url')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('route_url')->class('input')->placeholder('Enter route URL...'); ?>

                        </div>
                    </div>
                    <div class="field">
                        <?php echo html()->label('Will show as menu?', 'show_menu')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->select('show_menu', ['' => 'Select one', '1' => 'Yes', '0' => 'No'], null)->class('form-control'); ?>

                        </div>
                    </div>
                    <div class="field">
                        <?php echo html()->label('Skip Sub Menu', 'skip_sub')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->select('skip_sub', ['' => 'Select one', '1' => 'Yes', '0' => 'No'], null)->class('input'); ?>

                        </div>
                    </div>
                    <div class="field">
                        <?php echo html()->label('Will show as dashboard menu?', 'dashboard_menu')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->select('dashboard_menu', ['' => 'Select one', '1' => 'Yes', '0' => 'No'], null)->class('form-control'); ?>

                        </div>
                    </div>
                    <div class="field">
                        <?php echo html()->label('Font awesome class for icon', 'font_awesome')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('font_awesome')->required()->class('input')->placeholder('Enter font awesome...'); ?>

                        </div>
                    </div>
                    <div class="field">
                        <?php echo html()->label('Bulma class for background', 'bulma_class_icon_bg')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('bulma_class_icon_bg')->class('input')->placeholder('Enter BG bulma class...'); ?>

                        </div>
                    </div>
                    <div class="field">
                        <?php echo html()->label('Route Description', 'route_description')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->textarea('route_description')->required()->class('textarea')->rows(5)->placeholder('Enter route details...'); ?>

                        </div>
                    </div>
                    <div class="field">
                        <?php echo html()->label('Route Note', 'route_note')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->textarea('route_note')->class('textarea')->rows(5)->placeholder('Enter route notes...'); ?>

                        </div>
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <?php echo html()->button('Save Changes')->class('button is-success is-small')->type('submit'); ?>

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
            <h1 class="title is-5"> গুরুত্বপুর্ণ তথ্য </h1>
            <p>
                এই পেইজে শুধু এডমিন ছাড়া বাকিদের জন্য উন্মুক্ত না। এই পেইজে কাজ করার ক্ষেত্রে সতর্কতা অবলম্বন করতে হবে।
            </p>
        </div>
    </article>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\resources\views/routelists/create.blade.php ENDPATH**/ ?>