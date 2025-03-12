@extends('layouts.app')
@section('title', 'Create Project')

@if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id))
    @php $addUrl = route('projects.create'); @endphp
@else
    @php $addUrl = '#'; @endphp
@endif

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Create Project',
            'spSubTitle' => 'create a single project',
            'spShowTitleSet' => true
        ])

        @include('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => $addUrl,
            'spAllData' => route('projects.index'),
            'spSearchData' => route('projects.search'),
            'spTitle' => 'Projects',
        ])

        @include('component.filter_set', [
            'spShowFilterSet' => true,
            'spAddUrl' => route('projects.create'),
            'spAllData' => route('projects.index'),
            'spSearchData' => route('projects.search'),
            'spPlaceholder' => 'Search projects...',
            'spMessage' => $message ?? null,
            'spStatus' => $status ?? null
        ])
    </nav>
</section>

@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Project Information</a>
        </p>

        <div class="customContainer">
            {!! html()->form('POST', route('projects.store'))->attribute('id', 'add_route')->acceptsFiles()->open() !!}

            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        {{ html()->label('Project Name', 'name')->class('label') }}
                        <div class="control">
                            {{ html()->text('name', $project->name ?? null)->class('input')->placeholder('Enter project name...')->required() }}
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        {{ html()->label('Project Code', 'code')->class('label') }}
                        <div class="control">
                            {{ html()->text('code', $project->code ?? null)->class('input')->placeholder('Enter project code...')->required() }}
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        {{ html()->label('Project Type', 'type')->class('label') }}
                        <div class="control">
                            {{ html()->select('type', ['' => 'Select a project type', 'Recurring' => 'Recurring', 'Not Recurring' => 'Not Recurring'])->class('input is-small') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-9">
                    <div class="field">
                        {{ html()->label('Project Manager', 'manager')->class('label') }}
                        <div class="control">
                            @php
                                $managers = \App\Models\User::where('role', 3)
                                    ->whereNotIn('employee_status', ['Left Job', 'Terminated'])
                                    ->pluck('name', 'id')
                                    ->prepend('Select manager', '');
                            @endphp
                            {{ html()->select('manager', $managers, $project->manager ?? null)->class('input') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        {{ html()->label('Project Customer', 'customer')->class('label') }}
                        <div class="control">
                            {{ html()->text('customer', $project->customer ?? null)->class('input')->placeholder('Enter project customer...') }}
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        {{ html()->label('Project Vendor', 'vendor')->class('label') }}
                        <div class="control">
                            {{ html()->text('vendor', $project->vendor ?? null)->class('input')->placeholder('Enter project vendor...') }}
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        {{ html()->label('Project Supplier', 'supplier')->class('label') }}
                        <div class="control">
                            {{ html()->text('supplier', $project->supplier ?? null)->class('input')->placeholder('Enter project supplier...')->required() }}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        {{ html()->label('Project Start', 'start')->class('label') }}
                        <div class="control">
                            {{ html()->date('start', $project->start ?? null)->class('input') }}
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        {{ html()->label('Approximate Project End', 'end')->class('label') }}
                        <div class="control">
                            {{ html()->date('end', $project->end ?? null)->class('input') }}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="columns">
                <div class="column is-9">
                    <div class="field">
                        {{ html()->label('Project Summary', 'summary')->class('label') }}
                        <div class="control">
                            {{ html()->textarea('summary', $project->summary ?? null)->class('textarea')->placeholder('Enter project summary...')->required() }}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            {{ html()->button('Save Changes')->class('button is-success is-small')->type('submit') }}
                        </div>
                    </div>
                </div>
            </div>
            
            {!! html()->form()->close() !!}
        </div>
    </article>
@endsection