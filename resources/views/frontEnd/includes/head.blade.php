<meta charset="utf-8">
<title>{{$PageTitle}} {{($PageTitle !="")? "|":""}} {{ Helper::GeneralSiteSettings("site_title_" . trans('backLang.boxCode')) }}</title>
<meta name="description" content="{{$PageDescription}}"/>
<meta name="keywords" content="{{$PageKeywords}}"/>
<meta name="author" content="{{ URL::to('') }}"/>

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<link rel="stylesheet" href="{{ URL::asset('frontEnd/js/bootstrap/css/bootstrap.css') }}"/>
<link rel="stylesheet" href="{{ URL::asset('frontEnd/css/font-awesome.css') }}"/>
<link rel="stylesheet" href="{{ URL::asset('frontEnd/css/style.css') }}"/>
<link rel="stylesheet" href="{{ URL::asset('frontEnd/css/audio-player.css') }}"/>
<!-- Owl stylesheet -->
<link rel="stylesheet" href="{{ URL::asset('frontEnd/js/owl-carousel/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('frontEnd/js/owl-carousel/assets/owl.theme.default.min.css') }}">
<!-- Owl stylesheet -->
<!-- slitslider -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('frontEnd/js/slitslider/css/style.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('frontEnd/js/slitslider/css/custom.css') }}"/>
<!-- slitslider -->

<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="{{ URL::asset('frontEnd/js/magnific-popup/magnific-popup.css') }}">

@if( trans('backLang.direction')=="rtl")
    <link href="{{ URL::asset('frontEnd/css/rtl.css') }}" rel="stylesheet"/>
@endif

<!-- Favicon and Touch Icons -->
@if(Helper::GeneralSiteSettings("style_fav") !="")
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_fav")) }}" rel="shortcut icon"
          type="image/png">
@else
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="shortcut icon" type="image/png">
@endif
@if(Helper::GeneralSiteSettings("style_apple") !="")
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="72x72">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="114x114">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="144x144">
@else
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="144x144">
@endif
<script type="text/javascript">
    var page_dir = "{{ trans('backLang.direction') }}";
</script>

{{-- Google Tags and google analytics --}}
@if($WebmasterSettings->google_tags_status && $WebmasterSettings->google_tags_id !="")
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{!! $WebmasterSettings->google_tags_id !!}');</script>
    <!-- End Google Tag Manager -->
@endif