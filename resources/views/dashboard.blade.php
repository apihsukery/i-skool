<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <!-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> -->

        @include('layouts.partials.head')

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
        <div class="wrapper">
        
            @include('layouts.partials.navbar')
            <!-- Main Sidebar Container -->
            @include('layouts.partials.sidebar')

            <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
                <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
                    <div class="nav-item dropdown">
                        <a class="nav-link bg-danger dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Close</a>
                        <div class="dropdown-menu mt-0">
                        <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all">Close All</a>
                        <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all-other">Close All Other</a>
                        </div>
                    </div>
                    <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
                    <ul class="navbar-nav overflow-hidden" role="tablist"></ul>
                    <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
                    <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
                </div>
                <div class="tab-content">
                    <div class="tab-empty">
                        <h2 class="display-4">No tab selected!</h2>
                    </div>
                    <div class="tab-loading">
                        <div>
                            <h2 class="display-4">Tab is loading <i class="fa fa-sync fa-spin"></i></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.partials.footer-script')
    </body>
</html>
