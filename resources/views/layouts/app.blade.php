<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">
    <title>@yield('title', config('app.name')) </title>
    <link rel="stylesheet" href="/assets/home/css/mzui.min.css">
    <link rel="stylesheet" href="/assets/home/css/style.css?{{time()}}">
    @yield('css')
    @yield('js')

</head>
<body>
    @yield('content')
    @section('footer')
    @include('layouts.footer')
    @show
</body>

<script type="text/javascript" src="/assets/home/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/assets/home/js/mzui.min.js" ></script>
@section('layer')
<script type="text/javascript" src="/assets/home/js/layer/layer.min.js" ></script>
@show
<script type="text/javascript" src="/assets/home/js/cjango.js?v={{uniqid()}}"></script>
<script type="text/javascript" src="/assets/home/js/vue.js"></script>
<script type="text/javascript" src="/assets/home/js/main.js"></script>
@yield('script')
