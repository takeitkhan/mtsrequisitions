@extends('layouts.app')
@section('title')
    Create Vehicle
@endsection
@if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id))
    @php
        $addUrl = route('vehicles.create');
    @endphp
@else
    @php
        $addUrl = '#';
    @endphp
@endif
<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Create Vehicle',
            'spSubTitle' => 'create a single vehicle',
            'spShowTitleSet' => true
        ])

        @include('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => null,
            'spAddUrl' => $addUrl,
            'spAllData' => route('vehicles.index'),
            'spSearchData' => route('vehicles.search'),
            'spTitle' => 'Vehicles',
        ])

        @include('component.filter_set', [
            'spShowFilterSet' => true,
            'spAddUrl' => route('vehicles.create'),
            'spAllData' => route('vehicles.index'),
            'spSearchData' => route('vehicles.search'),
            'spPlaceholder' => 'Search vehicles...',
            'spMessage' => $message = $message ?? NULL,
            'spStatus' => $status = $status ?? NULL
        ])
    </nav>
</section>

@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Vehicle Information</a>
        </p>

        <div class="customContainer">
            {!! Html::form()
                ->attribute('action', route('vehicles.store'))
                ->method('POST')
                ->attribute('id', 'add_route')
                ->acceptsFiles()
                ->attribute('autocomplete', 'off')
                ->open() 
            !!}

            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        {!! Html::label('name', 'Name')->class('label') !!}
                        <div class="control">
                            {!! Html::input('text', 'name', $vehicle->name ?? null)
                                ->class('input')
                                ->placeholder('Enter name...') 
                            !!}
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        {!! Html::label('size', 'Vehicle Size')->class('label') !!}
                        <div class="control">
                            {!! Html::input('text', 'size', $vehicle->size ?? null)
                                ->class('input')
                                ->placeholder('Enter Vehicle Size...') 
                            !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        {!! Html::label('probably_cost', 'Probably Cost')->class('label') !!}
                        <div class="control">
                            {!! Html::input('text', 'probably_cost', $vehicle->probably_cost ?? null)
                                ->class('input')
                                ->placeholder('Enter probably cost...') 
                            !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            {!! Html::button('Save Changes')
                                ->class('button is-success is-small')
                                ->type('submit') 
                            !!}
                        </div>
                    </div>
                </div>
            </div>

            {!! Html::form()->close() !!}
        </div>
    </article>
@endsection

@section('column_right')
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
@endsection
