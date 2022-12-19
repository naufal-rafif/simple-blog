<header class="bg-transparent absolute top-0 left-0 w-full flex items-center">
    <div
        class="container mx-auto px-2 md:px-8">
        <div class="flex items-center justify-between relative">
            <div class="py-0">
                <a href="/" class="font-bold text-lg text-teal-500 block py-5 md:py-0">
                    <img src="{!! asset('src/img/logo.png') !!}" class="w-[50px] sm:w-[60px] md:w-[80px]" style="padding: 0.35rem" id="logoHeight" alt="logo">
                </a>
            </div>
            <div class="flex items-center">
                <button id="hamburger" aria-label="click button" class="absolute block right-4 z-50 lg:hidden">
                    <div class="w-[20px] flex flex-wrap">
                        <div class="w-1/2 h-[10px] p-[1px]">
                            <div class="bg-[#ACA5FF] w-full h-full rounded-[2px]"></div>
                        </div>
                        <div class="w-1/2 h-[10px] p-[1px]">
                            <div class="bg-[#ACA5FF] w-full h-full rounded-[2px]"></div>
                        </div>
                        <div class="w-1/2 h-[10px] p-[1px]">
                            <div class="bg-[#ACA5FF] w-full h-full rounded-[2px]"></div>
                        </div>
                        <div class="w-1/2 h-[10px] p-[1px]">
                            <div class="bg-[#ACA5FF] w-full h-full rounded-[2px]"></div>
                        </div>
                        <div class="w-full hidden font-extrabold text-4xl">
                            &#10799;
                        </div>
                    </div>
                </button>
                <nav id="nav-menu"
                    class="hidden absolute z-50 py-5 bg-white shadow-lg rounded-lg w-full md:w-1/2 lg:w-full right-4 md:right-0 top-0 md:top-12 left-0 md:left-auto mt-20 md:mt-0 lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none">
                    <ul class="block lg:flex" id="navMenu">
                        <li class="group">
                            <a href="{{route('homepage')}}" class="text-base font-medium text-[#0D00A0]  py-2 px-5 rounded-lg mx-2 flex hover:text-[#000000] group-hover:btn--background cursor-pointer"
                                id="showModalAgenda">Home</a>
                        </li>
                        <li class="group">
                            <a href="{{route('about')}}"
                                class="text-base font-medium text-[#0D00A0]  py-2 px-5 rounded-lg mx-2 flex hover:text-[#000000] group-hover:btn--background">About
                                </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

<script>
    var logo = document.getElementById('logoHeight');
    let height = logo.offsetWidth * 1 + 'px'
    logo.style.height = height;
    window.addEventListener('resize', () => {
        var logo = document.getElementById('logoHeight');
        let height = logo.offsetWidth * 1 + 'px'
        logo.style.height = height;
    });
</script>