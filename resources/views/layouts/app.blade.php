<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style type="text/css">
        :root {
            --top_bar_back: white;
            --top_bar_frontColor: lightgrey;
            --side_menu_front_color: whitesmoke;
            --side_menu_front_hover: white;
            --side_menu_back: Indigo;
        }

        body {
            position: relative;
        }

        .page_header {
            position: fixed;
            background-color: var(--top_bar_back);
            height: 70px;
            width: 100%;
            box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.4);
            z-index: 5;
        }

        .master_logo {
            width: 250px;
            height: 70px;
            background-color: beige;
            z-index: 5;
        }

        .side_menu {
            position: fixed;
            width: 80px;
            height: 100vh;
            overflow: hidden;
            top: 0;
            padding: 80px 10px 10px 10px;
            background-color: var(--side_menu_back);
            border-right: 30px solid var(--side_menu_back);
            font-size: larger;
            transition: width .3s;
            z-index: 4;
        }

        .side_menu:hover {
            width: 250px;
            overflow: auto;
        }

        .side_menu a {
            text-decoration: none !important;
        }

        .side_menu .nav_logo {
            display: block;
            width: 100%;
            height: 70px;
            color: var(--side_menu_front_color);
            font-weight: bold;
        }

        .side_menu .nav,
        .side_menu .nav div,
        .side_menu .nav_list {
            width: 100%;
        }

        .side_menu .nav_list .nav_link {
            color: var(--side_menu_front_color);
            display: block;
            height: 50px;
            line-height: 50px;
            padding: 0 20px;
            transition: background-color .3s, padding .3s;
            overflow: hidden;
        }

        .side_menu .nav_list .nav_link:hover {
            color: var(--side_menu_front_hover);
            background-color: rgba(0, 0, 0, 0.2);
            border-left: 3px solid rgba(0, 0, 0, 0.4);
            padding: 0 5px 0 30px;
        }

        .side_menu .deconnectBtn {
            position: absolute;
            bottom: 10px;
            overflow: hidden;
        }

        .main_content {
            padding-top: 70px;
            margin-left: 100px;
        }

        .main_container {
            margin: 70px 50px 50px 50px;
        }
    </style>


</head>



<body>
    <header class="page_header">
        <div class="master_top_bar">
            <div class="master_logo"></div>
        </div>
    </header>
    <div class="side_menu">
        @include('layouts.navigation')
    </div>
    <div class="main_content">
        <div class="main_container">
            @yield('content')
        </div>
    </div>
    <!--Container Main start-->

    <!--Container Main end-->


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            
        });
    </script>

    @stack('scripts')
</body>

</html>
