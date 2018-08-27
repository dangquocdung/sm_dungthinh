@extends('frontEnd.layout')

@section('content')
    <?php
    $title_var = "title_" . trans('backLang.boxCode');
    $title_var2 = "title_" . trans('backLang.boxCodeOther');
    $details_var = "details_" . trans('backLang.boxCode');
    $details_var2 = "details_" . trans('backLang.boxCodeOther');
    if ($Topic->$title_var != "") {
        $title = $Topic->$title_var;
    } else {
        $title = $Topic->$title_var2;
    }
    if ($Topic->$details_var != "") {
        $details = $details_var;
    } else {
        $details = $details_var2;
    }
    $section = "";
    try {
        if ($Topic->section->$title_var != "") {
            $section = $Topic->section->$title_var;
        } else {
            $section = $Topic->section->$title_var2;
        }
    } catch (Exception $e) {
        $section = "";
    }
    ?>
    <!-- banner -->
    <div class="inside-banner">
        <div class="container">
            <span class="pull-right"><a href="{{ route('Home') }}"><i class="fa fa-home"></i></a> /
                @if(!empty($CurrentCategory))
                    {!! trans('backLang.'.$WebmasterSection->name) !!}
                @else
                    {!! trans('backLang.'.$WebmasterSection->name) !!}
                @endif
            </span>
            <h2>
                @if(!empty($CurrentCategory))
                    <?php
                    $category_title_var = "title_" . trans('backLang.boxCode');
                    ?>
                    {{ $CurrentCategory->$category_title_var }}
                @else
                    @if($WebmasterSection->name=="sitePages")
                        {{ $title }}
                    @else
                        {!! trans('backLang.'.$WebmasterSection->name) !!}
                    @endif
                @endif
            </h2>
        </div>
    </div>
    <!-- banner -->
    <div class="container">
        <div class="spacer">
            <div class="row">
                @if(count($Categories) >0)
                    @include('frontEnd.includes.side')
                @endif

                @if($WebmasterSection->name!="sitePages")
                    <div class="col-lg-{{(count($Categories)>0)? "9":"12"}}">
                        <h1 class="main-title">
                            @if($Topic->icon !="")
                                <i class="fa {!! $Topic->icon !!} "></i>&nbsp;
                            @endif
                            {{ $title }}
                        </h1>
                    </div>

                @endif
                <div class="col-lg-{{(count($Categories)>0)? "6":"9"}}">

                    <article>
                        @if($WebmasterSection->type==2 && $Topic->video_file!="")
                            {{--video--}}
                            <div class="post-video">
                                @if($Topic->video_type ==1)
                                    <?php
                                    $Youtube_id = Helper::Get_youtube_video_id($Topic->video_file);
                                    ?>
                                    @if($Youtube_id !="")
                                        {{-- Youtube Video --}}
                                        <div class="video-container">
                                            <iframe allowfullscreen
                                                    src="https://www.youtube.com/embed/{{ $Youtube_id }}?autoplay=1">
                                            </iframe>
                                        </div>
                                    @endif
                                @elseif($Topic->video_type ==2)
                                    <?php
                                    $Vimeo_id = Helper::Get_vimeo_video_id($Topic->video_file);
                                    ?>
                                    @if($Vimeo_id !="")
                                        {{-- Vimeo Video --}}
                                        <div class="video-container">
                                            <iframe allowfullscreen
                                                    src="http://player.vimeo.com/video/{{ $Vimeo_id }}?autoplay=1&title=0&amp;byline=0">
                                            </iframe>
                                        </div>
                                    @endif

                                @elseif($Topic->video_type ==3)
                                    @if($Topic->video_file !="")
                                        {{-- Embed Video --}}
                                        {!! $Topic->video_file !!}
                                    @endif

                                @else
                                    <video width="100%" height="350" controls autoplay>
                                        <source src="{{ URL::to('uploads/topics/'.$Topic->video_file) }}"
                                                type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif

                            </div>
                        @elseif($WebmasterSection->type==3 && $Topic->audio_file!="")
                            {{--audio--}}
                            <div class="post-video">
                                @if($Topic->photo_file !="")
                                    <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                         alt="{{ $title }}" title="{{ $title }}"/>
                                @endif
                                <div>
                                    <audio src="{{ URL::to('uploads/topics/'.$Topic->audio_file) }}" preload="auto"
                                           controls></audio>
                                </div>
                            </div>

                        @elseif($WebmasterSection->type==1 && count($Topic->photos)>0)
                            {{--photo pop up--}}
                            <div class="row">
                                <div class="photos-popup white-popup">
                                    @foreach($Topic->photos as $photo)
                                        <div class="col-lg-3 col-xs-6 mb20">
                                            <a href="{{ URL::to('uploads/topics/'.$photo->file) }}"
                                               title="{{ $title }}">
                                                <img src="{{ URL::to('uploads/topics/'.$photo->file) }}"
                                                     alt="{{ $photo->title  }}" style="height: 128px"/>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @elseif(count($Topic->photos)>0)
                            {{--photo slider--}}
                            <div>
                                <!-- Slider Starts -->
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators hidden-xs">
                                        <?php
                                        $i = 0;
                                        ?>
                                        @if($Topic->photo_file !="")
                                            <li data-target="#myCarousel" data-slide-to="{{ $i }}" class="active"></li>
                                            <?php
                                            $i++;
                                            ?>
                                        @endif
                                        @foreach($Topic->photos as $photo)
                                            <li data-target="#myCarousel" data-slide-to="{{ $i }}"
                                                class="{{ ($i==0)? "active":"" }}"></li>
                                            <?php
                                            $i++;
                                            ?>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        <?php
                                        $i = 0;
                                        ?>
                                        @if($Topic->photo_file !="")
                                            <div class="item active">
                                                <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                                     alt="{{ $title }}"/>
                                            </div>
                                            <?php
                                            $i++;
                                            ?>
                                        @endif
                                        @foreach($Topic->photos as $photo)
                                            <div class="item {{ ($i==0)? "active":"" }}">
                                                <img src="{{ URL::to('uploads/topics/'.$photo->file) }}"
                                                     alt="{{ $photo->title  }}"/>
                                            </div>
                                            <?php
                                            $i++;
                                            ?>
                                        @endforeach
                                    </div>
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span
                                                class="glyphicon glyphicon-chevron-left"></span></a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span
                                                class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                                <!-- #Slider Ends -->

                            </div>

                        @else
                            {{--one photo--}}
                            <div class="post-image">
                                @if($Topic->photo_file !="")
                                    <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                         alt="{{ $title }}" title="{{ $title }}"/>
                                @endif
                            </div>
                        @endif


                        {{--Additional Feilds--}}
                        @if(count($Topic->webmasterSection->customFields) >0)
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <?php
                                        $cf_title_var = "title_" . trans('backLang.boxCode');
                                        $cf_title_var2 = "title_" . trans('backLang.boxCodeOther');
                                        ?>
                                        @foreach($Topic->webmasterSection->customFields as $customField)
                                            <?php
                                            if ($customField->$cf_title_var != "") {
                                                $cf_title = $customField->$cf_title_var;
                                            } else {
                                                $cf_title = $customField->$cf_title_var2;
                                            }

                                            $cf_saved_val = "";
                                            $cf_saved_val_array = array();
                                            if (count($Topic->fields) > 0) {
                                                foreach ($Topic->fields as $t_field) {
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
                                                    <?php
                                                    $CF_Vimeo_id = Helper::Get_vimeo_video_id($cf_saved_val);
                                                    ?>
                                                    @if($CF_Vimeo_id !="")
                                                        <div class="row field-row">
                                                            <div>
                                                                {{-- Vimeo Video --}}
                                                                <iframe allowfullscreen style="height:350px;width: 100%"
                                                                        src="http://player.vimeo.com/video/{{ $CF_Vimeo_id }}?title=0&amp;byline=0">
                                                                </iframe>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @elseif($customField->type ==11)
                                                    {{--Youtube Video Link--}}

                                                    <?php
                                                    $CF_Youtube_id = Helper::Get_youtube_video_id($cf_saved_val);
                                                    ?>
                                                    @if($CF_Youtube_id !="")
                                                        <div class="row field-row">
                                                            <div>
                                                                {{-- Youtube Video --}}
                                                                <iframe allowfullscreen
                                                                        style="height: 350px;width: 100%"
                                                                        src="https://www.youtube.com/embed/{{ $CF_Youtube_id }}">
                                                                </iframe>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @elseif($customField->type ==10)
                                                    {{--Video File--}}
                                                    <div>
                                                        <div class="col-lg-12">
                                                            <video width="100%" height="350" controls>
                                                                <source src="{{ URL::to('uploads/topics/'.$cf_saved_val) }}"
                                                                        type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>
                                                    </div>
                                                @elseif($customField->type ==9)
                                                    {{--Attach File--}}
                                                    <div class="row field-row">
                                                        <div class="col-lg-3">
                                                            {!!  $cf_title !!} :
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <a href="{{ URL::to('uploads/topics/'.$cf_saved_val) }}"
                                                               target="_blank">
                                                                <span class="badge">
                                                                    {!! Helper::GetIcon(URL::to('uploads/topics/'),$cf_saved_val) !!}
                                                                    {!! $cf_saved_val !!}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @elseif($customField->type ==8)
                                                    {{--Photo File--}}
                                                    <div class="row field-row">
                                                        <div class="col-lg-3">
                                                            {!!  $cf_title !!} :
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <img src="{{ URL::to('uploads/topics/'.$cf_saved_val) }}"
                                                                 alt="{{ $cf_title }} - {{ $title }}"
                                                                 title="{{ $cf_title }} - {{ $title }}">
                                                        </div>
                                                    </div>
                                                @elseif($customField->type ==7)
                                                    {{--Multi Check--}}
                                                    <div class="row field-row">
                                                        <div class="col-lg-3">
                                                            {!!  $cf_title !!} :
                                                        </div>
                                                        <div class="col-lg-9">
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
                                                                @if (in_array($line_num,$cf_saved_val_array))
                                                                    <span class="badge">
                                                                            <i class="fa fa-check"></i>&nbsp;
                                                                        {!! $cf_details_line !!}
                                                        </span><br>
                                                                @endif
                                                                <?php
                                                                $line_num++;
                                                                ?>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @elseif($customField->type ==6)
                                                    {{--Select--}}
                                                    <div class="row field-row">
                                                        <div class="col-lg-3">
                                                            {!!  $cf_title !!} :
                                                        </div>
                                                        <div class="col-lg-9">
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
                                                        <div class="col-lg-3">
                                                            {!!  $cf_title !!} :
                                                        </div>
                                                        <div class="col-lg-9">
                                                            {!! date('Y-m-d H:i:s', strtotime($cf_saved_val)) !!}
                                                        </div>
                                                    </div>
                                                @elseif($customField->type ==4)
                                                    {{--Date--}}
                                                    <div class="row field-row">
                                                        <div class="col-lg-3">
                                                            {!!  $cf_title !!} :
                                                        </div>
                                                        <div class="col-lg-9">
                                                            {!! date('Y-m-d', strtotime($cf_saved_val)) !!}
                                                        </div>
                                                    </div>
                                                @elseif($customField->type ==3)
                                                    {{--Email Address--}}
                                                    <div class="row field-row">
                                                        <div class="col-lg-3">
                                                            {!!  $cf_title !!} :
                                                        </div>
                                                        <div class="col-lg-9">
                                                            {!! $cf_saved_val !!}
                                                        </div>
                                                    </div>
                                                @elseif($customField->type ==2)
                                                    {{--Number--}}
                                                    <div class="row field-row">
                                                        <div class="col-lg-3">
                                                            {!!  $cf_title !!} :
                                                        </div>
                                                        <div class="col-lg-9">
                                                            {!! $cf_saved_val !!}
                                                        </div>
                                                    </div>
                                                @elseif($customField->type ==1)
                                                    {{--Text Area--}}
                                                    <div class="row field-row">
                                                        <div class="col-lg-3">
                                                            {!!  $cf_title !!} :
                                                        </div>
                                                        <div class="col-lg-9">
                                                            {!! nl2br($cf_saved_val) !!}
                                                        </div>
                                                    </div>
                                                @else
                                                    {{--Text Box--}}
                                                    <div class="row field-row">
                                                        <div class="col-lg-3">
                                                            {!!  $cf_title !!} :
                                                        </div>
                                                        <div class="col-lg-9">
                                                            {!! $cf_saved_val !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endif
                        {{--End of -- Additional Feilds--}}


                        {!! $Topic->$details !!}
                        @if($Topic->attach_file !="")
                            <?php
                            $file_ext = strrchr($Topic->attach_file, ".");
                            $file_ext = strtolower($file_ext);
                            ?>
                            <div class="bottom-article">
                                @if($file_ext ==".jpg"|| $file_ext ==".jpeg"|| $file_ext ==".png"|| $file_ext ==".gif")
                                    <div class="text-center">
                                        <img src="{{ URL::to('uploads/topics/'.$Topic->attach_file) }}"
                                             alt="{{ $title }}"/>
                                    </div>
                                @else
                                    <a href="{{ URL::to('uploads/topics/'.$Topic->attach_file) }}">
                                        <strong>
                                            {!! Helper::GetIcon(URL::to('uploads/topics/'),$Topic->attach_file) !!}
                                            &nbsp;{{ trans('frontLang.downloadAttach') }}</strong>
                                    </a>
                                @endif
                            </div>
                        @endif

                        {{-- Show Additional attach files --}}
                        @if(count($Topic->attachFiles)>0)
                            <div class="attach-file">
                                @foreach($Topic->attachFiles as $attachFile)
                                    <?php
                                    if ($attachFile->$title_var != "") {
                                        $file_title = $attachFile->$title_var;
                                    } else {
                                        $file_title = $attachFile->$title_var2;
                                    }
                                    ?>
                                    <div style="margin-bottom: 5px;">
                                        <a href="{{ URL::to('uploads/topics/'.$attachFile->file) }}" target="_blank">
                                            <strong>
                                                {!! Helper::GetIcon(URL::to('uploads/topics/'),$attachFile->file) !!}
                                                &nbsp;{{ $file_title }}</strong>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif


                        @if(count($Topic->maps) >0)
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <h4><i class="fa fa-map-marker"></i> {{ trans('frontLang.locationMap') }}</h4>
                                    <div class="well">
                                        <div id="google-map"></div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if($WebmasterSection->comments_status)
                            <div id="comments">
                                @if(count($Topic->approvedComments)>0)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <br>
                                            <h4><i class="fa fa-comments"></i> {{ trans('frontLang.comments') }}</h4>
                                            <hr>
                                        </div>
                                    </div>
                                    @foreach($Topic->approvedComments as $comment)
                                        <?php
                                        $dtformated = date('d M Y h:i A', strtotime($comment->date));
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="white-bg">
                                                    <img src="{{ URL::to('uploads/contacts/profile.jpg') }}"
                                                         class="profile"
                                                         alt="{{$comment->name}}">
                                                    <div class="pullquote-left">
                                                        <strong>{{$comment->name}}</strong>
                                                        <div>
                                                            <small>
                                                                <small>{{ $dtformated }}</small>
                                                            </small>
                                                        </div>
                                                        {!! nl2br(strip_tags($comment->comment)) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif


                        @if($WebmasterSection->related_status)
                            @if(count($Topic->relatedTopics))
                                <div id="Related">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <br>
                                            <h4><i class="fa fa-bookmark"></i> {{ trans('backLang.relatedTopics') }}
                                            </h4>
                                            <div class="bottom-article">
                                                <?php
                                                $title_var = "title_" . trans('backLang.boxCode');
                                                $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                                $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                                                $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                                                ?>
                                                @foreach($Topic->relatedTopics as $relatedTopic)
                                                    <?php


                                                    if ($relatedTopic->topic->$title_var != "") {
                                                        $relatedTopic_title = $relatedTopic->topic->$title_var;
                                                    } else {
                                                        $relatedTopic_title = $relatedTopic->topic->$title_var2;
                                                    }

                                                    if ($relatedTopic->topic->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                                        if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {

                                                            $topic_link_url = url(trans('backLang.code') . "/" . $relatedTopic->topic->$slug_var);
                                                        } else {
                                                            $topic_link_url = url($relatedTopic->topic->$slug_var);
                                                        }
                                                    } else {
                                                        if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                            $topic_link_url = route('FrontendTopicByLang', ["lang" => trans('backLang.code'), "section" => $relatedTopic->topic->webmasterSection->name, "id" => $relatedTopic->topic->id]);
                                                        } else {
                                                            $topic_link_url = route('FrontendTopic', ["section" => $relatedTopic->topic->webmasterSection->name, "id" => $relatedTopic->topic->id]);
                                                        }
                                                    }
                                                    ?>
                                                    <div style="margin-bottom: 5px;">
                                                        <a href="{{ $topic_link_url }}"><i
                                                                    class="fa fa-bookmark-o"></i>&nbsp; {!! $relatedTopic_title !!}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                    </article>
                </div>
                <div class="col-lg-3">
                    <div>
                        <div class="topic-info">
                            <div class="info">
                                <i class="fa fa-user"></i> <a
                                        href="{{route('FrontendUserTopics',$Topic->created_by)}}">{{$Topic->user->name}}</a>
                            </div>
                            @if($WebmasterSection->date_status)
                                <div class="info">
                                    <i class="fa fa-calendar"></i> {!! $Topic->date  !!}
                                </div>
                            @endif
                            <div class="info">
                                <i class="fa fa-eye"></i> {{ trans('frontLang.visits') }} : {!! $Topic->visits !!}
                            </div>
                            @if($WebmasterSection->comments_status)
                                <div class="info">
                                    <i class="fa fa-comments"></i> {{ trans('frontLang.comments') }}
                                    : {{count($Topic->approvedComments)}}
                                </div>
                            @endif
                            <br>
                            {{ trans('frontLang.share') }} :
                            <ul class="social-network share">
                                <li><a href="{{ Helper::SocialShare("facebook", $PageTitle)}}" class="facebook"
                                       data-placement="top"
                                       title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{ Helper::SocialShare("twitter", $PageTitle)}}" class="twitter"
                                       data-placement="top" title="Twitter"
                                       target="_blank"><i
                                                class="fa fa-twitter"></i></a></li>
                                <li><a href="{{ Helper::SocialShare("google", $PageTitle)}}" class="google"
                                       data-placement="top"
                                       title="Google+"
                                       target="_blank"><i
                                                class="fa fa-google-plus"></i></a></li>
                                <li><a href="{{ Helper::SocialShare("linkedin", $PageTitle)}}" class="linkedin"
                                       data-placement="top" title="linkedin"
                                       target="_blank"><i
                                                class="fa fa-linkedin"></i></a></li>
                                <li><a href="{{ Helper::SocialShare("tumblr", $PageTitle)}}" class="pintrest"
                                       data-placement="top" title="Pinterest"
                                       target="_blank"><i
                                                class="fa fa-pinterest"></i></a></li>
                            </ul>

                        </div>

                    </div>


                    @if($WebmasterSection->order_status)
                        <div id="order">
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <h4><i class="fa fa-cart-plus"></i> {{ trans('frontLang.orderForm') }}</h4>
                                    <div class="newcomment">
                                        <div id="ordersendmessage"><i class="fa fa-check-circle"></i>
                                            &nbsp;{{ trans('frontLang.youOrderSent') }}
                                        </div>
                                        <div id="ordererrormessage">{{ trans('frontLang.youMessageNotSent') }}</div>

                                        {{Form::open(['route'=>['Home'],'method'=>'POST','class'=>'orderForm'])}}
                                        <div class="form-group">
                                            {!! Form::text('order_name',"", array('placeholder' => trans('frontLang.yourName'),'class' => 'form-control','id'=>'order_name', 'data-msg'=> trans('frontLang.enterYourName'),'data-rule'=>'minlen:4')) !!}
                                            <div class="alert alert-warning validation"></div>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::text('order_phone',"", array('placeholder' => trans('frontLang.phone'),'class' => 'form-control','id'=>'order_phone', 'data-msg'=> trans('frontLang.enterYourPhone'),'data-rule'=>'minlen:4')) !!}
                                            <div class="validation"></div>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::email('order_email',"", array('placeholder' => trans('frontLang.yourEmail'),'class' => 'form-control','id'=>'order_email', 'data-msg'=> trans('frontLang.enterYourEmail'),'data-rule'=>'email')) !!}
                                            <div class="validation"></div>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::number('order_qty',"", array('placeholder' => trans('frontLang.quantity'),'class' => 'form-control','id'=>'order_qty', 'data-msg'=> trans('frontLang.yourQuantity'),'data-rule'=>'minlen:1','min'=>'1')) !!}
                                            <div class="validation"></div>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::textarea('order_message','', array('placeholder' => trans('frontLang.notes'),'class' => 'form-control','id'=>'order_message','rows'=>'5')) !!}
                                            <div class="validation"></div>
                                        </div>

                                        @if(env('NOCAPTCHA_STATUS', false))
                                            <div class="form-group">
                                                {!! app('captcha')->display($attributes = [], $lang = trans('backLang.code')) !!}
                                            </div>
                                        @endif
                                        <div>
                                            <input type="hidden" name="topic_id" value="{{$Topic->id}}">
                                            <button type="submit"
                                                    class="btn btn-theme">{{ trans('frontLang.sendOrder') }}</button>
                                        </div>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif



                    @if($WebmasterSection->comments_status)
                        <div id="new-comment">
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <h4><i class="fa fa-plus"></i> {{ trans('frontLang.newComment') }}</h4>
                                    <div class="newcomment">
                                        <div id="sendmessage"><i class="fa fa-check-circle"></i>
                                            &nbsp;{{ trans('frontLang.youCommentSent') }} &nbsp; <a
                                                    href="{{url()->current()}}"><i
                                                        class="fa fa-refresh"></i> {{ trans('frontLang.refresh') }}
                                            </a>
                                        </div>
                                        <div id="errormessage">{{ trans('frontLang.youMessageNotSent') }}</div>

                                        {{Form::open(['route'=>['Home'],'method'=>'POST','class'=>'commentForm'])}}
                                        <div class="form-group">
                                            {!! Form::text('comment_name',"", array('placeholder' => trans('frontLang.yourName'),'class' => 'form-control','id'=>'comment_name', 'data-msg'=> trans('frontLang.enterYourName'),'data-rule'=>'minlen:4')) !!}
                                            <div class="alert alert-warning validation"></div>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::email('comment_email',"", array('placeholder' => trans('frontLang.yourEmail'),'class' => 'form-control','id'=>'comment_email', 'data-msg'=> trans('frontLang.enterYourEmail'),'data-rule'=>'email')) !!}
                                            <div class="validation"></div>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::textarea('comment_message','', array('placeholder' => trans('frontLang.comment'),'class' => 'form-control','id'=>'comment_message','rows'=>'5', 'data-msg'=> trans('frontLang.enterYourComment'),'data-rule'=>'required')) !!}
                                            <div class="validation"></div>
                                        </div>

                                        @if(env('NOCAPTCHA_STATUS', false))
                                            <div class="form-group">
                                                {!! app('captcha')->display($attributes = [], $lang = trans('backLang.code')) !!}
                                            </div>
                                        @endif
                                        <div>
                                            <input type="hidden" name="topic_id" value="{{$Topic->id}}">
                                            <button type="submit"
                                                    class="btn btn-theme">{{ trans('frontLang.sendComment') }}</button>
                                        </div>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>

            </div>
        </div>
    </div>

