
    <header class="relative z-20">
        <div class="w-40 bg-white fixed top-0 right-0 mt-[4.25rem] px-3 pt-2 pb-4 rounded-lg mr-7 transition duration-500 ease-out">
            {{-- <p class="text-base font-semibold text-center mb-1 text-gray-500 uppercase">{{Auth::user()->level;}}</p> --}}
            <p class="text-base font-semibold text-center mb-1 text-gray-500 uppercase">Writer</p>
            <hr>
            {{-- <a href="#" class="text-center"> --}}
            <a href="{{route('logout.perform')}}" class="text-center">
                <div class="mt-2 flex justify-center items-center text-red-700 text-base font-bold">
                    <i class='bx bx-log-out'></i>
                    <p class="ml-2">Logout</p>
                </div>
            </a>
        </div>
        <div class="fixed w-full bg-white h-16 border-b-2 border-gray-200">
            <div class="flex justify-end content-center items-center h-full mr-8 relative">
                <div id="button-span" class="left-0 ml-3 absolute text-4xl text-gray-500 cursor-pointer"><i class='bx bx-menu'></i></div>
                <div class="h-full items-center hidden">
                    <div class="bg-gray-200 w-8 h-8 p-1 rounded-full mr-2 text-center">
                        <i class='text-gray-500 bx bxs-info-circle'></i>
                    </div>
                    <div class="border-r-2 border-gray-300 h-5 mr-2"></div>
                </div>
                <div class="flex h-full items-center cursor-pointer" id="dropName">
                    <img src="{{ asset('src/img/profile.png')}}" loading="lazy" alt="" class="rounded-full w-8 h-8 mr-2">
                    {{-- @if (Auth::user()->profile == null)
                        <img src="{{ asset('src/img/profile.png')}}" loading="lazy" alt="" class="rounded-full w-8 h-8 mr-2">
                    @else
                        <img src="{{ asset('src/img/profile/'.Auth::user()->profile )}}" loading="lazy" alt="" class="rounded-full w-8 h-8 mr-2">    
                    @endif --}}
                    <p class="text-base text-gray-600 font-semibold mr-1">{{Auth::user()->name;}}</p>
                    {{-- <p class="text-base text-gray-600 font-semibold mr-1">Coba</p> --}}
                    <div class="text-lg text-gray-400 font-semibold"><i class='bx bx-chevron-right transition duration-500 ease-out'></i></div>
                </div>
            </div>
        </div>
    </header>