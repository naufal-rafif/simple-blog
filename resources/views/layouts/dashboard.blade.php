<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, user-scalable=0' name='viewport'/>
    <title>Dashboard Simple Blog</title>
    @include('layouts._partials.dashboard.style')
    @stack('styles')
</head>
<body class="bg-[#f1f5f9]" >
    <!-- Header Start -->
    @include('layouts._partials.dashboard.header')
    <!-- Header End -->
    <!-- Sidebar Start -->
    {{-- @include('layouts._partials.dashboard.sidebar') --}}
    <x-dashboard.sidebar/>
    <!-- Sidebar End -->
    <!-- Main Content Start -->
    <main class="ml-0 lg:ml-64 px-5 pt-20">
        @yield('content')
    </main>
    @include('layouts._partials.dashboard.flashcard')
    <!-- Main Content End -->
    @stack('modals')
    @stack('scripts')
    @include('layouts._partials.dashboard.scripts')
</body>
</html>