<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, user-scalable=0' name='viewport'/>
    <title>Simple Blog</title>
    @include('layouts._partials.dashboard.style')
</head>
<body >
    @yield('content')
    <!-- Main Content End -->
    @include('layouts._partials.dashboard.flashcard')
    @include('layouts._partials.dashboard.scripts')
</body>
</html>