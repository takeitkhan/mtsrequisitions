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
            'spMessage' => $message = $message ?? NULl,
            'spStatus' => $status = $status ?? NULL
        ])
    </nav>
</section>
@section('column_left')
    <article class="panel is-primary">
        <div class="customContainer">
            {{ html()->form('PUT', route('user-password.update'))
                ->attribute('id', 'add_user')
                ->attribute('files', true)
                ->attribute('autocomplete', 'off')
                ->open() 
            }}
            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        {{ html()->label('Password', 'password')->class('label') }}
                        <div class="control">
                            {{ html()->password('password')
                                ->class('input')
                                ->placeholder('Enter password...')
                                ->required() 
                            }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        {{ html()->label('Confirm Password', 'confirm_password')->class('label') }}
                        <div class="control">
                            {{ html()->password('confirm_password')
                                ->class('input')
                                ->placeholder('Enter confirm password...')
                                ->required()
                            }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            {{ html()->submit('Change')
                                ->class('button is-success is-small')
                            }}
                        </div>
                    </div>
                </div>
            </div>
            {!! html()->form()->close() !!}
        </div>
    </article>
@endsection

@section('column_right')
@endsection
