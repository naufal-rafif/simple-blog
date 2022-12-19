@extends('layouts.dashboard')

@section('content')
<div class="mx-2">
    <div class="block md:flex justify-between items-center">
        <div class="mb-3">
            <h2 class="font-semibold text-2xl">Deleted Article</h2>
        </div>
    </div>
</div>
<div class="card mb-5">
   <div class="flex justify-between items-center mb-5">
        <div class="md:flex items-center">
            <p class="text-lg font-semibold">List Article</p>
            <a  data-val="{{route('dashboard.articles.destroyMultiple')}}" data-message="All deleted data will be deleted permanently" class="md:ml-8 text-sm text-red-600 font-semibold cursor-pointer hidden" id="checkDelete">Destroy All</a>
            <p class="px-5 text-gray-300 hidden" id="separator">|</p>
            <a data-val="{{route('dashboard.articles.recoverMultiple')}}" data-message="All data will be recovered" class="text-sm text-green-700 font-semibold cursor-pointer hidden" id="checkRecovery">Recover All</a>
        </div>
   </div>
   

   <div class="table-roll w-full overflow-x-auto">
       <table class="table-auto w-full mb-5">
           <thead>
               <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                   <th class="py-3 px-3 w-0 text-left"><input type="checkbox" oninput="checkBoxes(this)" name="" id="checkboxEvent" class="w-4 h-4"></th>
                   <th class="py-3 px-3 text-left">Title</th>
                   <th class="py-3 px-3 text-left">Author/Writer</th>
                   <th class="py-3 px-3 text-left">Date</th>
                   <th class="py-3 px-3 text-left">Tag</th>
                   <th class="py-3 px-3 text-left">Category</th>
                   <th class="py-3 px-3 text-center">Status</th>
                   <th class="py-3 px-3 text-center">Action</th>
               </tr>
           </thead>
           <tbody class="text-gray-600 text-sm font-light" id="tableList">
            @foreach ($articles as $article)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-3 text-left">
                    <input type="checkbox" name="" id="" data-id="{{ $article->id }}" class="w-4 h-4 checkbox" oninput="checkBoxes(this)">
                </td>
                <td class="py-3 px-3 text-left">
                    <p class="text-base">{{$article->title}}</p>
                </td>
                <td class="py-3 px-3 text-left">
                    <p class="text-base">{{$article->writer}}</p>
                </td>
                <td class="py-3 px-3 text-left">
                    <p class="text-base">{{\Carbon\Carbon::parse($article->created_at)->translatedFormat('l, d F Y')}}</p>
                </td>
                <td class="py-3 px-3 text-left flex flex-wrap">
                    @php
                        $countTags = count($article->tags)
                    @endphp
                    @foreach ($article->tags as $tag)
                    <button class="text-xs my-1 py-2 px-4 rounded-full" style="margin-right: 4px; background: {{$tag->background}}; color: {{$tag->color}}">
                            {{$tag->name}} 
                            {{-- {{$article->tags[$countTags-1]->name == $tag->name ? '' : ','}} --}}
                    </button>
                    @endforeach
                </td>
                <td class="py-3 px-3 text-left">
                    <p class="text-base">{{$article->category}}</p>
                </td>
                <td class="py-3 px-3 text-center">
                    <span class="{{$article->status == 0 ? 'text-yellow-600' : 'text-green-600'}} py-1 px-3 rounded-full">{{$article->status == 0 ? 'Draf' : 'Dipublikasikan'}}</span>
                </td>
                <td class="py-3 px-3 text-center">
                    <div class="flex item-center justify-center">
                        <a href="{{route('articles.show',$article->slug)}}" target="_blank" class="mr-2 transform hover:text-indigo-500 hover:scale-110">
                            <span class="bx bx-show-alt text-lg"></span>
                        </a>
                       <button data-val="{{route('articles.destroy',$article->id)}}" data-message="Data will deleted permanently" data-action="destroy" class="btn_empty mr-2 transform hover:text-indigo-500 hover:scale-110 text-red-600">
                            <span class="bx bx-trash text-lg"></span>
                        </button>
                        <button data-val="{{route('dashboard.articles.recover',$article->id)}}" data-message="Data will be recovered" class="btn_recover mr-2 transform hover:text-indigo-500 hover:scale-110 text-green-600">
                            <span class="bx bx-recycle text-lg"></span>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
           </tbody>
       </table>
       {!! $articles->links() !!}
   </div>

   
   <div class="flex justify-end items-center mt-5">
    <a href="{{ route('articles.index') }}" class="px-5 py-2 rounded-lg bg-gray-700 text-white hover:bg-gray-500">Kembali</a>
   </div>
</div>

@push('modals')
    @include('admin.articles.modals')
@endpush
@push('scripts')
    @include('admin.articles.scripts')
@endpush
@endsection