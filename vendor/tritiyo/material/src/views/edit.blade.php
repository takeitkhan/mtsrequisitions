@extends('layouts.app')

@section('title')
    Edit Material
@endsection

@if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id))
    @php
        $addUrl = route('materials.create');
    @endphp
@else
    @php
        $addUrl = '#';
    @endphp
@endif

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Edit Material',
            'spSubTitle' => 'Edit a single material',
            'spShowTitleSet' => true
        ])

        @include('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => $addUrl,
            'spAllData' => route('materials.index'),
            'spSearchData' => route('materials.search'),
        ])

        @include('component.filter_set', [
            'spShowFilterSet' => true,
            'spAddUrl' => route('materials.create'),
            'spAllData' => route('materials.index'),
            'spSearchData' => route('materials.search'),
            'spPlaceholder' => 'Search materials...',
            'spMessage' => $message ?? NULL,
            'spStatus' => $status ?? NULL
        ])
    </nav>
</section>

@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Material Information</a>
        </p>

        <div class="customContainer">
            {{-- Open form using Spatie HTML Form --}}
            {!! html()->form('PUT', route('materials.update', $material->id))
                ->id('add_route')
                ->open() !!}
            
            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        {!! html()->label('Name')->for('name')->class('label') !!}
                        <div class="control">
                            {!! html()->text('name', $material->name ?? null)
                                ->class('input')
                                ->placeholder('Enter Name...') !!}
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        {!! html()->label('Unit')->for('unit')->class('label') !!}
                        <div class="control">
                            {!! html()->text('unit', $material->unit ?? null)
                                ->class('input')
                                ->placeholder('Enter Material Unit...') !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            {!! html()->submit('Save Changes')->class('button is-success is-small') !!}
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Close form --}}
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
