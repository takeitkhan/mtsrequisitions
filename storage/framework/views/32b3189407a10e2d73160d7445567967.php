
<?php $__env->startSection('title', 'Edit a route'); ?>

<section class="hero is-white borderBtmLight">
    <nav class="level">
        <?php echo $__env->make('component.title_set', [
            'spTitle' => 'Edit a route',
            'spSubTitle' => 'edit route',
            'spShowTitleSet' => true
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => route('routelists.create'),
            'spAllData' => route('routelists.index'),
            'spSearchData' => route('routelists.search'),
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('component.filter_set', [
            'spShowFilterSet' => false,
            'spPlaceholder' => 'Search routes...',
            'spMessage' => $message ?? NULL,
            'spStatus' => $status ?? NULL
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>
</section>

<?php $__env->startSection('column_left'); ?>
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Route Information</a>
        </p>
        
        <div class="customContainer">
            <?php echo html()->form('PUT', route('routelists.update', $routelist->id))->id('add_route')->open(); ?>

            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <?php echo html()->label('Software Role', 'to_role')->class('label'); ?>

                        <div class="control">
                            <?php
                            $role = \App\Models\Role::pluck('name', 'id')->prepend('Select Role', '');
                            $selected = explode(",", $routelist->to_role);
                            ?>
                            <?php echo html()->select('to_role[]', $role, $selected)->multiple()->class('select is-multiple'); ?>

                            <small>Use CTRL + Click to select multiple roles</small>
                        </div>
                    </div>
                    
                    <div class="field">
                        <?php echo html()->label('Parent Route', 'parent_route_id')->class('label'); ?>

                        <div class="control">
                            <?php $routes = \App\Models\Routelist::pluck('route_name', 'id')->prepend('Select parent if needed', ''); ?>
                            <?php echo html()->select('parent_route_id', $routes, $routelist->parent_menu_id)->class('form-control'); ?>

                        </div>
                    </div>
                    
                    <div class="field">
                        <?php echo html()->label('Route Name in Capitalized Form', 'route_name')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('route_name', $routelist->route_name)->class('input')->required(); ?>

                        </div>
                    </div>
                    
                    <div class="field">
                        <?php echo html()->label('Route URL', 'route_url')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->text('route_url', $routelist->route_url)->class('input'); ?>

                        </div>
                    </div>
                    
                    <div class="field">
                        <?php echo html()->label('Will show as menu?', 'show_menu')->class('label'); ?>

                        <div class="control">
                            <?php echo html()->select('show_menu', ['' => 'Select one', '1' => 'Yes', '0' => 'No'], $routelist->show_menu)->class('form-control'); ?>

                        </div>
                    </div>
                    
                    <div class="field is-grouped">
                        <div class="control">
                            <?php echo html()->button('Save Changes', 'submit')->class('button is-success is-small'); ?>

                        </div>
                    </div>
                </div>
                <div class="column is-6">
                    <article class="panel is-primary">
                        <p class="panel-tabs">
                            <a class="is-active">Click to edit</a>
                        </p>
                        <div style="padding: 20px; max-height: 400px; overflow: scroll;">
                            <?php
                            $routelists = \App\Models\Routelist::get()->toArray();
                            ?>
                            <?php echo route_list_sidebar($routelists, $parent = 0, $seperator = '--'); ?>

                        </div>
                    </article>
                </div>
            </div>
            <?php echo html()->form()->close(); ?>

        </div>
    </article>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('column_right'); ?>
    <article class="is-primary">
        <div class="box">
            <h1 class="title is-5">গুরুত্বপুর্ণ তথ্য</h1>
            <p>এই পেইজে শুধু এডমিন ছাড়া বাকিদের জন্য উন্মুক্ত না। এই পেইজে কাজ করার ক্ষেত্রে সতর্কতা অবলম্বণ করতে হবে।</p>
        </div>
    </article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\resources\views/routelists/edit.blade.php ENDPATH**/ ?>