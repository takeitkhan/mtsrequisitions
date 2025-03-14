@extends('layouts.app')
@section('title')
    User Permission
@endsection

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'User Permission Information',
            'spSubTitle' => 'Edit user User permission information',
            'spShowTitleSet' => true
        ])

        @include('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => null,
            'spAddUrl' => route('users.create'),
            'spAllData' => route('users.index'),
            'spSearchData' => route('users.search'),
            'spTitle' => 'Users',
        ])

        @include('component.filter_set', [
            'spShowFilterSet' => true,
            'spPlaceholder' => 'Search user...',
            'spMessage' => $message = $message ?? NULl,
            'spStatus' => $status = $status ?? NULL
        ])
    </nav>
</section>

@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a href="{{ route('users.basic_info', $id) }}">Basic Information</a>
            <a href="{{ route('users.contact_info', $id) }}">Other Information</a>
            <a href="{{ route('users.user_photos', $id) }}">Images</a>
            <a href="{{ route('users.user_permissions', $id) }}" class="is-active">Permissions</a>
            <a href="{{ route('users.financial_info', $id) }}">Financial Information</a>
        </p>

        <div class="customContainer">
            {{ html()->form('POST', route('users.user_permissions', $id))
                ->attribute('id', 'add_user')                
                ->attribute('autocomplete', 'off')
                ->open() 
            }}

            <input type="hidden" name="_method" value="PATCH">
            <div class="columns">
                <div class="column">
                    <?php $routelist = \App\Models\Routelist::get(); ?>
                    <table class="table is-bordered">
                        <tr>
                            <th></th>
                            <th>Route Name</th>
                            <th>URL</th>
                            <th>Description</th>
                            <th>Note</th>
                            <th>In</th>
                            <th>For</th>
                        </tr>
                        @foreach($routelist as $key => $list)
                            <?php
                            $data = \DB::table('permissions')->select('checked')->where('route_id', $list->id)->where('user_id', $id)->get()->all();

                            if ($data) {
                                foreach ($data as $d) {
                                    if ($d->checked == 'on') {
                                        $checked = 'checked';
                                    } else {
                                        $checked = '';
                                    }
                                }

                            } else {
                                $checked = '';
                            }
                            ?>
                            <tr>
                                <td>
                                    {{ html()->hidden('permission[' . $key . '][route_id]', $list->id) }}
                                    {{ html()->hidden('permission[' . $key . '][user_id]', $id) }}
                                    @if ($data ?? '')
                                        {{ html()->hidden('permission[' . $key . '][checked]', 'off')->attribute('checked', $checked) }}
                                        {{ html()->checkbox('permission[' . $key . '][checked]', ($checked == 'checked'), 'on') }}
                                    @else
                                        {{ html()->checkbox('permission[' . $key . '][checked]', ($checked == 'checked'), 'on') }}
                                    @endif
                                </td>
                                <td>{{ $list->route_name }}</td>
                                <td>{{ $list->route_url }}</td>
                                <td>{{ $list->route_description }}</td>
                                <td>{{ $list->route_note }}</td>
                                <td>
                                    <?php
                                    $designation = \App\Models\Designation::where('id', $list->route_grouping)->get()->all();
                                    foreach ($designation as $desi) {
                                        echo $desi->name;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $roles = \App\Models\Role::where('id', $list->to_role)->get()->all();
                                    foreach ($roles as $role) {
                                        echo $role->name;
                                    }
                                    ?>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            {{ html()->submit('Save Changes')->class('button is-success is-small') }}
                        </div>
                    </div>
                </div>
            </div>

            {{ html()->form()->close() }}
        </div>
    </article>
@endsection

@section('column_right')
@endsection
