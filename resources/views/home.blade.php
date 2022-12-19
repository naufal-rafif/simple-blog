@extends('layouts.home')

@section('content')
{{-- {{dd($articles)}} --}}

@if (count($articles)>0)
    <section id="hero">
        <div class="container mx-auto mt-20 md:mt-24 md:px-12">
            <div class="card bg-black md:rounded-[30px] w-full heroHeight"
                style="background-image: url('{{asset('src/img/article/'.$articles[0]->image)}}') ;background-size: cover;background-position: center;">
            </div>
            <div class="card bg-white rounded-xl -mt-16 w-10/12 md:w-4/5 mx-auto drop-shadow-xl py-3 px-4">
                <div class="flex justify-between items-center">
                    <div class="w-full md:py-4">
                        <div class="flex items-center text-[#8A8A8A]">
                            <p class="text-sm font-bold mr-2">{{$articles[0]->writer}}</p>
                            <p class="mr-2">&bull;</p>
                            <p class="text-sm font-bold">{{\Carbon\Carbon::parse($articles[0]->created_at)->translatedFormat('d.m.Y')}}</p>
                        </div>
                        <p class="text-lg md:text-3xl text-[#063764] font-bold my-2">{{$articles[0]->title}}
                        </p>
                        <div class="flex overflow-x-scroll drag-slider items-center md:mt-5" style="white-space: nowrap;">
                            @foreach ($articles[0]->tags as $tags)
                                <button class="px-3 py-2 text-xs font-bold uppercase rounded-lg mr-3"
                                style="background-color: {{$tags->background}}; color: {{$tags->color}};">{{$tags->name}}</button>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{route('article.detail',$articles[0]->slug)}}" class="w-16 md:w-12 fill-blue-900 hover:fill-black">
                    {{-- <a href="{{route('detailhomepage',$articles[0]->slug)}}" class="w-16 md:w-12 fill-blue-900 hover:fill-black"> --}}
                        <svg viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M30.8642 32.3638L33.8638 32.3638L33.8638 18.1362L19.6361 18.1362V21.1357L28.7429 21.1357L18.5754 31.3032L20.6967 33.4245L30.8642 23.257L30.8642 32.3638Z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @if (count($articles)>1)
        <main class="mt-8 mb-32">
            <div class="flex flex-wrap container mx-auto  px-2 md:px-10">
                <section class="flex flex-wrap w-full" id="article">
                    @foreach ($articles as $article)
                        @if ($article->slug != $articles[0]->slug)
                        <article class="w-full md:w-1/3 px-3 mt-12">
                            <div class="rounded-xl w-full changeHeight"
                                style="background-image: url('{{asset('src/img/article/'.$article->image)}}'); background-position: center; background-size: cover;">
                            </div>
                            <div class="flex items-center mt-2">
                                <p class="text-sm text-[#8A8A8A] font-bold mr-2">{{\Carbon\Carbon::parse($article->created_at)->translatedFormat('d.m.Y')}}</p>
                                <p class="mr-2 text-[#8A8A8A]">&bull;</p>
                                <div class="flex overflow-x-scroll drag-slider" style="white-space: nowrap;">
                                    @foreach ($article->tags as $tags)
                                        <button class="px-3 py-2 text-xs font-bold uppercase rounded-lg mr-3"
                                        style="background-color: {{$tags->background}}; color: {{$tags->color}}">{{$tags->name}}</button>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="font-bold text-lg capitalize">{{$article->title}}</p>
                                <div class="font-light text-base">{!!substr($article->content,0,150)!!}</div>
                                <a href="{{route('article.detail',$article->slug)}}" class="flex items-center mt-1">
                                    <span class="text-sm font-bold text-blue-600">Lanjutkan membaca</span>
                                    <span class="bx bx-right-arrow-alt text-sm font-bold text-blue-600"></span>
                                </a>
                            </div>
                        </article>
                        @endif
                    @endforeach
                    {{-- @if (count($articles)>=5)
                    <div class="w-full">
                        <div class="container mx-auto mt-12 text-center">
                            <form action="{{route('homepage')}}" method="get">
                                <input type="hidden" name="search" value="">
                                <button type="submit" class="px-5 py-2 rounded-lg bg-blue-500 text-white font-normal text-sm hover:bg-blue-700">
                                    Lihat Semua</button>
                            </form>
                        </div>
                    </div>
                    @endif --}}
                </section>
            </div>
        </main>
    @else
        <main class="mt-24 mb-32 px-2 md:px-8">
            <div class="container mx-auto mt-48">
                <div class="flex justify-center">
                    <img src="{{asset('src/img/component/agendapublikasi/artikel.png')}}"  loading="lazy" loading="lazy" alt="" class="w-20 md:w-32">
                </div>
                <div class="text-center">
                    <p class="font-bold text-xl">Article not found!</p>
                    <p class="font-light">We will update later. Please stay tune</p>
                </div>
            </div>
        </main>
    @endif
@else
    <main class="mt-24 mb-32 px-2 md:px-8">
        <div class="container mx-auto mt-24 md:mt-48">
            <div class="flex justify-center">
                <img src="{{asset('src/img/component/agendapublikasi/artikel.png')}}" loading="lazy" alt="" class="w-20 md:w-32">
            </div>
            <div class="text-center">
                <p class="font-bold text-xl">Article not found!</p>
                <p class="font-light">We will update the article later. Please stay tune!</p>
            </div>
        </div>
    </main>
@endif
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
    var el = document.querySelectorAll('.heroHeight');
    for (var i = 0; i < el.length; i++) {
        if(window.screen.width < 1024){
            let height = el[i].offsetWidth * .6 + 'px'
            el[i].style.height = height;
        } else {
            let height = el[i].offsetWidth * 0.416 + 'px'
            el[i].style.height = height;
        }
    }
    window.addEventListener('resize', () => {
        var el = document.querySelectorAll('.heroHeight');
        for (var i = 0; i < el.length; i++) {
            if(window.screen.width < 1024){
                let height = el[i].offsetWidth * .6 + 'px'
                el[i].style.height = height;
            } else {
                let height = el[i].offsetWidth * 0.416 + 'px'
                el[i].style.height = height;
            }
        }
    });
</script>
@endsection