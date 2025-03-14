@extends('layouts.app')
@section('title', 'Edit Vehicle')

@if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id))
    @php $addUrl = route('vehicles.create'); @endphp
@else
    @php $addUrl = '#'; @endphp
@endif

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Edit Vehicle',
            'spSubTitle' => 'Edit a single vehicle',
            'spShowTitleSet' => true
        ])

        @include('component.button_set', [
            'spShowButtonSet' => true,
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
            'spMessage' => $message ?? null,
            'spStatus' => $status ?? null
        ])
    </nav>
</section>

@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Vehicle Information</a>
        </p>

        <div class="customContainer">
            {!! html()->form('PUT', route('vehicles.update', $vehicle->id))->id('add_route')->attribute('autocomplete', 'off')->open() !!}
            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        {!! html()->label('Name', 'name')->class('label') !!}
                        <div class="control">
                            {!! html()->text('name', $vehicle->name ?? '')->class('input')->placeholder('Enter name...') !!}
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        {!! html()->label('Vehicle Size', 'size')->class('label') !!}
                        <div class="control">
                            {!! html()->text('size', $vehicle->size ?? '')->class('input')->placeholder('Enter Vehicle Size...') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        {!! html()->label('Probably Cost', 'probably_cost')->class('label') !!}
                        <div class="control">
                            {!! html()->text('probably_cost', $vehicle->probably_cost ?? '')->class('input')->placeholder('Enter probably cost...') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            {!! html()->button('Save Changes')->class('button is-success is-small') !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! html()->form()->close() !!}
        </div>
    </article>
@endsection

@section('column_right')
    <article class="is-primary">
        <div class="box">
            <h1 class="title is-5">Important Note</h1>
            <p>
                Please select project manager and budget properly
            </p>
        </div>
    </article>
@endsection
