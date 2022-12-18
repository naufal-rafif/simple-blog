<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('layouts._partials.homepage.style')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Header Start-->
    <header class="bg-transparent absolute top-0 left-0 w-full flex items-center">
        <div
            class="container sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 md:px-0">
            <div class="flex items-center justify-between relative">
                <div class="py-0">
                    <a onclick="window.close();"><div class="w-10 h-10 bg-gray-400 hover:bg-gray-800 rounded-full grid items-center text-center text-2xl font-bold text-white cursor-pointer"><span class="bx bx-undo text-gray-500" style="font-size: 3rem"></span></div></a>
                </div>
               
            </div>
        </div>
    </header>
    
<section id="hero" class="pt-24 pb-12 md:py-24 px-8 md:px-16 bg-[#F3FBFD]">
    <div class="container mx-auto">
        <div class="flex flex-wrap items-center">
            <div class="w-full md:w-1/2 md:order-last">
                <div class="relative ">
                    <div
                        class="card bg-[#e4e4e4] hidden md:block rounded-2xl w-full changeHeight absolute top-0 mt-8 ml-8">
                    </div>
                    <div class="card relative bg-black rounded-2xl w-full changeHeight"
                        style="background-image: url('{{asset('src/img/article/'.$article->image)}}') ;background-size: cover;background-position: center;">
                    </div>
                    <textarea id="url" class="opacity-0"></textarea>
                </div>
            </div>
            <div class="w-full md:w-1/2 md:pr-12">
                <p class="font-semibold text-sm text-gray-400 mt-3">{{\Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y')}}</p>
                <h1 class="font-bold text-xl md:text-3xl lg:text-4xl mt-2 text-justify">{{$article['title']}}
                </h1>
                <div class="flex overflow-x-scroll drag-slider mt-5">
                    @foreach ($article->tags as $item)
                        <button class="px-3 py-2 text-xs font-bold uppercase rounded-lg mr-3"
                        style="background-color: {{$item->background}}; color: {{$item->color}}">{{$item->name}}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Main Section -->
<main class="mb-32 px-6 md:px-8">
    <div class="container mx-auto px-2">
        <div class="flex items-end justify-between mt-8">
            <div class="text-sm md:text-base">
                <p class="font-light mb-1">Penulis</p>
                <p class="font-bold">{{$article['writer']}}</p>
            </div>
            <div class="text-right relative">
                <p class="font-light text-sm md:text-base mb-1">Bagikan</p>
                <div class="flex">
                    <a onclick="Copy()"
                        class="flex items-center mr-1 border-[2px] p-1 rounded-sm border-gray-200 hover:bg-gray-200 cursor-pointer">
                        <span class="bx bx-copy mr-1"></span>
                        <span class="text-xs">Salin Link</span>
                    </a>
                    <a onclick="shareFB()"
                        class="bx bxl-facebook mr-1 border-[2px] p-1 rounded-sm border-gray-200 hover:bg-gray-200 cursor-pointer"></a>
                    <a onclick="shareTwitter()"
                        class="bx bxl-twitter mr-1 border-[2px] p-1 rounded-sm border-gray-200 hover:bg-gray-200 cursor-pointer"></a>
                    {{-- <a href="#"
                        class="bx bxl-whatsapp mr-1 border-[2px] p-1 rounded-sm border-gray-200 hover:bg-gray-200"></a> --}}
                    <a onclick="this.href='data:text/html;charset=UTF-8,'+encodeURIComponent(document.documentElement.outerHTML)" download="article.html"
                        class="bx bxs-download border-[2px] p-1 rounded-sm border-gray-200 hover:bg-gray-200 cursor-pointer"></a>
                    {{-- <a href="{{route('downloadArtikel.home',$article->slug)}}"
                        class="bx bxs-download border-[2px] p-1 rounded-sm border-gray-200 hover:bg-gray-200"></a> --}}
                </div>
                <div class="absolute hidden top-0 left-0 bg-gray-100 font-bold px-2 py-1 text-xs rounded"
                    id="copyText">
                    Teks Berhasil Disalin!
                </div>
            </div>
        </div>
        <div class="mt-12 text-justify unreset-tailwind" id="descriptionArticle">
            {!!$article['content']!!}
        </div>
    </div>
</main>
    {{-- Content End --}}
<script>
    
    var el = document.querySelectorAll('.changeHeight');
    for (var i = 0; i < el.length; i++) {
        let height = el[i].offsetWidth * 0.6 + 'px'
        el[i].style.height = height;
    }
    window.addEventListener('resize', () => {
        var el = document.querySelectorAll('.changeHeight');
        for (var i = 0; i < el.length; i++) {
            // el[i].style.height = el[i].offsetWidth * 0.5 
            let height = el[i].offsetWidth * 0.6 + 'px'
            el[i].style.height = height;
        }
    });
</script>
    @include('layouts._partials.homepage.footer')
    @include('layouts._partials.homepage.script')    
</body>

</html>