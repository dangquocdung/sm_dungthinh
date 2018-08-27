<div class="col-lg-3">
    <aside class="right-sidebar">


        @if(count($Categories)>0)
            <?php
            $category_title_var = "title_" . trans('backLang.boxCode');
            $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
            $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
            ?>
            <div class="widget">
                {{--<h5 class="widgetheading">{{ trans('frontLang.categories') }}</h5>--}}
                <ul class="list-group">
                    @foreach($Categories as $Category)
                        <?php $active_cat = ""; ?>
                        @if($CurrentCategory!="none")
                            @if(!empty($CurrentCategory))
                                @if($Category->id == $CurrentCategory->id)
                                    <?php $active_cat = "class=active"; ?>
                                @endif
                            @endif
                        @endif
                        <?php
                        $ccount = $category_and_topics_count[$Category->id];
                        if ($Category->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $Category_link_url = url(trans('backLang.code') . "/" . $Category->$slug_var);
                            } else {
                                $Category_link_url = url($Category->$slug_var);
                            }
                        } else {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $Category_link_url = route('FrontendTopicsByCatWithLang', ["lang" => trans('backLang.code'), "section" => $Category->webmasterSection->name, "cat" => $Category->id]);
                            } else {
                                $Category_link_url = route('FrontendTopicsByCat', ["section" => $Category->webmasterSection->name, "cat" => $Category->id]);
                            }
                        }
                        ?>
                        <li class="list-group-item">

                            <a {{ $active_cat }} href="{{ $Category_link_url }}">
                                @if($Category->icon !=="")
                                    <i class="fa {{$Category->icon}}"></i> &nbsp;
                                @endif
                                {{$Category->$category_title_var}}<span
                                        class="badge">{{ $ccount }}</span></a></li>
                        @foreach($Category->fatherSections as $MnuCategory)
                            <?php $active_cat = ""; ?>
                            @if($CurrentCategory!="none")
                                @if(!empty($CurrentCategory))
                                    @if($MnuCategory->id == $CurrentCategory->id)
                                        <?php $active_cat = "class=active"; ?>
                                    @endif
                                @endif
                            @endif
                            <?php
                            $ccount = $category_and_topics_count[$MnuCategory->id];
                            if ($MnuCategory->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                    $SubCategory_link_url = url(trans('backLang.code') . "/" . $MnuCategory->$slug_var);
                                } else {
                                    $SubCategory_link_url = url($MnuCategory->$slug_var);
                                }
                            } else {
                                if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                    $SubCategory_link_url = route('FrontendTopicsByCatWithLang', ["lang" => trans('backLang.code'), "section" => $MnuCategory->webmasterSection->name, "cat" => $MnuCategory->id]);
                                } else {
                                    $SubCategory_link_url = route('FrontendTopicsByCat', ["section" => $MnuCategory->webmasterSection->name, "cat" => $MnuCategory->id]);
                                }
                            }
                            ?>
                            <li class="list-group-item">
                                <a {{ $active_cat }}  href="{{ $SubCategory_link_url }}">
                                    @if($MnuCategory->icon !=="")
                                        <i class="fa {{$MnuCategory->icon}}"></i> &nbsp;
                                    @endif
                                    {{$MnuCategory->$category_title_var}}<span
                                            class="badge">{{ $ccount }}</span></a></li>
                        @endforeach

                    @endforeach
                </ul>
            </div>

        @endif

        <div class="widget  hidden-xs">
            <h5 class="widgetheading">{{ trans('backLang.search') }}</h5>
            {{Form::open(['route'=>['searchTopics'],'method'=>'POST','class'=>'form-search'])}}
            <div class="input-group">
                {!! Form::text('search_word',@$search_word, array('placeholder' => trans('frontLang.search'),'class' => 'form-control','id'=>'search_word','required'=>'')) !!}
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-theme"><i class="fa fa-search"></i></button>
                </span>
            </div>

            {{Form::close()}}
        </div>
        @if(count($TopicsMostViewed)>0)
            <?php
            $side_title_var = "title_" . trans('backLang.boxCode');
            $side_title_var2 = "title_" . trans('backLang.boxCodeOther');
            $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
            $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
            ?>
            <div class="hot-properties hidden-xs">
                <h4>{{ trans('frontLang.mostViewed') }}</h4>

                @foreach($TopicsMostViewed as $TopicMostViewed)
                    <?php
                    if ($TopicMostViewed->$side_title_var != "") {
                        $side_title = $TopicMostViewed->$side_title_var;
                    } else {
                        $side_title = $TopicMostViewed->$side_title_var2;
                    }
                    if ($TopicMostViewed->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                        if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                            $topic_link_url = url(trans('backLang.code') . "/" . $TopicMostViewed->$slug_var);
                        } else {
                            $topic_link_url = url($TopicMostViewed->$slug_var);
                        }
                    } else {
                        if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                            $topic_link_url = route('FrontendTopicByLang', ["lang" => trans('backLang.code'), "section" => $TopicMostViewed->webmasterSection->name, "id" => $TopicMostViewed->id]);
                        } else {
                            $topic_link_url = route('FrontendTopic', ["section" => $TopicMostViewed->webmasterSection->name, "id" => $TopicMostViewed->id]);
                        }
                    }
                    ?>
                    <div class="row">
                        <?php
                        $detal_w1 = 12;
                        $detal_w2 = 12;
                        ?>
                        @if($TopicMostViewed->photo_file !="")
                            <?php
                            $detal_w1 = 8;
                            $detal_w2 = 7;
                            ?>
                            <div class="col-lg-4 col-sm-5">
                                <a href="{{ $topic_link_url }}">
                                    <img src="{{ URL::to('uploads/topics/'.$TopicMostViewed->photo_file) }}"
                                         class="img-responsive img-circle" alt="{{ $side_title }}"/>
                                </a>
                            </div>
                        @elseif($TopicMostViewed->webmasterSection->type==2 && $TopicMostViewed->video_file!="")
                            <?php
                            $detal_w1 = 8;
                            $detal_w2 = 7;
                            ?>
                            <div class="col-lg-4 col-sm-5">
                                <a href="{{ $topic_link_url }}">
                                    @if($TopicMostViewed->video_type ==1)
                                        <?php
                                        $Youtube_id = Helper::Get_youtube_video_id($TopicMostViewed->video_file);
                                        ?>
                                        @if($Youtube_id !="")
                                            <img src="http://img.youtube.com/vi/{{$Youtube_id}}/0.jpg"
                                                 class="img-responsive img-circle" alt="{{ $side_title }}"/>
                                        @endif
                                    @elseif($TopicMostViewed->video_type ==2)
                                        <?php
                                        $Vimeo_id = Helper::Get_vimeo_video_id($TopicMostViewed->video_file);
                                        ?>
                                        @if($Vimeo_id !="")
                                            <?php
                                            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$Vimeo_id.php"));
                                            ?>

                                            <img src="{{ $hash[0]['thumbnail_large'] }}"
                                                 class="img-responsive img-circle" alt="{{ $side_title }}"/>
                                        @endif
                                    @endif
                                </a>
                            </div>
                        @endif

                        <div class="col-lg-{{ $detal_w1 }} col-sm-{{ $detal_w2 }}">
                            <h5><a href="{{ $topic_link_url }}">{{ $side_title }}</a></h5>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

            <?php
            // View side banners
            $BannersSettingsId = 3; // You can get settings ID from Webmaster >> Banners settings
            ?>
            @include('frontEnd.includes.banners')

    </aside>
</div>