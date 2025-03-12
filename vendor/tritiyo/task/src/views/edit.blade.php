@extends('layouts.app')
@section('title')
    Edit Task
@endsection

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Edit Task',
            'spSubTitle' => 'Edit a single task',
            'spShowTitleSet' => true
        ])

        @include('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => null,
            'spAddUrl' => route('tasks.create'),
            'spAllData' => route('tasks.index'),
            'spSearchData' => route('tasks.search'),
            'spTitle' => 'Tasks',
        ])

        @include('component.filter_set', [
            'spShowFilterSet' => true,
            'spAddUrl' => route('tasks.create'),
            'spAllData' => route('tasks.index'),
            'spSearchData' => route('tasks.search'),
            'spPlaceholder' => 'Search tasks...',
            'spMessage' => $message = $message ?? NULl,
            'spStatus' => $status = $status ?? NULL
        ])
    </nav>
</section>
@section('column_left')

    <article class="panel is-primary">
        @include('task::layouts.tab')
        <div class="customContainer">
            {!! html()->form()
                ->attribute('action', route('tasks.update', $task->id))
                ->method('PUT')
                ->attribute('id', 'add_route')
                ->attribute('class', 'task_table')                
                ->attribute('autocomplete', 'off')
                ->open() 
            !!}            

            {{ html()->input('hidden', 'task_type', $task->task_type ?? '') }}
            {{ html()->input('hidden', 'task_assigned_to_head', $task->task_assigned_to_head != null ?? 'Yes') }}

            <div class="columns">

                <div class="column is-3">
                    <div class="field">
                        {{ html()->label('Project', 'project_id')->class('label')->style('display: inline-block') }}

                        <div class="control">
                            @if(auth()->user()->isManager(auth()->user()->id) || auth()->user()->isHR(auth()->user()->id))
                                <?php $projects = \Tritiyo\Project\Models\Project::where('manager', auth()->user()->id)->pluck('name', 'id')->prepend('Select Project', ''); ?>
                            @else
                                <?php $projects = \Tritiyo\Project\Models\Project::pluck('name', 'id')->prepend('Select Project', ''); ?>
                            @endif                            
                            {!! html()->select('project_id', $projects, $task->project_id ?? NULL)
                                    ->class('input')
                                    ->id('project_select')
                                !!}

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        {{ html()->label('Site Head', 'site_head')->class('label') }}
                        <div class="control">
                            <?php
                            $task_type = $task->task_type;
                            if($task_type == 'emergency') {
                                $date = date('Y-m-d');
                            } else {
                                $date = date("Y-m-d", strtotime("+1 day"));
                            }

                            $siteHead = \DB::select("SELECT * FROM (SELECT *,
                                    (SELECT site_head FROM tasks WHERE tasks.site_head = users.id AND tasks.task_for = '$date' LIMIT 0,1) AS site_head,
                                    (SELECT user_id FROM tasks WHERE tasks.site_head = users.id AND tasks.task_for = '$date' LIMIT 0,1) AS manager,
                                    (SELECT resource_id FROM tasks_site WHERE tasks_site.resource_id = users.id AND tasks_site.task_for = '$date' GROUP BY tasks_site.site_id LIMIT 0,1) AS resource_used,
                                    users.id AS useriddddd
                                FROM users WHERE users.role = 2 AND users.employee_status  NOT IN ( 'Terminated', 'Left Job', 'Long Leave', 'On Hold')
                            ) AS mm WHERE mm.site_head IS NULL AND mm.resource_used IS NULL");
                            ?>
                            <select class="input" name="site_head" id="sitehead_select">
                                <option value="{{ $task->site_head ?? NULL }}" selected>
                                    {{ \App\Models\User::where('id', $task->site_head)->first()->name ?? NULL }}
                                </option>
                                @foreach($siteHead as $resource)
                                    @php
                                        $count_result = \Tritiyo\Task\Helpers\TaskHelper::getPendingBillCountStatus($resource->id);
                                    @endphp
                                    <option
                                        data-result="{{ $count_result }}"
                                        value="{{ $resource->id }}" {{ $resource->id == $task->site_head ? 'selected=""' : NULL }}>
                                        {{ $resource->name ?? NULL }}
                                    </option>
                                @endforeach
                            </select>                            
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        {{ html()->label('Task Name', 'task_name')->class('label') }}
                        <div class="control">
                            {{ html()->input('text', 'task_name', $task->task_name ?? NULL)->class('input is-small')->placeholder('Enter Task Name...') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-9">
                    <div id="remaining_project_budget">

                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-9">
                    <div class="field">
                        {{ html()->label('Task Details', 'task_details')->class('label') }}
                        <div class="control">
                            {{ html()->textarea('task_details', $task->task_details ?? NULL)
                                    ->class('textarea')
                                    ->placeholder('Enter task details...')
                            }}

                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control button-save">
                            <button id="task_create_btn" class="button is-success is-small">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! html()->form()->close() !!}
        </div>
    </article>
@endsection


@section('column_right')
    @php
        $task = \Tritiyo\Task\Models\Task::where('id', $task->id)->first();
    @endphp

    @include('task::task_status_sidebar')
@endsection



@section('cusjs')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script>
        jQuery(document).ready(function($) {
            $.noConflict();
            
            $('#sitehead_select').select2({
                placeholder: "Select Head of Site",
                //allowClear: true
            });
            $('#project_select').select2({
                placeholder: "Select Project",
                //allowClear: true
            });
            $('select#sitehead_select').on('change', function () {
                $('button#task_create_btn').attr('style', 'display:none');
                var v = $(this).find(':selected').attr('data-result')
                if (v == 'Yes') {
                    alert('Your selected resource has atleast 3 pending bills. You can\'t select this resource.');
                    $('button#task_create_btn').attr('style', 'display:none');
                    //$("#project_select").select2().val(null).trigger("change");
                    $("#sitehead_select").select2().val(null).trigger("change");
                }
                if (v == 'No') {
                    $('button#task_create_btn').attr('style', 'display:block');
                }
            });
            //Remain Budget Balanace of a project
            $('#project_select').change(function(){
                $("button#task_create_btn").attr('style', 'display: none');
                //alert($(this).val());
                $(".tap2").show();
                $(".tap1").show();
                
                let projectId = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{route('project.remain.balance', '')}}/"+projectId,
                    success: function(data){
                    // console.log(data);
                        let html = '<div class="statusSuccessMessage is-warning mb-2" style="height: 26px; display: block; padding: 11px;">'
                        html += '<div class="columns">';
                        html += '<div class="column is-4 has-text-weight-bold">Total Balance BDT '+data.total;
                        html += '</div>';
                        html += '<div class="column is-4has-text-centered has-text-weight-bold">Usage Balance BDT '+data.usage;
                        html += '</div>';
                        html += '<div class="column is-4 has-text-right has-text-weight-bold">Remaining Balance BDT '+data.remain;
                        html += '</div>';
                        html += '</div></div>';
                        $(".tap2").hide();
                        $(".tap1").hide();
                        $("#remaining_project_budget").empty().append(html);
                            
                    
                    let projectLockPercent = "{{ \Tritiyo\Project\Helpers\ProjectHelper::projectLockPercentage() }}"; 
                    
                        if(data.usage * 100 / data.total >= projectLockPercent){
                            alert('Already you have used '+projectLockPercent+'% of budget. So you can not create any task under this project.')
                            $('a#closeBtn').click(function(e){
                                e.preventDefault();
                                $(".tap2").attr('style', 'display:none');
                                $(".tap1").attr('style', 'display:none');
                            })
                            $("#task_create_btn").attr('style', 'display: none');
                                $("#project_select").select2().val(null).trigger("change");
                                //$("#sitehead_select").select2().val(null).trigger("change");
                        } else {
                            $("#task_create_btn").attr('style', 'display: block');
                            //$(".control").attr('style', 'display: block');
                        }

                        if(data.total == 0){
                            alert('Budget has not assigned in this project yet');
                            $("#task_create_btn").attr('style', 'display: none');
                            $("#project_select").select2().val(null).trigger("change");
                            //$("#sitehead_select").select2().val(null).trigger("change");
                        } else {
                            //$("#task_create_btn").attr('style', 'display: block');
                        }
                    }
                });
            });

            
        });

    </script>





@endsection
