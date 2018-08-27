@if(count($SliderBanners)>0)
    <div>
        @foreach($SliderBanners->slice(0,1) as $SliderBanner)
            <?php
            try {
                $SliderBanner_type = $SliderBanner->webmasterBanner->type;
            } catch (Exception $e) {
                $SliderBanner_type = 0;
            }
            ?>
        @endforeach
        <?php
        $title_var = "title_" . trans('backLang.boxCode');
        $details_var = "details_" . trans('backLang.boxCode');
        $file_var = "file_" . trans('backLang.boxCode');
        ?>
        @if($SliderBanner_type==0)
            {{-- Text/Code Banners--}}
            <div class="text-center">
                @foreach($SliderBanners as $SliderBanner)
                    @if($SliderBanner->$details_var !="")
                        <div>{!! $SliderBanner->$details_var !!}</div>
                    @endif
                @endforeach
            </div>
        @elseif($SliderBanner_type==1)
            <div id="slider" class="sl-slider-wrapper">

                <div class="sl-slider">

                    @foreach($SliderBanners as $SliderBanner)
                        <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25"
                             data-slice2-rotation="-25"
                             data-slice1-scale="2" data-slice2-scale="2">
                            <div class="sl-slide-inner">
                                <div class="bg-img"
                                     style="background-image: url({{ URL::to('uploads/banners/'.$SliderBanner->$file_var) }});"></div>
                                @if($SliderBanner->$details_var !="")
                                    <h2>{!! $SliderBanner->$title_var !!}</h2>
                                @endif
                                @if($SliderBanner->$details_var !="")
                                    <blockquote>
                                        <p>{!! nl2br($SliderBanner->$details_var) !!}</p>
                                        @if($SliderBanner->link_url !="")
                                            <a href="{!! $SliderBanner->link_url !!}"
                                               class="btn btn-theme">{{ trans('frontLang.moreDetails') }}</a>
                                        @endif
                                    </blockquote>
                                @endif

                            </div>
                        </div>
                    @endforeach

                </div><!-- /sl-slider -->


                <nav id="nav-dots" class="nav-dots">
                    <?php
                    $i = 0;
                    ?>
                    @foreach($SliderBanners as $SliderBanner)
                        @if($i == 0)
                            <span class="nav-dot-current"></span>
                        @else
                            <span></span>
                        @endif
                        <?php
                        $i++;
                        ?>
                    @endforeach
                </nav>

            </div><!-- /slider-wrapper -->
        @else
            {{-- Video Banners--}}
            <div class="text-center">
                @foreach($SliderBanners as $SliderBanner)
                    @if($SliderBanner->youtube_link !="")
                        @if($SliderBanner->video_type ==1)
                            <?php
                            $Youtube_id = Helper::Get_youtube_video_id($SliderBanner->youtube_link);
                            ?>
                            @if($Youtube_id !="")
                                {{-- Youtube Video --}}
                                <iframe width="100%" height="500" frameborder="0" allowfullscreen
                                        src="https://www.youtube.com/embed/{{ $Youtube_id }}">
                                </iframe>
                            @endif
                        @elseif($SliderBanner->video_type ==2)
                            <?php
                            $Vimeo_id = Helper::Get_vimeo_video_id($SliderBanner->youtube_link);
                            ?>
                            @if($Vimeo_id !="")
                                {{-- Vimeo Video --}}
                                <iframe width="100%" height="500" frameborder="0" allowfullscreen
                                        src="http://player.vimeo.com/video/{{ $Vimeo_id }}?title=0&amp;byline=0">
                                </iframe>
                            @endif
                        @endif
                    @endif
                    @if($SliderBanner->video_type ==0)
                        @if($SliderBanner->$file_var !="")
                            {{-- Direct Video --}}
                            <video width="100%" height="500" controls>
                                <source src="{{ URL::to('uploads/banners/'.$SliderBanner->$file_var) }}"
                                        type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    @endif
                    @if($SliderBanner->$details_var !="")
                        <div>{!! $SliderBanner->$details_var !!}</div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
@endif
