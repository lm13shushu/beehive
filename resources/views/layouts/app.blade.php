<!DOCTYPE html>
<!-- app()->getLocale() 获取的是 config/app.php 中的 locale 选项 -->
<html lang=" app()->getLocale() ">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','beehive')</title>
     <!-- CSRF Token -->
     <!-- csrf-token 标签是为了方便前端的 JavaScript 脚本获取 CSRF 令牌。 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="@yield('description', 'welcome to behive')" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.qeditor.css') }}" rel="stylesheet">
    <link href="http://cdn.staticfile.org/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <div id="app" class="{{ route_class() }}-page">
        @include('layouts._header')
        <div class="container">
            <div class="message">
                @include('layouts._message')
            </div>
            @yield('content')
            @include('microblogs._fastCreateForm')
        </div>
        @include('layouts._footer')
    </div>
     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script> 
    <script src="{{ asset('js/jquery.qeditor.js') }}"></script> 
    <script type="text/javascript">
        $("#fastC_post_body").qeditor({});
    </script>
    @yield('scripts')    
</body>
</html>