<script src="{{ URL::asset('frontEnd/js/jquery-1.9.1.min.js') }}"></script>
<script src="{{ URL::asset('frontEnd/js/bootstrap/js/bootstrap.js') }}"></script>

<!-- Magnific Popup core JS file -->
<script src="{{ URL::asset('frontEnd/js/magnific-popup/jquery.magnific-popup.js') }}"></script>

<!-- Audio Player -->
<script src="{{ URL::asset('frontEnd/js/audioplayer.js') }}"></script>

<!-- Owl stylesheet -->
<script src="{{ URL::asset('frontEnd/js/owl-carousel/owl.carousel.js') }}"></script>
<!-- Owl stylesheet -->


<!-- slitslider -->
<script type="text/javascript" src="{{ URL::asset('frontEnd/js/slitslider/js/modernizr.custom.79639.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('frontEnd/js/slitslider/js/jquery.ba-cond.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('frontEnd/js/slitslider/js/jquery.slitslider.js') }}"></script>
<!-- slitslider -->

<script src="{{ URL::asset('frontEnd/js/script.js') }}"></script>

{{--ajax subscribe to news letter--}}
@if(Helper::GeneralSiteSettings("style_subscribe"))
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            "use strict";

            //Subscribe
            $('form.subscribeForm').submit(function () {

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
                $.ajax({
                    type: "POST",
                    url: "<?php echo route("subscribeSubmit"); ?>",
                    data: str,
                    success: function (msg) {
                        if (msg == 'OK') {
                            $("#subscribesendmessage").addClass("show");
                            $("#subscribeerrormessage").removeClass("show");
                            $("#subscribe_name").val('');
                            $("#subscribe_email").val('');
                        }
                        else {
                            $("#subscribesendmessage").removeClass("show");
                            $("#subscribeerrormessage").addClass("show");
                            $('#subscribeerrormessage').html(msg);
                        }

                    }
                });
                return false;
            });

        });
    </script>
@endif

{{-- Google Tags and google analytics --}}
@if($WebmasterSettings->google_tags_status && $WebmasterSettings->google_tags_id !="")
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id={!! $WebmasterSettings->google_tags_id !!}"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif
@if($WebmasterSettings->google_analytics_code !="")
    {!! $WebmasterSettings->google_analytics_code !!}
@endif

<?php
if ($PageTitle == "") {
    $PageTitle = Helper::GeneralSiteSettings("site_title_" . trans('backLang.boxCode'));
}
?>
{!! Helper::SaveVisitorInfo($PageTitle) !!}
