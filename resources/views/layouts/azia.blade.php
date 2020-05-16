<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/datatables.net-dt/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/datatables.net-dt/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/lib/amazeui-datetimepicker/amazeui.datetimepicker.css') }}"> --}}
    <link href="{{ asset('css/azia.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body class="az-body az-body-sidebar">
    @include('partials.sidebar')
    <div class="az-content az-content-dashboard-two">
        @include('partials.header')
        <div class="az-content-header d-block d-md-flex">
            <div>
                <h2 class="az-content-title tx-24 mg-b-5 mg-b-lg-8">Hola, bienvenido de nuevo!</h2>
                {{-- <p class="mg-b-0">Your sales monitoring dashboard template.</p> --}}
            </div>
            <div class="az-dashboard-header-right">
            </div>
        </div>
        <div class="az-content-body">
            @yield('content')
        </div>
        <div class="az-footer ht-40">
            <div class="container-fluid pd-t-0-f ht-100p">
                <span>&copy; {{ date('Y') }} Amadeus</span>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="{{ asset('js/lib/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/lib/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/lib/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/lib/responsive.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('js/lib/amazeui.datetimepicker.min.js') }}"></script> --}}
    <script src="{{ asset('js/azia.js') }}"></script>
    <script>
        $(function(){
            'use strict'

            $('.az-sidebar .with-sub').on('click', function(e){
                e.preventDefault();
                $(this).parent().toggleClass('show');
                $(this).parent().siblings().removeClass('show');
            });
            $(document).on('click touchstart', function(e){
                e.stopPropagation();
                if(!$(e.target).closest('.az-header-menu-icon').length) {
                    var sidebarTarg = $(e.target).closest('.az-sidebar').length;
                    if(!sidebarTarg) {
                        $('body').removeClass('az-sidebar-show');
                    }
                }
            });
            $('#azSidebarToggle').on('click', function(e){
                e.preventDefault();
                if(window.matchMedia('(min-width: 992px)').matches) {
                    $('body').toggleClass('az-sidebar-hide');
                } else {
                    $('body').toggleClass('az-sidebar-show');
                }
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @yield('scripts')
  </body>
</html>
