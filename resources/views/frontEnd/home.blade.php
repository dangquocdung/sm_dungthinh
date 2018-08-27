@extends('frontEnd.layout')

@section('content')

    <!-- start Home Slider -->
    @include('frontEnd.includes.slider')
    <!-- end Home Slider -->



    <div class="banner-search">
        <div class="container">
            <!-- banner -->
            <div class="searchbar">
                <div class="row">
                    <div class="col-lg-{{(count($TextBanners) ==2)? "4":"3"}}">
                        {{Form::open(['route'=>['searchTopics'],'method'=>'POST','class'=>'form-search'])}}
                        <div class="row">
                            <div class="col-lg-12">
                                <h3><i class="fa fa-search"></i> {{ trans('backLang.search') }}</h3>
                            </div>
                            <div class="col-lg-12 col-sm-12 ">
                                {{Form::open(['route'=>['searchTopics'],'method'=>'POST','class'=>'form-search'])}}
                                <div class="input-group">
                                    {!! Form::text('search_word',@$search_word, array('placeholder' => trans('frontLang.search'),'class' => 'form-control','id'=>'search_word','required'=>'')) !!}
                                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-theme"><i
                                class="fa fa-search"></i> {{ trans('backLang.search') }}</button>
                </span>
                                </div>
                            </div>
                        </div>
                        {{Form::close()}}

                    </div>
                        @if(count($TextBanners)>0)
                            @foreach($TextBanners->slice(0,1) as $TextBanner)
                                <?php
                                try {
                                    $TextBanner_type = $TextBanner->webmasterBanner->type;
                                } catch (Exception $e) {
                                    $TextBanner_type = 0;
                                }
                                ?>
                            @endforeach
                            <?php
                            $title_var = "title_" . trans('backLang.boxCode');
                            $details_var = "details_" . trans('backLang.boxCode');
                            $file_var = "file_" . trans('backLang.boxCode');

                            $col_width = 12;
                            if (count($TextBanners) == 2) {
                                $col_width = 4;
                            }
                            if (count($TextBanners) == 3) {
                                $col_width = 3;
                            }
                            if (count($TextBanners) > 3) {
                                $col_width = 3;
                            }
                            ?>
                                    @foreach($TextBanners as $TextBanner)
                                        <div class="col-lg-{{$col_width}}">
                                            <div class="box">
                                                <div class="aligncenter">
                                                    @if($TextBanner->code !="")
                                                        {!! $TextBanner->code !!}
                                                    @else
                                                        @if($TextBanner->$file_var !="")
                                                            <img src="{{ URL::to('uploads/banners/'.$TextBanner->$file_var) }}"
                                                                 alt="{{ $TextBanner->$title_var }}"/>
                                                        @endif
                                                        <h3>
                                                            @if($TextBanner->icon !="")
                                                                <i class="fa {{$TextBanner->icon}}"></i>
                                                            @endif
                                                            {!! $TextBanner->$title_var !!}</h3>
                                                        <p>
                                                            @if($TextBanner->$details_var !="")
                                                                {!! nl2br($TextBanner->$details_var) !!}
                                                            @endif

                                                            @if($TextBanner->link_url !="")
                                                                <br><a href="{!! $TextBanner->link_url !!}">{{ trans('frontLang.moreDetails') }}</a>
                                                            @endif
                                                        </p>
                                                    @endif

                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                        @endif

                </div>
            </div>
        </div>
    </div>
    <!-- banner -->
    <div class="container">
        @if(count($HomeTopics)>0)
            <?php
            $title_var = "title_" . trans('backLang.boxCode');
            $title_var2 = "title_" . trans('backLang.boxCodeOther');
            $details_var = "details_" . trans('backLang.boxCode');
            $details_var2 = "details_" . trans('backLang.boxCodeOther');
            $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
            $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
            $section_url = "";
            ?>
            @foreach($HomeTopics as $HomeTopic)
                <?php
                if ($HomeTopic->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                        $section_url = url(trans('backLang.code') . "/" . $HomeTopic->webmasterSection->$slug_var);
                    } else {
                        $section_url = url($HomeTopic->webmasterSection->$slug_var);
                    }
                } else {
                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                        $section_url = url(trans('backLang.code') . "/" . $HomeTopic->webmasterSection->name);
                    } else {
                        $section_url = url($HomeTopic->webmasterSection->name);
                    }
                }
                ?>
            @endforeach
            <div class="listing spacer"><a href="{{ url($section_url) }}"
                                           class="pull-right viewall">{{ trans('frontLang.viewMore') }}</a>
                <h2>{{ trans('frontLang.homeContents1Title') }}</h2>
                <div id="owl-example" class="owl-carousel owl-theme">
                    @foreach($HomeTopics as $HomeTopic)
                        <?php
                        if ($HomeTopic->$title_var != "") {
                            $title = $HomeTopic->$title_var;
                        } else {
                            $title = $HomeTopic->$title_var2;
                        }
                        if ($HomeTopic->$details_var != "") {
                            $details = $details_var;
                        } else {
                            $details = $details_var2;
                        }

                        if ($HomeTopic->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $topic_link_url = url(trans('backLang.code') . "/" . $HomeTopic->$slug_var);
                            } else {
                                $topic_link_url = url($HomeTopic->$slug_var);
                            }
                        } else {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $topic_link_url = route('FrontendTopicByLang', ["lang" => trans('backLang.code'), "section" => $HomeTopic->webmasterSection->name, "id" => $HomeTopic->id]);
                            } else {
                                $topic_link_url = route('FrontendTopic', ["section" => $HomeTopic->webmasterSection->name, "id" => $HomeTopic->id]);
                            }
                        }

                        ?>
                        <div class="item">
                            <div class="image-holder">
                                <a href="{{ $topic_link_url }}">
                                    @if($HomeTopic->webmasterSection->type==2 && $HomeTopic->video_file!="")
                                        @if($HomeTopic->video_type ==1)
                                            <?php
                                            $Youtube_id = Helper::Get_youtube_video_id($HomeTopic->video_file);
                                            ?>
                                            @if($Youtube_id !="")
                                                {{-- Youtube Video --}}
                                                <img src="https://img.youtube.com/vi/{{ $Youtube_id }}/0.jpg"
                                                     alt="{{ $title }}"/>
                                            @endif
                                        @elseif($HomeTopic->video_type ==2)
                                            <?php
                                            $Vimeo_id = Helper::Get_vimeo_video_id($HomeTopic->video_file);
                                            ?>
                                            @if($Vimeo_id !="")
                                                {{-- Vimeo Video --}}
                                                <?php
                                                $data = file_get_contents("http://vimeo.com/api/v2/video/$id.json");
                                                $data = json_decode($data);
                                                ?>
                                                <img src="{{ $data[0]->thumbnail_medium }}"
                                                     alt="{{ $title }}"/>
                                            @endif

                                        @elseif($HomeTopic->video_type ==3)
                                            @if($HomeTopic->photo_file !="")
                                                <img src="{{ URL::to('uploads/topics/'.$HomeTopic->photo_file) }}"
                                                     alt="{{ $title }}"/>
                                            @endif

                                        @else
                                            @if($HomeTopic->photo_file !="")
                                                <img src="{{ URL::to('uploads/topics/'.$HomeTopic->photo_file) }}"
                                                     alt="{{ $title }}"/>
                                            @endif
                                        @endif

                                    @elseif($HomeTopic->webmasterSection->type==3 && $HomeTopic->audio_file!="")
                                        @if($HomeTopic->photo_file !="")
                                            <img src="{{ URL::to('uploads/topics/'.$HomeTopic->photo_file) }}"
                                                 alt="{{ $title }}"/>
                                        @else
                                            <div>
                                                <br>
                                                <audio controls>
                                                    <source src="{{ URL::to('uploads/topics/'.$HomeTopic->audio_file) }}"
                                                            type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                                <br><br><br>

                                            </div>
                                        @endif
                                    @elseif(count($HomeTopic->photos)>0)
                                        @if($HomeTopic->photo_file !="")
                                            <img src="{{ URL::to('uploads/topics/'.$HomeTopic->photo_file) }}"
                                                 alt="{{ $title }}"/>
                                        @else
                                            <img src="{{ URL::to('uploads/topics/'.$HomeTopic->photos[0]->file) }}"
                                                 alt="{{ $HomeTopic->photos[0]->title  }}"/>
                                        @endif
                                    @else
                                        @if($HomeTopic->photo_file !="")
                                            <img src="{{ URL::to('uploads/topics/'.$HomeTopic->photo_file) }}"
                                                 alt="{{ $title }}"/>
                                        @endif
                                    @endif
                                </a>
                                <div class="status visits"><i
                                            class="fa fa-eye"></i> {{ trans('frontLang.visits') }}
                                    : {!! $HomeTopic->visits !!}</div>
                                @if($HomeTopic->webmasterSection->comments_status)
                                    <div class="status comments"><i
                                                class="fa fa-comments"></i> {{ trans('frontLang.comments') }}
                                        : {{count($HomeTopic->approvedComments)}}</div>
                                @else
                                    <div class="status comments"><i
                                                class="fa fa-user"></i> {{$HomeTopic->user->name}} </div>
                                @endif

                            </div>
                            <h4>
                                <a href="{{ $topic_link_url }}">
                                    @if($HomeTopic->icon !="")
                                        <i class="fa {!! $HomeTopic->icon !!} "></i>&nbsp;
                                    @endif
                                    {{ $title }}
                                </a>
                            </h4>

                            {{--Additional Feilds--}}
                            @if(count($HomeTopic->webmasterSection->customFields) >0)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12 fields">
                                            <?php
                                            $cf_title_var = "title_" . trans('backLang.boxCode');
                                            $cf_title_var2 = "title_" . trans('backLang.boxCodeOther');
                                            ?>
                                            @foreach($HomeTopic->webmasterSection->customFields as $customField)
                                                <?php
                                                if ($customField->$cf_title_var != "") {
                                                    $cf_title = $customField->$cf_title_var;
                                                } else {
                                                    $cf_title = $customField->$cf_title_var2;
                                                }


                                                $cf_saved_val = "";
                                                $cf_saved_val_array = array();
                                                if (count($HomeTopic->fields) > 0) {
                                                    foreach ($HomeTopic->fields as $t_field) {
                                                        if ($t_field->field_id == $customField->id) {
                                                            if ($customField->type == 7) {
                                                                // if multi check
                                                                $cf_saved_val_array = explode(", ", $t_field->field_value);
                                                            } else {
                                                                $cf_saved_val = $t_field->field_value;
                                                            }
                                                        }
                                                    }
                                                }

                                                ?>

                                                @if(($cf_saved_val!="" || count($cf_saved_val_array) > 0) && ($customField->lang_code == "all" || $customField->lang_code == trans('backLang.boxCode')))
                                                    @if($customField->type ==12)
                                                        {{--Vimeo Video Link--}}
                                                    @elseif($customField->type ==11)
                                                        {{--Youtube Video Link--}}
                                                    @elseif($customField->type ==10)
                                                        {{--Video File--}}
                                                    @elseif($customField->type ==9)
                                                        {{--Attach File--}}
                                                    @elseif($customField->type ==8)
                                                        {{--Photo File--}}
                                                    @elseif($customField->type ==7)
                                                        {{--Multi Check--}}
                                                    @elseif($customField->type ==6)
                                                        {{--Select--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-4">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <?php
                                                                $cf_details_var = "details_" . trans('backLang.boxCode');
                                                                $cf_details_var2 = "details_en" . trans('backLang.boxCodeOther');
                                                                if ($customField->$cf_details_var != "") {
                                                                    $cf_details = $customField->$cf_details_var;
                                                                } else {
                                                                    $cf_details = $customField->$cf_details_var2;
                                                                }
                                                                $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                                                                $line_num = 1;
                                                                ?>
                                                                @foreach ($cf_details_lines as $cf_details_line)
                                                                    @if ($line_num == $cf_saved_val)
                                                                        {!! $cf_details_line !!}
                                                                    @endif
                                                                    <?php
                                                                    $line_num++;
                                                                    ?>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==5)
                                                        {{--Date & Time--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-4">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-8">
                                                                {!! date('Y-m-d H:i:s', strtotime($cf_saved_val)) !!}
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==4)
                                                        {{--Date--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-4">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-8">
                                                                {!! date('Y-m-d', strtotime($cf_saved_val)) !!}
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==3)
                                                        {{--Email Address--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-4">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-8">
                                                                {!! $cf_saved_val !!}
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==2)
                                                        {{--Number--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-4">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-8">
                                                                {!! $cf_saved_val !!}
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==1)
                                                        {{--Text Area--}}
                                                    @else
                                                        {{--Text Box--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-4">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-8">
                                                                {!! $cf_saved_val !!}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{--End of -- Additional Feilds--}}

                            @if(strip_tags($HomeTopic->$details) !="")
                                <p>
                                    {{ str_limit(strip_tags($HomeTopic->$details), $limit = 100, $end = '...') }}
                                </p>
                            @endif
                            <a href="{{ $topic_link_url }}"
                               class="btn btn-primary">{{ trans('frontLang.readMore') }}</a>

                        </div>

                    @endforeach
                </div>
            </div>
        @endif
        <div class="spacer">
            <div class="row">
                <?php
                $wdth_col = 12;
                if (count($HomePartners) > 0) {
                    $wdth_col = 8;
                }
                ?>
                @if(count($HomePhotos)>0)
                    <div class="col-lg-{{$wdth_col}} recent-view">
                        @foreach($HomePhotos->slice(0, 1) as $HomeTopic)
                            <?php
                            if ($HomeTopic->$title_var != "") {
                                $title = $HomeTopic->$title_var;
                            } else {
                                $title = $HomeTopic->$title_var2;
                            }
                            if ($HomeTopic->$details_var != "") {
                                $details = $details_var;
                            } else {
                                $details = $details_var2;
                            }
                            ?>
                            <h3>
                                @if($HomeTopic->icon !="")
                                    <i class="fa {!! $HomeTopic->icon !!} "></i>&nbsp;
                                @endif
                                {{ $title }}
                            </h3>

                            <p class="text-justify">
                                {{ str_limit(strip_tags($HomeTopic->$details), $limit = 770, $end = '...') }} <a
                                        href="{{ url("topic/about") }}">{{ trans('frontLang.readMore') }}</a>
                            </p>
                            <br>

                        @endforeach
                    </div>
                @endif

                @if(count($HomePartners)>0)
                    <div class="col-lg-4 recommended">
                        <h3>{{ trans('frontLang.partners') }}</h3>
                        <div id="myCarousel" class="carousel slide">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0"
                                    class="active"></li>
                                <?php
                                $i = 0;
                                $ii2 = 0;
                                ?>

                                @foreach($HomePartners as $HomePartner)
                                    <?php
                                    if($ii2 == 4){
                                    $ii2 = 0;
                                    $i++;
                                    ?>
                                    <li data-target="#myCarousel" data-slide-to="{{$i}}"
                                        class=""></li>
                                    <?php
                                    }
                                    $ii2++;
                                    ?>
                                @endforeach
                            </ol>
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <?php
                                $ii = 0;
                                $ii2 = 0;
                                $title_var = "title_" . trans('backLang.boxCode');
                                $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                $details_var = "details_" . trans('backLang.boxCode');
                                $details_var2 = "details_" . trans('backLang.boxCodeOther');
                                $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                                $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                                $section_url = "";
                                ?>
                                <div class="item {{ ($ii==0)? "active":"" }}">
                                    <div class="row">
                                        @foreach($HomePartners as $HomePartner)
                                            <?php
                                            if ($HomePartner->$title_var != "") {
                                                $title = $HomePartner->$title_var;
                                            } else {
                                                $title = $HomePartner->$title_var2;
                                            }
                                            if ($HomePartner->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                                if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                    $section_url = url(trans('backLang.code') . "/" . $HomePartner->webmasterSection->$slug_var);
                                                } else {
                                                    $section_url = url($HomePartner->webmasterSection->$slug_var);
                                                }
                                            } else {
                                                if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                    $section_url = url(trans('backLang.code') . "/" . $HomePartner->webmasterSection->name);
                                                } else {
                                                    $section_url = url($HomePartner->webmasterSection->name);
                                                }
                                            }
                                            if($ii2 == 4){
                                            $ii2 = 0;
                                            ?>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">

                                        <?php

                                        $ii++;
                                        }
                                        ?>

                                        <div class="col-lg-6 col-xs-6">
                                            <div class="thumbnail">
                                                <img src="{{ URL::to('uploads/topics/'.$HomePartner->photo_file) }}"
                                                     data-placement="bottom" title="{{ $title }}"
                                                     alt="{{ $title }}">
                                            </div>
                                        </div>

                                        <?php
                                        $ii2++;
                                        ?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection