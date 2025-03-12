@section('header_button_set')
    <style>
        .margin_left_hidden_mobile {
            margin-left: 0.5rem;
        }
    </style>

    <div class="is-hidden-touch is-flex margin_left_hidden_mobile">
        <?php //echo buttonSet($spShowButtonSet ?? null, $spAddUrl ?? null, $spAllData ?? null, $spTitle ?? null, $spExportCSV ?? null, $spCss ?? null, $xspAllData ?? null, $xspTitle ?? null); ?>
    </div>
@endsection

<div class="column is-3">
    <?php echo buttonSet($spShowButtonSet ?? null, $spAddUrl ?? null, $spAllData ?? null, $spTitle ?? null, $spExportCSV ?? null, $spCss ?? null, $xspAllData ?? null, $xspTitle ?? null); ?>
</div>
