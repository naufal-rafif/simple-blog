@extends('layouts.home')

@section('content')
@if ($article != NULL)
<section id="hero" class="pt-24 pb-12 md:py-24 bg-[#F3FBFD]">
    <div class="container mx-auto px-4 md:px-12">
        <div class="flex flex-wrap items-center">
            <div class="w-full md:w-1/2 md:order-last md:px-10">
                <div class="relative">
                    <div
                        class="card bg-[#e4e4e4] hidden md:block rounded-2xl w-full changeHeight absolute top-0 mt-8 ml-8">
                    </div>
                    <div class="card relative bg-black rounded-2xl w-full changeHeight"
                        style="background-image: url('{{asset('src/img/article/'.$article->image)}}') ;background-size: cover;background-position: center;">
                    </div>
                    <textarea id="url" class="opacity-0 absolute"></textarea>
                </div>
            </div>
            <div class="w-full md:w-1/2 md:pr-12">
                <p class="font-semibold text-sm text-gray-400 mt-3">{{\Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y')}}</p>
                <h1 class="font-bold text-xl md:text-3xl lg:text-4xl mt-2">{{$article->title}}
                </h1>
                <div class="flex overflow-x-scroll drag-slider mt-5">
                    @foreach ($article->tags as $tag)
                    <form action="{{route('homepage')}}" method="get">
                        <input type="hidden" name="tag" value="{{$tag->name}}">
                        <input type="hidden" name="search" value="">
                        <button type="submit" class="px-3 py-2 text-xs font-bold uppercase rounded-lg mr-3"
                            style="background-color: {{$tag->background}}; color: {{$tag->color}}">{{$tag->name}}</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Main Section -->
<main class="mb-32" style="padding-bottom: 12rem">
    <div class="container mx-auto px-4 md:px-12">
        <div class="flex items-end justify-between mt-8">
            <div class="text-sm md:text-base">
                <p class="font-light mb-1">Writer</p>
                <p class="font-bold">{{$article->writer}}</p>
            </div>
            <div class="text-right relative">
                <p class="font-light text-sm md:text-base mb-1">Share</p>
                <div class="flex">
                    <a onclick="Copy()"
                        class="flex items-center mr-1 border-[2px] p-1 rounded-sm border-gray-200 hover:bg-gray-200 cursor-pointer">
                        <span class="bx bx-copy mr-1"></span>
                        <span class="text-xs">Copy Link</span>
                    </a>
                    <a onclick="shareFB()"
                        class="bx bxl-facebook mr-1 border-[2px] p-1 rounded-sm border-gray-200 hover:bg-gray-200 cursor-pointer"></a>
                    <a onclick="shareTwitter()"
                        class="bx bxl-twitter mr-1 border-[2px] p-1 rounded-sm border-gray-200 hover:bg-gray-200 cursor-pointer"></a>
                    <a href="https://api.whatsapp.com/send?text={{url()->current()}}" data-action="share/whatsapp/share"
                        class="bx bxl-whatsapp mr-1 border-[2px] p-1 rounded-sm border-gray-200 hover:bg-gray-200"></a>
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
            {!!$article->content!!}
        </div>
    </div>
</main>
@else
<div class="container mx-auto mt-24 pb-12">
    <div class="flex justify-center">
        <img src="{{asset('src/img/component/agendapublikasi/artikel.png')}}" alt="" class="w-20 md:w-32">
    </div>
    <div class="text-center">
        <p class="font-bold text-xl">Article not found</p>
        <p class="font-light">Article will be updated later.</p>
    </div>
</div>
@endif

<script>

    function Copy() {
        // console.log(document.getElementById('copyText'))
        document.getElementById('copyText').classList.remove('hidden')
        var Url = document.getElementById("url");
        Url.innerHTML = window.location.href;
        console.log(Url.innerHTML)
        Url.select();
        document.execCommand("copy");
        setTimeout(function () { document.getElementById('copyText').classList.add('hidden') }, 1000)
    }

    function shareFB(){
        linkFacebook = `https://www.facebook.com/sharer/sharer.php?u=${window.location.href}`
        // console.log(linkFacebook)
        window.open(linkFacebook, '_blank');
    }

    function shareTwitter(){
        linkTwitter = `https://twitter.com/intent/tweet?url=${window.location.href}`
        // console.log(linkTwitter)
        window.open(linkTwitter, '_blank');
    }
    
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
@endsection