@endsection
@section('footerInclude')
    @if(count($Topic->maps) >0)
        @foreach($Topic->maps->slice(0,1) as $map)
            <?php
            $MapCenter = $map->longitude . "," . $map->latitude;
            ?>
        @endforeach
        <?php
        $map_title_var = "title_" . trans('backLang.boxCode');
        $map_details_var = "details_" . trans('backLang.boxCode');
        ?>
        <script type="text/javascript"
                src="http://maps.google.com/maps/api/js?key=AIzaSyAgzruFTTvea0LEmw_jAqknqskKDuJK7dM"></script>

        <script type="text/javascript">
            // var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
            var iconURLPrefix = "{{ URL::to('backEnd/assets/images/')."/" }}";
            var icons = [
                iconURLPrefix + 'marker_0.png',
                iconURLPrefix + 'marker_1.png',
                iconURLPrefix + 'marker_2.png',
                iconURLPrefix + 'marker_3.png',
                iconURLPrefix + 'marker_4.png',
                iconURLPrefix + 'marker_5.png',
                iconURLPrefix + 'marker_6.png'
            ]

            var locations = [
                    @foreach($Topic->maps as $map)
                ['<?php echo "<strong>" . $map->$map_title_var . "</strong>" . "<br>" . $map->$map_details_var; ?>', <?php echo $map->longitude; ?>, <?php echo $map->latitude; ?>, <?php echo $map->id; ?>, <?php echo $map->icon; ?>],
                @endforeach
            ];

            var map = new google.maps.Map(document.getElementById('google-map'), {
                zoom: 6,
                draggable: true,
                scrollwheel: false,
                center: new google.maps.LatLng(<?php echo $MapCenter; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    icon: icons[locations[i][4]],
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        </script>
    @endif
    <script type="text/javascript">

        jQuery(document).ready(function ($) {
            "use strict";

            @if($WebmasterSection->comments_status)
            //Comment
            $('form.commentForm').submit(function () {

                var f = $(this).find('.form-group'),
                    ferror = false,
                    emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

                f.children('input').each(function () { // run all inputs

                    var i = $(this); // current input
                    var rule = i.attr('data-rule');

                    if (rule !== undefined) {
                        var ierror = false; // error flag for current input
                        var pos = rule.indexOf(':', 0);
                        if (pos >= 0) {
                            var exp = rule.substr(pos + 1, rule.length);
                            rule = rule.substr(0, pos);
                        } else {
                            rule = rule.substr(pos + 1, rule.length);
                        }

                        switch (rule) {
                            case 'required':
                                if (i.val() === '') {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'minlen':
                                if (i.val().length < parseInt(exp)) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'email':
                                if (!emailExp.test(i.val())) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'checked':
                                if (!i.attr('checked')) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'regexp':
                                exp = new RegExp(exp);
                                if (!exp.test(i.val())) {
                                    ferror = ierror = true;
                                }
                                break;
                        }
                        i.next('.validation').html('<i class=\"fa fa-info\"></i> &nbsp;' + ( ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'wrong Input') : '' )).show();
                        !ierror ? i.next('.validation').hide() : i.next('.validation').show();
                    }
                });
                f.children('textarea').each(function () { // run all inputs

                    var i = $(this); // current input
                    var rule = i.attr('data-rule');

                    if (rule !== undefined) {
                        var ierror = false; // error flag for current input
                        var pos = rule.indexOf(':', 0);
                        if (pos >= 0) {
                            var exp = rule.substr(pos + 1, rule.length);
                            rule = rule.substr(0, pos);
                        } else {
                            rule = rule.substr(pos + 1, rule.length);
                        }

                        switch (rule) {
                            case 'required':
                                if (i.val() === '') {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'minlen':
                                if (i.val().length < parseInt(exp)) {
                                    ferror = ierror = true;
                                }
                                break;
                        }
                        i.next('.validation').html('<i class=\"fa fa-info\"></i> &nbsp;' + ( ierror ? (i.attr('data-msg') != undefined ? i.attr('data-msg') : 'wrong Input') : '' )).show();
                        !ierror ? i.next('.validation').hide() : i.next('.validation').show();
                    }
                });
                if (ferror) return false;
                else var str = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo route("commentSubmit"); ?>",
                    data: str,
                    success: function (msg) {
                        if (msg == 'OK') {
                            $("#sendmessage").addClass("show");
                            $("#errormessage").removeClass("show");
                            $("#comment_name").val('');
                            $("#comment_email").val('');
                            $("#comment_message").val('');
                        }
                        else {
                            $("#sendmessage").removeClass("show");
                            $("#errormessage").addClass("show");
                            $('#errormessage').html(msg);
                        }

                    }
                });
                return false;
            });
            @endif

            @if($WebmasterSection->order_status)

            //Order
            $('form.orderForm').submit(function () {

                var f = $(this).find('.form-group'),
                    ferror = false,
                    emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

                f.children('input').each(function () { // run all inputs

                    var i = $(this); // current input
                    var rule = i.attr('data-rule');

                    if (rule !== undefined) {
                        var ierror = false; // error flag for current input
                        var pos = rule.indexOf(':', 0);
                        if (pos >= 0) {
                            var exp = rule.substr(pos + 1, rule.length);
                            rule = rule.substr(0, pos);
                        } else {
                            rule = rule.substr(pos + 1, rule.length);
                        }

                        switch (rule) {
                            case 'required':
                                if (i.val() === '') {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'minlen':
                                if (i.val().length < parseInt(exp)) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'email':
                                if (!emailExp.test(i.val())) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'checked':
                                if (!i.attr('checked')) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'regexp':
                                exp = new RegExp(exp);
                                if (!exp.test(i.val())) {
                                    ferror = ierror = true;
                                }
                                break;
                        }
                        i.next('.validation').html('<i class=\"fa fa-info\"></i> &nbsp;' + ( ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'wrong Input') : '' )).show();
                        !ierror ? i.next('.validation').hide() : i.next('.validation').show();
                    }
                });
                if (ferror) return false;
                else var str = $(this).serialize();
                var xhr = $.ajax({
                    type: "POST",
                    url: "<?php echo route("orderSubmit"); ?>",
                    data: str,
                    success: function (msg) {
                        if (msg == 'OK') {
                            $("#ordersendmessage").addClass("show");
                            $("#ordererrormessage").removeClass("show");
                            $("#order_name").val('');
                            $("#order_phone").val('');
                            $("#order_email").val('');
                            $("#order_qty").val('');
                            $("#order_message").val('');
                        }
                        else {
                            $("#ordersendmessage").removeClass("show");
                            $("#ordererrormessage").addClass("show");
                            $('#ordererrormessage').html(msg);
                        }

                    }
                });
                //console.log(xhr);
                return false;
            });

            @endif
        });
    </script>

@endsection