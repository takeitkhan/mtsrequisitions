@extends('layouts.app')
@section('title')
    Create Material
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
            'spTitle' => 'Create Material',
            'spSubTitle' => 'create a single material',
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
            'spMessage' => $message = $message ?? NULL,
            'spStatus' => $status = $status ?? NULL
        ])
    </nav>
</section>
@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Material Information</a>
        </p>

        <div class="customContainer">
            {!! html()->form('POST', route('materials.store'))->id('add_route')->attribute('autocomplete', 'off')->open() !!}
            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        {!! html()->label('Name', 'name')->class('label') !!}
                        <div class="control">
                            {!! html()->text('name', $material->name ?? '')->class('input')->placeholder('Enter material name...') !!}
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        {!! html()->label('Material Unit', 'unit')->class('label') !!}
                        <div class="control">
                            {!! html()->text('unit', $material->unit ?? '')->class('input')->placeholder('Enter Material Unit...') !!}
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
    </article>
@endsection
