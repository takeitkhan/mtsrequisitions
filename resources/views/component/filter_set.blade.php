@if(!empty($spShowFilterSet) && $spShowFilterSet == true)
    <div class="column is-2">
        <div style="display: inline-block; float: right; margin-top: 0px;">
            <div class="level-rights">
                <div class="control">

                    {!! html()->form('GET', $spSearchData ?? NULL)
                        ->id('search')
                        ->attribute('autocomplete', 'off')
                        ->open() !!}

                    <div class="sb-example-1">
                        <div class="search">
                            {!! html()->input('text', 'key', request()->get('key'))
                                ->id('textboxID')
                                ->class('searchTerm')
                                ->placeholder('What are you looking for?') !!}
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>

                    {!! html()->form()->close() !!}

                </div>
            </div>
        </div>
        <script type="text/javascript">
            document.getElementById('textboxID').select();
        </script>
    </div>
@endif
