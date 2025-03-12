@extends('layouts.app')
@section('title', 'Create Site')

@if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id))
    @php $addUrl = route('sites.create'); @endphp
@else
    @php $addUrl = '#'; @endphp
@endif

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Create Site',
            'spSubTitle' => 'create a single site',
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
            {{ html()->form('POST', route('sites.store'))->id('add_route')->attribute('autocomplete', 'off')->open() }}
            <div class="columns">
                <div class="column is-4">
                    <div class="field">
                        {{ html()->label('Project', 'project_id')->class('label') }}
                        <div class="control">
                            <select name="project_id" class="input is-small" required>
                                <option value="">Select project</option>
                                @foreach(DB::select(DB::raw("SELECT * FROM (SELECT *, (SELECT project_status FROM project_ranges WHERE project_id = projects.id ORDER BY id DESC LIMIT 1) AS status FROM projects) AS filtered WHERE filtered.status = 'Active'")) as $project)
                                    <option value="{{ $project->id }}" {{ !empty($site->project_id) && $project->id == $site->project_id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        {{ html()->label('Location', 'location')->class('label') }}
                        <div class="control">
                            <div class="select is-small">
                                {{ html()->select('location', \DB::table('upazilas')->pluck('name', 'name'), $site->location ?? NULL)->class('input')->required() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        {{ html()->label('Site Code', 'site_code')->class('label') }}
                        <div class="control">
                            {{ html()->text('site_code', $site->site_code ?? NULL)->class('input is-small')->placeholder('Enter Site Code...') }}
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        {{ html()->label('Limit Of Task', 'task_limit')->class('label') }}
                        <div class="control">
                            {{ html()->text('task_limit', $site->task_limit ?? NULL)->class('input is-small')->placeholder('Enter limit of task...') }}
                        </div>
                    </div>
                </div>
            </div>
            {{ html()->hidden('budget', $site->budget ?? NULL) }}
            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            {{ html()->button('Save Changes')->class('button is-success is-small')->type('submit') }}
                        </div>
                    </div>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </article>
@endsection

@section('column_right')
    <article class="is-primary">
        <div class="box">
            <h1 class="title is-5">Important Note</h1>
            <p>
                The default password is stored in the database when the admin authority creates the user.<br/>
                Default password: <strong>bizradix@123</strong>
            </p>
            <br/>
            <p>
                After you provide the basic information, you create a list of users, now you will find the created user
                and update the information for your user.
            </p>
        </div>
    </article>
@endsection
