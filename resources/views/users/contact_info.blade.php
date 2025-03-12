@extends('layouts.app')
@section('title')
    Other Information
@endsection

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Other Information',
            'spSubTitle' => 'Edit user other information',
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
            'spMessage' => $message = $message ?? NULL,
            'spStatus' => $status = $status ?? NULL
        ])
    </nav>
</section>
@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a href="{{ route('users.basic_info', $id) }}">Basic Information</a>
            <a href="{{ route('users.contact_info', $id) }}" class="is-active">Other Information</a>
            <a href="{{ route('users.user_photos', $id) }}">Images</a>
            <a href="{{ route('users.user_permissions', $id) }}">Permissions</a>
            <a href="{{ route('users.financial_info', $id) }}">Financial Information</a>
        </p>

        <div class="customContainer">
            {{ html()->form('POST', route('users.contact_info', $id))
                ->attribute('id', 'add_user')
                ->attribute('method', 'PATCH')
                ->attribute('files', true)
                ->attribute('autocomplete', 'off')
                ->open() }}

            <div class="columns">
                <div class="column is-4">
                    <div class="field">
                        <strong>Personal Information</strong>
                    </div>


                    {{ html()->label('Join Date', 'join_date')->class('label') }}
                    {{ html()->date('join_date', $user->join_date)->required()->class('input')->placeholder('Enter join_date...') }}

                    {{ html()->label('Employee Status', 'employee_status')->class('label') }}
                    <div class="select">
                        {{ html()->select('employee_status', ['' => 'Select status', 'Enroll' => 'Enroll', 'Terminated' => 'Terminated', 'Long Leave' => 'Long Leave', 'Left Job' => 'Left Job', 'On Hold'], $user->employee_status)->required()->class('input') }}
                    </div>

                    {{ html()->label('Father Name', 'father')->class('label') }}
                    {{ html()->text('father', $user->father)->class('input')->placeholder('Enter father name...') }}

                    {{ html()->label('Mother Name', 'mother')->class('label') }}
                    {{ html()->text('mother', $user->mother)->class('input')->placeholder('Enter mother name...') }}

                    {{ html()->label('Permanent Address', 'address')->class('label') }}
                    {{ html()->textarea('address', $user->address)->class('textarea')->rows(2) }}

                    {{ html()->label('Post Code', 'postcode')->class('label') }}
                    {{ html()->number('postcode', $user->postcode)->class('input') }}

                    {{ html()->label('District', 'district')->class('label') }}
                    <div class="control">
                        <div class="select">
                            <?php
                            $districts = \DB::table('districts')->get()->pluck('name', 'name');
                            ?>
                            {{ html()->select('district', $districts ?? NULL, $user->district)->class('input') }}
                        </div>
                    </div>

                    {{ html()->label('Gender', 'gender')->class('label') }}
                    {{ html()->select('gender', ['' => 'Select gender', 'Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'], $user->gender)->class('input') }}

                    {{ html()->label('Marital Status', 'marital_status')->class('label') }}
                    {{ html()->select('marital_status', ['' => 'Select marital status', 'Married' => 'Married', 'Unmarried' => 'Unmarried', 'Other' => 'Other'], $user->marital_status)->class('input') }}

                    {{ html()->label('Birthday', 'birthday')->class('label') }}
                    {{ html()->date('birthday', $user->birthday)->class('input')->placeholder('Enter birthday...') }}

                    {{ html()->label('Alternative Email', 'alternative_email')->class('label') }}
                    {{ html()->text('alternative_email', $user->alternative_email)->class('input')->type('email')->placeholder('Enter email...') }}

                    {{ html()->label('Basic Salary', 'basic_salary')->class('label') }}
                    {{ html()->text('basic_salary', $user->basic_salary)->class('input')->placeholder('Enter basic_salary...') }}
                </div>
                <div class="column is-4">
                    <div class="field">
                        <strong>Old Company Information</strong>
                    </div>

                    {{ html()->label('Company Name', 'company')->class('label') }}
                    {{ html()->text('company', $user->company)->class('input')->placeholder('Enter company name...') }}

                    {{ html()->label('Company Address', 'company_address')->class('label') }}
                    {{ html()->textarea('company_address', $user->company_address)->class('textarea')->rows(5) }}

                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            <input type="submit"
                                   name="contact_info"
                                   class="button is-success is-small"
                                   value="Save Changes"/>
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
