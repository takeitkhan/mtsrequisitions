@extends('layouts.app')

@section('title')
    Payment setting
@endsection

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Payment setting',
            'spSubTitle' => 'add or edit payment setting data',
            'spShowTitleSet' => true
        ])

        @include('component.button_set', [
            'spShowButtonSet' => false,
            'spAddUrl' => null,
            'spAllData' => route('settings.index'),
            'spSearchData' => null,
            'spExportCSV' => null,
        ])

        @include('component.filter_set', [
            'spShowFilterSet' => false,
            'spPlaceholder' => 'Search setting...',
            'spMessage' => $message ?? NULL,
            'spStatus' => $status ?? NULL
        ])
    </nav>
</section>

@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a href="{{ route('settings.global', 1) }}">
                <i class="fas fa-wrench"></i>&nbsp; Global Settings
            </a>
            <a href="{{ route('settings.payment', 2) }}">
                <i class="fas fa-dollar-sign"></i>&nbsp; Payment Settings
            </a>
            <a href="{{ route('settings.time', 3) }}">
                <i class="fas fa-clock"></i>&nbsp; Time Settings
            </a>
            <a href="{{ route('settings.email', 4) }}" class="is-active">
                <i class="fas fa-envelope"></i>&nbsp; Email Settings
            </a>
            <a href="{{ route('settings.other', 5) }}">
                <i class="fas fa-cog"></i>&nbsp; Other Settings
            </a>
        </p>

        <div class="customContainer">
            {!! html()->form('POST', route('settings.email', 4))
                ->id('add_user')
                ->autocomplete('off')
                ->open() 
            !!}

            
            <div class="columns">
                <div class="column is-12">
                    <div class="field">
                        {!! html()->label('Settings Name', 'name')->class('label') !!}
                        <div class="control">
                            {!! html()->text('name', $setting->name ?? NULL)
                                ->required()
                                ->class('input')
                                ->placeholder('Enter setting name...')
                            !!}
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (!empty($setting)) {
                $fields = json_decode($setting->settings);
            }
            ?>

            <div class="columns">
                <div class="column is-12">
                    <div class="field">
                        {!! html()->label('Email Address', 'email_address')->class('label') !!}
                        <div class="control">
                            {!! html()->textarea('email_address', $fields->email_address ?? NULL)
                                ->required()
                                ->class('input')
                                ->rows(2)
                                ->cols(40)
                                ->placeholder('Enter Email Address With | Seperator...')
                                ->attribute('style', 'height: auto !important')
                            !!}
                        </div>
                        <small class="lead">Example of Format: mail1 | mail2</small>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            {!! html()->button('Save Changes')->class('button is-success is-small')->type('submit') !!}
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