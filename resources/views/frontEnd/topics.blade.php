@extends('frontEnd.layout')

@section('content')

    <!-- banner -->
    <div class="inside-banner">
        <div class="container">
            <span class="pull-right"><a href="{{ route('Home') }}"><i class="fa fa-home"></i></a> /
                @if(@$WebmasterSection!="none")
                    {!! trans('backLang.'.$WebmasterSection->name) !!}
                @elseif(@$search_word!="")
                    {{ @$search_word }}
                @else
                    {{ $User->name }}
                @endif
            </span>
            <h2>
                @if(@$search_word!="")
                    {{ @$search_word }}
                @elseif($CurrentCategory!="none")
                    @if(!empty($CurrentCategory))
                        <?php
                        $category_title_var = "title_" . trans('backLang.boxCode');
                        ?>
                        {{ $CurrentCategory->$category_title_var }}
                    @elseif(@$WebmasterSection!="none")
                        {!! trans('backLang.'.$WebmasterSection->name) !!}
                    @elseif(@$search_word!="")
                        {{ @$search_word }}
                    @else
                        {{ $User->name }}
                    @endif
                @endif
            </h2>
        </div>
    </div>
    <!-- banner -->

    <div class="container">
        <div class="listing spacer">


            <div class="row">
                @if(count($Categories)>0)
                    @include('frontEnd.includes.side')
                @endif
                <div class="col-lg-{{(count($Categories)>0)? "9":"12"}}">
                    @if($Topics->total() == 0)
                        <div class="alert alert-warning">
                            <i class="fa fa-info"></i> &nbsp; {{ trans('frontLang.noData') }}
                        </div>
                    @else
                        <div class="row">
                            @if($Topics->total() > 0)

                                <?php
                                $title_var = "title_" . trans('backLang.boxCode');
                                $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                $details_var = "details_" . trans('backLang.boxCode');
                                $details_var2 = "details_" . trans('backLang.boxCodeOther');
                                $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                                $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                                $i = 0;
                                ?>
                                @foreach($Topics as $Topic)
                                    <?php
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

                                    // set row div
                                    if (($i == 2 && count($Categories) > 0) || ($i == 3 && count($Categories) == 0)) {
                                        $i = 0;
                                        echo "</div><div class='row'>";
                                    }
                                    if ($Topic->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                        if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                            $topic_link_url = url(trans('backLang.code') . "/" . $Topic->$slug_var);
                                        } else {
                                            $topic_link_url = url($Topic->$slug_var);
                                        }
                                    } else {
                                        if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                            $topic_link_url = route('FrontendTopicByLang', ["lang" => trans('backLang.code'), "section" => $Topic->webmasterSection->name, "id" => $Topic->id]);
                                        } else {
                                            $topic_link_url = route('FrontendTopic', ["section" => $Topic->webmasterSection->name, "id" => $Topic->id]);
                                        }
                                    }
                                    ?>
                                    <div class="col-lg-{{(count($Categories)>0)? "6":"4"}}">
                                        <div class="item">
                                            <div class="image-holder">
                                                @if($Topic->webmasterSection->type==2 && $Topic->video_file!="")
                                                    @if($Topic->video_type ==1)
                                                        <?php
                                                        $Youtube_id = Helper::Get_youtube_video_id($Topic->video_file);
                                                        ?>
                                                        @if($Youtube_id !="")
                                                            {{-- Youtube Video --}}
                                                            <a class="video-popup"
                                                               href="https://www.youtube.com/watch?v={{ $Youtube_id }}"
                                                               title="{{ $title }}">
                                                                <img src="https://img.youtube.com/vi/{{ $Youtube_id }}/0.jpg"
                                                                     alt="{{ $title }}"/>
                                                            </a>
                                                        @endif
                                                    @elseif($Topic->video_type ==2)
                                                        <?php
                                                        $Vimeo_id = Helper::Get_vimeo_video_id($Topic->video_file);
                                                        ?>
                                                        @if($Vimeo_id !="")
                                                            {{-- Vimeo Video --}}
                                                            <?php
                                                            $data = file_get_contents("http://vimeo.com/api/v2/video/$Vimeo_id.json");
                                                            $data = json_decode($data);
                                                            ?>
                                                            <a class="video-popup"
                                                               href="http://vimeo.com/{{ $Vimeo_id }}"
                                                               title="{{ $title }}">
                                                                <img src="{{ $data[0]->thumbnail_medium }}"
                                                                     alt="{{ $title }}"/>
                                                            </a>
                                                        @endif

                                                    @elseif($Topic->video_type ==3)
                                                        <a href="{{ $topic_link_url }}">
                                                            @if($Topic->photo_file !="")
                                                                <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                                                     alt="{{ $title }}"/>
                                                            @endif
                                                        </a>
                                                    @else
                                                        <a class="video-popup"
                                                           href="{{ URL::to('uploads/topics/'.$Topic->video_file) }}"
                                                           title="{{ $title }}">
                                                            @if($Topic->photo_file !="")
                                                                <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                                                     alt="{{ $title }}"/>
                                                            @endif
                                                        </a>
                                                    @endif

                                                @elseif($Topic->webmasterSection->type==3 && $Topic->audio_file!="")
                                                    @if($Topic->photo_file !="")
                                                        <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                                             alt="{{ $title }}"/>
                                                    @else
                                                        <div dir="ltr">
                                                            <audio src="{{ URL::to('uploads/topics/'.$Topic->audio_file) }}"
                                                                   preload="auto" controls></audio>
                                                            <br><br>

                                                        </div>
                                                    @endif
                                                @elseif(count($Topic->photos)>0)
                                                    <a href="{{ $topic_link_url }}">
                                                        @if($Topic->photo_file !="")
                                                            <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                                                 alt="{{ $title }}"/>
                                                        @else
                                                            <img src="{{ URL::to('uploads/topics/'.$Topic->photos[0]->file) }}"
                                                                 alt="{{ $Topic->photos[0]->title  }}"/>
                                                        @endif
                                                    </a>
                                                @else
                                                    <a href="{{ $topic_link_url }}">
                                                        @if($Topic->photo_file !="")
                                                            <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                                                 alt="{{ $title }}"/>
                                                        @endif
                                                    </a>
                                                @endif


                                                <div class="status visits"><i
                                                            class="fa fa-eye"></i> {{ trans('frontLang.visits') }}
                                                    : {!! $Topic->visits !!}</div>
                                                @if($Topic->webmasterSection->comments_status)
                                                    <div class="status comments"><i
                                                                class="fa fa-comments"></i> {{ trans('frontLang.comments') }}
                                                        : {{count($Topic->approvedComments)}}</div>
                                                @else
                                                    <div class="status comments"><i
                                                                class="fa fa-user"></i> {{$Topic->user->name}}
                                                    </div>
                                                @endif

                                            </div>
                                            <h4>
                                                <a href="{{ $topic_link_url }}">
                                                    @if($Topic->icon !="")
                                                        <i class="fa {!! $Topic->icon !!} "></i>&nbsp;
                                                    @endif
                                                    {{ $title }}
                                                </a>
                                            </h4>

                                            {{--Additional Feilds--}}
                                            @if(count($Topic->webmasterSection->customFields) >0)
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-12 fields">
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

                                            @if(strip_tags($Topic->$details) !="")
                                                <p>
                                                    @if($Topic->webmasterSection->date_status)
                                                        <strong><i class="fa fa-calendar"></i> {!! $Topic->date  !!},
                                                        </strong>
                                                    @endif
                                                    {{ str_limit(strip_tags($Topic->$details), $limit = 200, $end = '...') }}


                                                </p>
                                                <a href="{{ $topic_link_url }}"
                                                   class="btn btn-primary">{{ trans('frontLang.readMore') }}</a>
                                            @endif
                                        </div>
                                    </div>

                                    <?php
                                    $i++;
                                    ?>
                                @endforeach

                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                {!! $Topics->links() !!}
                            </div>
                            <div class="col-lg-4 text-right">
                                <br>
                                <small>{{ $Topics->firstItem() }} - {{ $Topics->lastItem() }} {{ trans('backLang.of') }}
                                    ( {{ $Topics->total()  }} ) {{ trans('backLang.records') }}</small>
                            </div>
                        </div>
                    @endif
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection