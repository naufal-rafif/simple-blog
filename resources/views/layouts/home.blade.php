<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Simple Blog {{isset($title) ? '| '. $title : ''}}</title>
    @if (isset($description))
        <meta name="description"
        content="{{$description}}">
    @else
        <meta name="description"
        content="Simple Blog is a blog. Build with love">
    @endif
    <meta name="keywords" content="Blog, Simple, Challenge">
    <meta property="og:url"           content="{{url()->current()}}" />
    <meta property="og:type"          content="article" />
    @if (isset($title))
        <meta property="og:title"         content="{{$title}}" />
    @else
        <meta property="og:title"         content="Simple Blog" />
    @endif
    @if (isset($description))
        <meta property="og:description"         content="{{$description}}" />
    @else
        <meta property="og:description"         content="Just simple blog" />
    @endif
    @if (isset($urlImage))
        <meta property="og:image" content="{{asset('src/img/posts/'.$urlImage)}}" rel="preload" />
    @endif
    <link rel="icon" type="image/x-icon" href="{{asset('src/img/logo.png')}}" rel="preload">
    @include('layouts._partials.homepage.style')
</head>

<body>
    <!-- Header Start-->
    {{-- @include('layouts._partials.homepage.header') --}}
    <x-header/>
    <!-- Header End -->
    {{-- Content --}}
    @yield('content')
    {{-- Content End --}}

    @include('layouts._partials.homepage.footer')
    @include('layouts._partials.homepage.script')    
</body>

</html>