<style type="text/css">
    .navbar-inverse {
        background-color: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .lang a {
        background: {{ Helper::GeneralSiteSettings("style_color1") }};
    }
    .navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:hover, .navbar-inverse .navbar-nav > .open > a:focus {
        background-color: {{ Helper::GeneralSiteSettings("style_color1") }};
    }
    .dropdown-menu {
        background: {{ Helper::GeneralSiteSettings("style_color1") }};
    }
    .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus {
        background: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .btn-primary {
        background: {{ Helper::GeneralSiteSettings("style_color1") }};
    }
    .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {
        background-color: {{ Helper::GeneralSiteSettings("style_color2") }};
        border-color: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .btn-primary{
        color: #fff;
    }
    .subscribe .btn-primary:hover {
        color: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .hot-properties a, .item h4 a {
        color: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .hot-properties a:hover, .item h4 a:hover {
        color: {{ Helper::GeneralSiteSettings("style_color1") }};
    }

    a {
        color: {{ Helper::GeneralSiteSettings("style_color1") }};
    }
    a:hover, a:active, a:focus {
        color: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .inside-banner a:hover, .inside-banner a:active, .inside-banner a:focus {
        color: #fff;
    }
    .inside-banner {
        background: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .btn-theme {
        background: {{ Helper::GeneralSiteSettings("style_color1") }};
    }
    .list-group li a:hover, .list-group li a:active, .list-group li a:focus, .list-group li .active {
        color: {{ Helper::GeneralSiteSettings("style_color1") }};
    }
    .badge {
        background-color: {{ Helper::GeneralSiteSettings("style_color1") }};
    }
    .status.visits {
        background: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .status.comments {
        background: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .topic-info .info i {
        background: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .banner-search {
        background: {{ Helper::GeneralSiteSettings("style_color2") }};
    }

    .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
        background-color: {{ Helper::GeneralSiteSettings("style_color1") }};
        border-color: {{ Helper::GeneralSiteSettings("style_color1") }};
    }
    .field-row .badge {
        color: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    footer {
        background: {{ Helper::GeneralSiteSettings("style_color2") }};
    }

    #sub-footer {
        background: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .subscribe .btn-primary {
        background: {{ Helper::GeneralSiteSettings("style_color1") }};
    }
    .sl-slider-wrapper{
        background: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .dropdown-menu{
        border: 6px solid {{ Helper::GeneralSiteSettings("style_color1") }};
    }

    .dropdown-menu .dropdown-item:hover, .dropdown-menu .dropdown-item:focus {
        background: {{ Helper::GeneralSiteSettings("style_color2") }};
    }
    .audioplayer {
        height: 2.5em; /* 40 */
        color: #fff;
        text-shadow: 1px 1px 0 #000;
        border: 1px solid {{ Helper::GeneralSiteSettings("style_color2") }};
        position: relative;
        z-index: 1;
        background: {{ Helper::GeneralSiteSettings("style_color2") }};
    }

    @media (max-width: 767px) {
        .navbar-inverse .navbar-nav .open .dropdown-menu > li > a {
            color: {{ Helper::GeneralSiteSettings("style_color1") }};
        }
        .navbar-inverse .navbar-toggle:hover, .navbar-inverse .navbar-toggle:focus {
            background-color: {{ Helper::GeneralSiteSettings("style_color2") }};
        }

    }


</style>