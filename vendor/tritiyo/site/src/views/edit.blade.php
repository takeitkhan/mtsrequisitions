@extends('layouts.app')

@section('title')
    Edit Site
@endsection

@if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id))
    @php
        $addUrl = route('sites.create');
    @endphp
@else
    @php
        $addUrl = '#';
    @endphp
@endif

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Edit Site',
            'spSubTitle' => 'Edit a single site',
            'spShowTitleSet' => true
        ])

        @include('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => $addUrl,
            'spAllData' => route('sites.index'),
            'spSearchData' => route('sites.search'),
            'spTitle' => 'Sites',
        ])

        @include('component.filter_set', [
            'spShowFilterSet' => true,
            'spAddUrl' => route('sites.create'),
            'spAllData' => route('sites.index'),
            'spSearchData' => route('sites.search'),
            'spPlaceholder' => 'Search sites...',
            'spMessage' => $message ?? NULL,
            'spStatus' => $status ?? NULL
        ])
    </nav>
</section>

@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a class="is-active">Site Information</a>
        </p>

        <div class="customContainer">
            {{-- Open form with enctype for file upload --}}
            {!! html()->form('PUT', route('sites.update', $site->id))
                ->id('add_route')
                ->attribute('enctype', 'multipart/form-data')  {{-- Adding enctype for file uploads --}}
                ->autocomplete('off')
                ->open() !!}
            
            <div class="columns">
                <div class="column is-3">
                    <div class="field">
                        {!! html()->label('Project')->for('project_id')->class('label') !!}
                        <div class="control">
                            <?php $projects = \Tritiyo\Project\Models\Project::pluck('name', 'id')->prepend('Select Project', ''); ?>
                            {!! html()->select('project_id', $projects, $site->project_id ?? NULL)
                                ->class('input is-small') !!}
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        {!! html()->label('Location')->for('location')->class('label') !!}
                        <div class="control">
                            <div class="select is-small">
                                <?php
                                $upazilas = \DB::table('upazilas')->get()->pluck('name', 'name');
                                ?>
                                {!! html()->select('location', $upazilas ?? NULL, $site->location ?? NULL)
                                    ->class('input')
                                    ->required() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        {!! html()->label('Site Code')->for('site_code')->class('label') !!}
                        <div class="control">
                            {!! html()->text('site_code', $site->site_code ?? NULL)
                                ->class('input is-small')
                                ->placeholder('Enter Site Code...') !!}
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        {!! html()->label('Limit Of Task')->for('task_limit')->class('label') !!}
                        <div class="control">
                            {!! html()->text('task_limit', $site->task_limit ?? NULL)
                                ->class('input is-small')
                                ->placeholder('Enter limit of task...') !!}
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        {!! html()->label('Completion Status')->for('completion_status')->class('label') !!}
                        <div class="control">
                            @php
                                $completion_statuses = ['' => '', 'Running' => 'Running', 'Rejected' => 'Rejected', 'Completed' => 'Completed', 'Pending' => 'Pending', 'Discard' => 'Discard'];
                            @endphp
                            {!! html()->select('completion_status', $completion_statuses, $site->completion_status ?? NULL)
                                ->class('input is-small')
                                ->required() !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Hidden field for budget --}}
            {!! html()->hidden('budget', $site->budget ?? NULL) !!}
            
            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            {!! html()->submit('Save Changes')->class('button is-success is-small') !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Close the form --}}
            {!! html()->form()->close() !!}
        </div>
    </article>
@endsection

@section('column_right')
    {{-- You can uncomment this if you want to add any important note or other content --}}
    {{-- <article class="is-primary">
        <div class="box">
            <h1 class="title is-5">Important Note</h1>
            <p>
                Please select project manager and budget properly
            </p>
        </div>
    </article> --}}
@endsection
