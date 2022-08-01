<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@hasSection('template_title')@yield('template_title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
        <meta name="description" content="Whelson IT Register">
        <meta name="author" content="Vincent H Guyo">
        <!-- Favicon icon -->
        <link rel="icon" href="{{asset('assets\images\favicon.png')}}" type="image/x-icon">
        <!-- Google font-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
        <!-- Required Fremwork -->
        <link rel="stylesheet" type="text/css" href="{{asset('bower_components\bootstrap\css\bootstrap.min.css')}}">
        <!-- ico font -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets\icon\icofont\css\icofont.css')}}">
        <!-- feather Awesome -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets\icon\feather\css\feather.css')}}">
        <!-- notify js Fremwork -->
        <link rel="stylesheet" type="text/css" href="{{asset('bower_components\pnotify\css\pnotify.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('bower_components\pnotify\css\pnotify.brighttheme.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('bower_components\pnotify\css\pnotify.buttons.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('bower_components\pnotify\css\pnotify.history.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('bower_components\pnotify\css\pnotify.mobile.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\pnotify\notify.css')}}">
        <!-- Style.css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets\css\style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets\css\jquery.mCustomScrollbar.css')}}">

        {{-- Fonts --}}
        @yield('template_linked_fonts')

        @yield('template_linked_css')

        {{-- Scripts --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>

        @yield('head')
    </head>
    <body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>

        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">

                @include('partials.top-nav')

                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">

                        @include('partials.nav')

                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        @include('partials.form-status')

                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="{{asset('bower_components\jquery\js\jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components\jquery-ui\js\jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components\popper.js\js\popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components\bootstrap\js\bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('bower_components\jquery-slimscroll\js\jquery.slimscroll.js')}}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('bower_components\modernizr\js\modernizr.js')}}"></script>
    <!-- pnotify js -->
    <script type="text/javascript" src="{{asset('bower_components\pnotify\js\pnotify.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components\pnotify\js\pnotify.desktop.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components\pnotify\js\pnotify.buttons.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components\pnotify\js\pnotify.confirm.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components\pnotify\js\pnotify.callbacks.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components\pnotify\js\pnotify.animate.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components\pnotify\js\pnotify.history.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components\pnotify\js\pnotify.mobile.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components\pnotify\js\pnotify.nonblock.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets\pages\pnotify\notify.js')}}"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{asset('bower_components\chart.js\js\Chart.js')}}"></script>
    <script src="{{asset('bower_components\raphael\js\raphael.min.js')}}"></script>
    <script src="{{asset('bower_components\morris.js\js\morris.js')}}"></script>
    <script src="{{asset('assets\js\jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets\js\SmoothScroll.js')}}"></script>
    <script src="{{asset('assets\js\pcoded.min.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('assets\js\vartical-layout.min.js')}}"></script>
    {{--<script type="text/javascript" src="{{asset('assets\pages\dashboard\custom-dashboard.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('assets\js\script.min.js')}}"></script>

    <script src="{{asset('js\typeahead.bundle.min.js')}}"></script>

    <script>
        jQuery(document).ready(function($) {
            // Set the Options for "Bloodhound" suggestion engine
            var engine = new Bloodhound({
                remote: {
                    url: '/witregister/find?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $(".search-input").typeahead({
                hint: true,
                highlight: true,
                minLength: 3
            }, {
                source: engine.ttAdapter(),

                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'usersList',

                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown">'
                    ],
                    suggestion: function (data) {
                        return '<a href="/witregister/iassets/' + data.assettag + '" class="list-group-item">' + data.name +' - ' + data.model + ' - ' + data.type + '</a>'
                    }
                }
            });
        });
    </script>

    {{--<script src="{{asset('assets\js\pcoded.min.js')}}"></script>
    <script src="{{asset('assets\js\vartical-layout.min.js')}}"></script>
    <script src="{{asset('assets\js\jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets\js\script.js')}}"></script>--}}

    <div class="footer bg-white">
        <p class="text-center text-inverse">Copyright &copy; @php echo date('Y'); @endphp Powered by Whelson IT. All rights reserved.</p>
    </div>
        @yield('footer_scripts')

    </body>
</html>
