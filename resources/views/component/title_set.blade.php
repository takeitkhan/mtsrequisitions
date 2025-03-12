@section('header_title_set')
    <style>
        .navbar .level-item.is-5 strong,
        .navbar .level-item.is-5 {
            color: #fff;
            font-size: 17px;
        }
    </style>

    <div class="is-hidden-touch is-flex">
        <?php //echo titleSet($spShowTitleSet ?? null, $spTitle ?? null, $spSubTitle ?? null, $spStatus ?? null, $spMessage ?? null);?>
    </div>
@endsection



<div class="column is-5">
    <?php echo titleSet($spShowTitleSet ?? null, $spTitle ?? null, $spSubTitle ?? null, $spStatus ?? null, $spMessage ?? null); ?>
</div>