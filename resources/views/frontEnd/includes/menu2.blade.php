@if(env('menu2Id', 19) >0)
    <?php
    // Get list of footer menu links by group Id
    $Menu2Links = Helper::MenuList(env('menu2Id', 19));
    ?>
    @if(count($Menu2Links)>0)

        <?php
        $link_title_var = "title_" . trans('backLang.boxCode');
        $main_title_var = "FooterMenuLinks_name_" . trans('backLang.boxCode');
        $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
        $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
        $category_title_var = "title_" . trans('backLang.boxCode');
        ?>
        <ul class="pull-right menu2">
            @foreach($Menu2Links as $Menu2Link)
                @if($Menu2Link->type==3)
                    {{-- Section with drop list --}}
                    <li>
                        <div class="dropdown show">
                            <a class="btn btn-primary menu-btn dropdown-toggle" href="#" role="button"
                               id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">{{ $Menu2Link->$link_title_var }} <i class="fa fa-angle-down"></i></a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @foreach($Menu2Link->webmasterSection->sections as $MnuCategory)
                                    @if($MnuCategory->father_id ==0)

                                        <?php
                                        if ($MnuCategory->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $Category_link_url = url(trans('backLang.code') . "/" . $MnuCategory->$slug_var);
                                            } else {
                                                $Category_link_url = url($MnuCategory->$slug_var);
                                            }
                                        } else {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $Category_link_url = route('FrontendTopicsByCatWithLang', ["lang" => trans('backLang.code'), "section" => $Menu2Link->webmasterSection->name, "cat" => $MnuCategory->id]);
                                            } else {
                                                $Category_link_url = route('FrontendTopicsByCat', ["section" => $Menu2Link->webmasterSection->name, "cat" => $MnuCategory->id]);
                                            }
                                        }
                                        ?>

                                        <a class="dropdown-item" href="{{ $Category_link_url }}">
                                            @if($MnuCategory->icon !=="")
                                                <i class="fa {{$MnuCategory->icon}}"></i> &nbsp;
                                            @endif
                                            {{$MnuCategory->$category_title_var}}</a>

                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </li>
                @elseif($Menu2Link->type==2)
                    {{-- Get Section Name as a link --}}
                    <li>
                        <?php
                        if ($Menu2Link->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $mmnnuu_link = url(trans('backLang.code') . "/" . $Menu2Link->webmasterSection->$slug_var);
                            } else {
                                $mmnnuu_link = url($Menu2Link->webmasterSection->$slug_var);
                            }
                        } else {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $mmnnuu_link = url(trans('backLang.code') . "/" . $Menu2Link->webmasterSection->name);
                            } else {
                                $mmnnuu_link = url($Menu2Link->webmasterSection->name);
                            }
                        }
                        ?>
                        <a class="btn btn-primary menu-btn"
                           href="{{ $mmnnuu_link }}">{{ $Menu2Link->$link_title_var }}</a>
                    </li>
                @elseif($Menu2Link->type==1)
                    {{-- Direct link --}}
                    <?php
                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                        $this_link_url = url(trans('backLang.code') . "/" . $Menu2Link->link);
                    } else {
                        $this_link_url = url($Menu2Link->link);
                    }
                    ?>
                    <li>
                        <a class="btn btn-primary menu-btn"
                           href="{{ $this_link_url }}">{{ $Menu2Link->$link_title_var }}</a>
                    </li>
                @else
                    {{-- No link --}}
                    <li><a class="btn btn-primary menu-btn">{{ $Menu2Link->$link_title_var }}</a></li>
                @endif
            @endforeach
        </ul>
    @endif
@endif