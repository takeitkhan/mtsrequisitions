@extends('layouts.app')
@section('title')
    Basic Information
@endsection

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Basic Information',
            'spSubTitle' => 'Edit user basic information',
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
            'spMessage' => $message ?? NULL,
            'spStatus' => $status ?? NULL
        ])
    </nav>
</section>

@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a href="{{ route('users.basic_info', $id) }}" class="is-active">Basic Information</a>
            <a href="{{ route('users.contact_info', $id) }}">Other Information</a>
            <a href="{{ route('users.user_photos', $id) }}">Images</a>
            <a href="{{ route('users.user_permissions', $id) }}">Permissions</a>
            <a href="{{ route('users.financial_info', $id) }}">Financial Information</a>
        </p>

        <div class="customContainer">
            {{ html()->form('PUT', route('users.basic_info', $id))
                ->attribute('id', 'add_user')
                ->attribute('files', true)
                ->attribute('autocomplete', 'off')
                ->open() 
            }}

            <div class="columns">
                <div class="column is-6">
                    {{ html()->label('Name', 'name')->class('label') }}
                    {{ html()->text('name', $user->name)->required()->class('input')->placeholder('Enter name...') }}
                </div>
                <div class="column is-6">
                    {{ html()->label('Employee no', 'employee_no')->class('label') }}
                    {{ html()->number('employee_no', $user->employee_no)->class('input')->required()->placeholder('Enter employee no...') }}
                </div>
            </div>

            <div class="columns">
                <div class="column is-6">
                    {{ html()->label('Mobile', 'phone')->class('label') }}
                    {{ html()->number('phone', $user->phone)->required()->class('input')->placeholder('Enter phone no...')->maxlength(11)->minlength(11) }}
                </div>
                <div class="column is-6">
                    {{ html()->label('Emergency mobile', 'emergency_phone')->class('label') }}
                    {{ html()->number('emergency_phone', $user->emergency_phone)->class('input')->required()->placeholder('Enter phone no...')->maxlength(11)->minlength(11) }}
                </div>
            </div>

            <div class="columns">
                <div class="column is-4">
                    {{ html()->label('Email', 'email')->class('label') }}
                    {{ html()->email('email', $user->email)->class('input')->placeholder('Enter email...') }}
                </div>
                <div class="column is-2">
                    {{ html()->label('Department', 'department')->class('label') }}
                    {{ html()->select('department', [
                        '' => 'Select a department',
                        'Accounts & Finance' => 'Accounts & Finance',
                        'Administration' => 'Administration',
                        'Maintenance' => 'Maintenance',
                        'Management' => 'Management',
                        'E-Commerce' => 'E-Commerce',
                        'Tourism' => 'Tourism',
                        'Technical' => 'Technical',
                        'HR' => 'HR',
                        'Office Staff' => 'Office Staff',
                    ], $user->department)->class('input is-small') }}
                </div>
                <div class="column is-3">
                    {{ html()->label('Designation', 'designation')->class('label') }}
                    {{ html()->select('designation', \App\Models\Designation::pluck('name', 'id'), $user->designation)->class('input is-small') }}
                </div>
                <div class="column is-3">
                    {{ html()->label('User Group', 'role')->class('label') }}
                    {{ html()->select('role', \App\Models\Role::pluck('name', 'id'), $user->role)->class('input is-small') }}
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            <input type="submit" name="basic_info" class="button is-success is-small" value="Save Changes"/>
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
