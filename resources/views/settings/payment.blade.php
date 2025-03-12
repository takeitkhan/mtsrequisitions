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
            'spMessage' => $message = $message ?? NULl,
            'spStatus' => $status = $status ?? NULL
        ])
    </nav>
</section>


@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a href="{{ route('settings.global', 1) }}">
                <i class="fas fa-wrench"></i>&nbsp; Global Settings
            </a>
            <a href="{{ route('settings.payment', 2) }}" class="is-active">
                <i class="fas fa-dollar-sign"></i>&nbsp; Payment Settings
            </a>
            <a href="{{ route('settings.time', 3) }}">
                <i class="fas fa-clock"></i>&nbsp; Time Settings
            </a>
          
          	 <a href="{{ route('settings.other', 4) }}" class="">
                <i class="fas fa-envelope"></i>&nbsp; Email Settings
            </a>
          
          	 <a href="{{ route('settings.other', 5) }}">
                <i class="fas fa-cog"></i>&nbsp; Other Settings
            </a>
        </p>

        <div class="customContainer">
            {!! html()->form('POST', route('settings.payment', 2))
                ->attribute('id', 'add_user')
                ->attribute('files', true)
                ->attribute('autocomplete', 'off')
                ->open() !!}
            <div class="columns">
                <div class="column is-12">
                    <div class="field">

                        {{ html()->label('Settings Name', 'name')->class('label') }}
                        
                        <div class="control">
                            {!! html()->text('name', $setting->name ?? NULL)
                                ->required()
                                ->class('input')                                
                                ->placeholder('Enter setting name...') !!}
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
                <div class="column is-4">
                    <div class="field">
                        {{ html()->label('Company Name', 'company_name')->class('label') }}
                        <div class="control">
                            {{ html()->text('company_name', $fields->company_name ?? NULL)
                                ->required()
                                ->class('input')
                                ->placeholder('Enter company name...') }}
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        {{ html()->label('Company Slogan', 'company_slogan')->class('label') }}
                        <div class="control">
                            {{ html()->text('company_slogan', $fields->company_slogan ?? NULL)
                                ->class('input')
                                ->placeholder('Enter company slogan...') }}
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        {{ html()->label('Company Address', 'address')->class('label') }}
                        <div class="control">
                            {{ html()->text('address', $fields->address ?? NULL)
                                ->class('input')
                                ->placeholder('Enter address...') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-4">
                    <div class="field">
                        {{ html()->label('Company Phone', 'company_phone')->class('label') }}
                        <div class="control">
                            {{ html()->text('company_phone', $fields->company_phone ?? NULL)
                                ->class('input')
                                ->placeholder('Enter phone...') }}
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        {{ html()->label('Company Email', 'company_email')->class('label') }}
                        <div class="control">
                            {{ html()->text('company_email', $fields->company_email ?? NULL)
                                ->required()
                                ->class('input')
                                ->placeholder('Enter company email...') }}
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        {{ html()->label('Company Website', 'company_website')->class('label') }}
                        <div class="control">
                            {{ html()->text('company_website', $fields->company_website ?? NULL)
                                ->class('input')
                                ->placeholder('Enter company website...') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-success is-small">Save Changes</button>
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
