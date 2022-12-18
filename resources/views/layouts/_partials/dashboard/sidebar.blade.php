
    <aside class="relative z-30">
        <div id="bg-sidebar" class="-translate-x-full fixed w-full h-screen bg-black/30"></div>
        <div id="sidebar" class="fixed w-64 transition duration-500 ease-out -translate-x-64 lg:-translate-x-0 bg-[#1e293b] h-screen p-3">
            <div class="text-blue-100 container h-full overflow-auto">
                <!-- logo -->
                <div class="flex justify-between lg:justify-start items-center">
                    <span class="block lg:hidden" id="arrow-close-sidebar"><i class='bx bx-arrow-back text-2xl text-gray-400 cursor-pointer'></i></span>
                    <img src="{!! asset('src/img/logo.png') !!}" loading="lazy" alt="" class="h-12 w-12 mr-2">
                    <h1 class="text-xl font-bold hidden lg:block">SIMPLE BLOG</h1>
                </div>
                <div class="mt-5" id="list-items">
                    <h2 class="text-sm text-[#64748b] font-semibold mb-2">PAGES</h2>
                    <a href="{{route('dashboard.home')}}" class="flex items-center  {{\Request::segment(1) == 'dashboard' && Request::segment(2) == ''  ? 'active' : ''}} p-3">
                        <i class='bx bx-home-alt text-2xl'></i>
                        <p class="ml-3 font-medium">Dashboard</p>
                    </a>
                    <a href="{{route('articles.index')}}" class="flex items-center  {{\Request::segment(2) == 'articles'  ? 'active' : ''}} p-3">
                        <i class='bx bx-book-content text-2xl'></i>
                        <p class="ml-3 font-medium">Articles</p>
                    </a>
                    <a href="{{route('tags.index')}}" class="flex items-center  {{\Request::segment(2) == 'tags'  ? 'active' : ''}} p-3">
                        <i class='bx bx-tag text-2xl'></i>
                        <p class="ml-3 font-medium">Tags</p>
                    </a>
                    
                    <a href="" class="flex items-center hidden {{\Request::segment(2) == 'user' ? 'active' : ''}} p-3">
                        <i class='bx bx-user text-2xl'></i>
                        <p class="ml-3 font-medium">User Permission</p>
                    </a>
                    <a href="{{route('categories.index')}}" class="flex items-center {{\Request::segment(2) == 'categories' ? 'active' : ''}} p-3">
                        <i class='bx bx-box text-2xl'></i>
                        <p class="ml-3 font-medium">Categories</p>
                    </a>
                    {{-- <a href="" class="flex items-center  {{\Request::segment(2) == 'psb' ? 'active' : ''}} p-3">
                        <i class='bx bx-tag text-2xl'></i>
                        <p class="ml-3 font-medium">Tags</p>
                    </a> --}}
                    {{-- <a href="{{ route('agenda.index') }}" class="flex items-center  {{\Request::segment(2) == 'agenda' ? 'active' : ''}} p-3">
                        <i class='bx bx-calendar-event text-2xl'></i>
                        <p class="ml-3 font-medium">Article</p>
                    </a>
                    <a href="{{ route('user.index') }}" class="flex items-center  {{\Request::segment(2) == 'user' ? 'active' : ''}} {{Auth::user()->level == 'admin' ? 'hidden' : ''}} p-3">
                        <i class='bx bx-user-plus text-2xl'></i>
                        <p class="ml-3 font-medium">Admin</p>
                    </a> --}}
                </div>
            </div>
        </div>
    </aside>