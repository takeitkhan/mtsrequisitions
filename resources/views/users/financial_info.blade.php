@extends('layouts.app')

@section('title')
    Financial Information
@endsection

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Financial Information',
            'spSubTitle' => 'Edit user financial information',
            'spShowTitleSet' => true
        ])

        @include('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => null,
            'spAddUrl' => route('users.create'),
            'spAllData' => route('users.index'),
            'spSearchData' => route('users.search'),
            'spTitle' => 'Users',
        ])

        @include('component.filter_set', [
            'spShowFilterSet' => true,
            'spPlaceholder' => 'Search user...',
            'spMessage' => $message = $message ?? NULL,
            'spStatus' => $status = $status ?? NULL
        ])
    </nav>
</section>

@section('column_left')
    <article class="panel is-primary">
        <p class="panel-tabs">
            <a href="{{ route('users.basic_info', $id) }}">Basic Information</a>
            <a href="{{ route('users.contact_info', $id) }}">Other Information</a>
            <a href="{{ route('users.user_photos', $id) }}">Images</a>
            <a href="{{ route('users.user_permissions', $id) }}">Permissions</a>
            <a href="{{ route('users.financial_info', $id) }}" class="is-active">Financial Information</a>
        </p>

        <div class="customContainer">
            {{ html()->form('POST', route('users.financial_info', $id))
                ->attribute('id', 'add_user')
                ->attribute('files', true)
                ->attribute('autocomplete', 'off')
                ->open() 
            }}

            <input type="hidden" name="_method" value="PATCH">
            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        {{ html()->label('Bank Information', 'bank_information')->class('label') }}
                        {{ html()->textarea('bank_information')
                            ->value($user->bank_information)
                            ->required()
                            ->class('textarea')
                            ->placeholder('Enter bank information...')
                        }}
                    </div>
                </div>
                <div class="column is-6">
                    <span class="field">
                        {{ html()->label('Mobile Banking Information', 'mbanking_information')->class('label') }}
                        @if(!empty($user->mbanking_information))
                            <a style="float:right"><span class="tag is-success is-small" id="addrow">Add More</span></a>
                        @endif

                        <div class="control" id="mobileBanking">
                            @if(!empty($user->mbanking_information))
                                @php $explodeBnakingInfo = explode(' | ', $user->mbanking_information) @endphp
                                @foreach($explodeBnakingInfo as $key => $data)
                                    @php $mBank = explode(' : ', $data) @endphp
                                    <div class="columns">
                                        <div class="column is-4">
                                            {{ html()->label('Select Mobile Banking', 'mobile_bank_method')->class('label') }}
                                            {{ html()->select('mobile_bank_method[]')
                                                ->options(['' => ''] + ['Nagad' => 'Nagad', 'Bkash' => 'Bkash', 'Rocket' => 'Rocket', 'Cash' => 'Cash', 'Cheque' => 'Cheque'])
                                                ->value($mBank[0] ?? NULL)
                                                ->required()
                                                ->class('input is-small')
                                            }}
                                        </div>
                                        <div class="column is-7">
                                            {{ html()->label('Number', 'mobile_bank_number')->class('label') }}
                                            {{ html()->number('mobile_bank_number[]')
                                                ->value($mBank[1] ?? NULL)
                                                ->required()
                                                ->class('input is-small')
                                            }}
                                        </div>
                                        <div class="column is-1">
                                            <label></label> <br/>
                                            <a><span class="tag is-danger is-small ibtnDel">Delete</span></a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="columns">
                                    <div class="column is-4">
                                        {{ html()->label('Select Mobile Banking', 'mobile_bank_method')->class('label') }}
                                        {{ html()->select('mobile_bank_method[]')
                                            ->options(['' => ''] + ['Nagad' => 'Nagad', 'Bkash' => 'Bkash', 'Rocket' => 'Rocket', 'Cash' => 'Cash', 'Cheque' => 'Cheque'])
                                            ->required()
                                            ->class('input is-small')
                                        }}
                                    </div>
                                    <div class="column is-7">
                                        {{ html()->label('Number', 'mobile_bank_number')->class('label') }}
                                        {{ html()->number('mobile_bank_number[]')
                                            ->required()
                                            ->class('input is-small')
                                        }}
                                    </div>
                                    <div class="column is-1">
                                        <label></label> <br/>
                                        <a><span class="tag is-success is-small" id="addrow">Add More</span></a>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </span>
                </div>
            </div>
            <div class="columns mb-2">
                <div class="column">
                    <div class="field is-grouped">
                        <div class="control">
                            {{ html()->submit('Save Changes')->class('button is-success is-small') }}
                        </div>
                    </div>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </article>
@endsection

@section('column_right')
@endsection

@section('cusjs')    
    <script>
        jQuery(document).ready(function ($) {
            $.noConflict();
            var counter = 1;
            $("#addrow").on("click", function () {
                var cols = '<div class="columns r' + counter + '">\
                    <div class="column is-4">\
                        <label for="bill_number" class="label">Select Mobile Banking</label>\
                        <select name="mobile_bank_method[]" id="" class="input is-small" required>\
                            <option> </option>\
                            <option value="Nagad">Nagad</option>\
                            <option value="Bkash">Bkash</option>\
                            <option value="Rocket">Rocket</option>\
                             <option value="Cash">Cash</option>\
                             <option value="Cheque">Cheque</option>\
                        </select>\
                    </div>\
                    <div class="column is-7">\
                        <label for="bill_number" class="label">Number</label>\
                        <input name="mobile_bank_number[]" type="number" value="" class="input is-small" required>\
                    </div>\
                    <div class="column is-1">\
                        <label></label> <br/>\
                        <a><span class="tag is-danger is-small ibtnDel">Delete</span></a>\
                    </div>\
                </div>';

                $("div#mobileBanking").append(cols);
                counter++;
            });

            $("div#mobileBanking").on("click", ".ibtnDel", function () {
                $(this).closest("#mobileBanking div.columns").remove();
                counter -= 1;
            });
        });
    </script>
@endsection
