@extends('layouts.app')
@section('title')
    Change Password
@endsection

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Change Password',
            'spSubTitle' => 'set your new password',
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
    <div class="columns">
        <div class="column is-4"></div>
        <div class="column is-4">
            <article class="panel is-primary">
                <div class="customContainer">
                    {{ html()->form('PUT', route('users.update_password', auth()->user()->id))
                        ->attribute('id', 'add_user')
                        ->attribute('files', true)
                        ->attribute('autocomplete', 'off')
                        ->open() 
                    }}

                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                {{ html()->label('E-Mail Address', 'email')->class('label') }}
                                <div class="control">
                                    {{ html()->email('email')
                                        ->class('input ' . ($errors->has('email') ? 'is-invalid' : ''))
                                        ->value($user->email ?? '')
                                        ->attribute('readonly', true)
                                        ->required()
                                        ->autofocus()
                                    }}
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                {{ html()->label('Password', 'password')->class('label') }}
                                <div class="control">
                                    {{ html()->password('password')
                                        ->class('input ' . ($errors->has('password') ? 'is-invalid' : ''))
                                        ->required()
                                    }}
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                {{ html()->label('Confirm Password', 'password_confirmation')->class('label') }}
                                <div class="control">
                                    {{ html()->password('password_confirmation')
                                        ->class('input')
                                        ->required()
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            {{ html()->submit('Reset Password')->class('button is-success is-small') }}
                        </div>
                    </div>

                    {!! html()->form()->close() !!}
                </div>
            </article>
        </div>
        <div class="column is-4"></div>
    </div>
@endsection

@section('column_right')
@endsection
