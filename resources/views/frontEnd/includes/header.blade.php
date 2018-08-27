<!-- Header Starts -->
<header>
<div class="navbar-wrapper">

    <div class="navbar-inverse" role="navigation">
        <div class="container">

            <div class="pull-left">

                @if(Helper::GeneralWebmasterSettings("dashboard_link_status"))
                    <span class="lang">
                                <a href="{{ route("adminHome") }}"><i
                                            class="fa fa-cog"></i> {{trans('frontLang.dashboard')}}
                                </a>
                            </span>
                @endif
                @if($WebmasterSettings->languages_ar_status  && $WebmasterSettings->languages_en_status )
                    <span class="lang">
                            @if(trans('backLang.code')=="ar")
                            <a href="{{ URL::to('lang/en') }}"><i
                                        class="fa fa-language "></i> {{ str_replace("[ ","",str_replace(" ]","",strip_tags(trans('backLang.englishBox')))) }}
                                </a>
                        @else
                            <a href="{{ URL::to('lang/ar') }}"><i
                                        class="fa fa-language "></i> {{ str_replace("[ ","",str_replace(" ]","",strip_tags(trans('backLang.arabicBox')))) }}
                                </a>
                        @endif

                        </span>
                @endif


            </div>
            <div class="navbar-header">


                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>


            <!-- Nav Starts -->
        @include('frontEnd.includes.menu')
        <!-- #Nav Ends -->

        </div>
    </div>

</div>
<!-- #Header Starts -->


<div class="container">

    <!-- Header Starts -->
    <div class="header">
        <a href="{{ route("Home") }}">
            @if(Helper::GeneralSiteSettings("style_logo_" . trans('backLang.boxCode')) !="")
                <img alt=""
                     src="{{ URL::to('uploads/settings/'.Helper::GeneralSiteSettings("style_logo_" . trans('backLang.boxCode'))) }}">
            @else
                <img alt="" src="{{ URL::to('uploads/settings/nologo.png') }}">
            @endif

        </a>

        @include('frontEnd.includes.menu2')
        <div class="pull-right head-contacts">
            @if(Helper::GeneralSiteSettings("contact_t3") !="")
                <i class="fa fa-phone"></i>  {!! trans('frontLang.callUs') !!}:
                <div>
                    <a
                            href="tel:{{ Helper::GeneralSiteSettings("contact_t5") }}"><h3
                                style="direction: ltr">{{ Helper::GeneralSiteSettings("contact_t5") }}</h3></a>
                </div>
            @endif
            @if(Helper::GeneralSiteSettings("contact_t6") !="")
                <div>
                    <span class="top-email"><a
                                href="mailto:{{ Helper::GeneralSiteSettings("contact_t6") }}">{{ Helper::GeneralSiteSettings("contact_t6") }}</a>
                    </span>
                </div>
            @endif
        </div>

    </div>
    <!-- #Header Starts -->
</div>
</header>