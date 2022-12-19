@extends('layouts.dashboard')

@section('content')
<div class="mx-2">
    <div class="block md:flex justify-between items-center mt-5">
        <div class="mb-5">
            <h2 class="font-semibold text-2xl">Articles</h2>
        </div>
        <div class="flex flex-wrap items-center mb-3">
            <form action="" method="GET" class="flex items-center relative mb-5 hidden" autocomplete="off">
                @csrf
                <input type="text" name="search" class="text-input w-60 mr-3 pl-8" placeholder="Find Article">
                <button type="submit" class="absolute bx bx-search-alt ml-2 text-gray-400"></button>
            </form>
            <a href="/dashboard/articles/create" class="px-3 py-2 bg-slate-900 rounded-lg text-white hover:bg-slate-700 flex items-center mb-5"><span class="bx bx-plus-circle"></span><span class="ml-1">Add Article</span></a>
        </div>
    </div>
</div>
<div class="card mb-5">
   <div class="flex justify-between items-center mb-5">
        <div class="md:flex items-center">
            <p class="text-lg font-semibold">Article List</p>
            <button class="md:ml-8 text-sm text-red-600 font-semibold hidden" data-val="{{route('dashboard.articles.deleteMultiple')}}" data-message="All deleted data can be found at trash directory" id="checkDelete">Delete All</button>
        </div>
        <a href="{{route('dashboard.articles.temp')}}" class="flex items-center text-red-600">
            <p class="text-lg font-semibold"><span class="bx bx-trash"></span></p>
            <p class="text-sm font-semibold">Trash</p>
        </a>
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
                        <a href="{{route('articles.edit',$article->slug)}}" class="mr-2 transform hover:text-indigo-500 hover:scale-110">
                            <span class="bx bx-pencil text-lg"></span>
                        </a>
                        <button data-val="{{route('dashboard.articles.delete',$article->id)}}" data-action="delete" data-message="Data will go to the trash" class="btn_empty mr-2 transform hover:text-indigo-500 hover:scale-110 text-red-600">
                            <span class="bx bx-trash text-lg"></span>
                        </button>
                        <form action="{{route('dashboard.articles.updateStatus',$article->id)}}" method="post" autocomplete="off" id="formUpload" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if ($article->status == 0)
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn_update_status">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.6683 0.685806C15.7047 0.594942 15.7136 0.495402 15.6939 0.399526C15.6742 0.303649 15.6269 0.215653 15.5576 0.146447C15.4884 0.0772403 15.4004 0.0298668 15.3046 0.0101994C15.2087 -0.0094681 15.1092 -0.000564594 15.0183 0.0358061L0.471288 5.85481C0.343177 5.90609 0.231698 5.99172 0.149119 6.10227C0.0665401 6.21283 0.0160632 6.34402 0.00324374 6.48142C-0.00957573 6.61882 0.0157593 6.75709 0.0764603 6.88101C0.137161 7.00494 0.230875 7.10971 0.347288 7.18381L5.34229 10.3618L6.87329 12.7678C6.9456 12.877 7.05785 12.9534 7.18592 12.9807C7.31399 13.008 7.44766 12.984 7.55819 12.9138C7.66873 12.8436 7.74732 12.7328 7.77707 12.6053C7.80682 12.4778 7.78535 12.3437 7.71729 12.2318L6.34129 10.0698L13.8353 2.57581L11.9403 7.31381C11.9143 7.37504 11.9007 7.44085 11.9004 7.50738C11.9001 7.57392 11.9132 7.63984 11.9387 7.70128C11.9642 7.76273 12.0017 7.81846 12.0491 7.86521C12.0964 7.91196 12.1526 7.9488 12.2144 7.97355C12.2761 7.99831 12.3422 8.01049 12.4087 8.00938C12.4753 8.00828 12.5409 7.9939 12.6018 7.9671C12.6627 7.9403 12.7176 7.90162 12.7634 7.85332C12.8092 7.80502 12.8448 7.74807 12.8683 7.68581L15.6683 0.685806ZM13.1283 1.86881L5.63429 9.36281L1.29529 6.60181L13.1283 1.86881Z" fill="#2CB362"/>
                                        <path d="M15.7041 12.4998C15.7041 13.4281 15.3354 14.3183 14.679 14.9747C14.0226 15.6311 13.1324 15.9998 12.2041 15.9998C11.2758 15.9998 10.3856 15.6311 9.72923 14.9747C9.07285 14.3183 8.7041 13.4281 8.7041 12.4998C8.7041 11.5716 9.07285 10.6813 9.72923 10.0249C10.3856 9.36857 11.2758 8.99982 12.2041 8.99982C13.1324 8.99982 14.0226 9.36857 14.679 10.0249C15.3354 10.6813 15.7041 11.5716 15.7041 12.4998ZM13.7111 10.8208C13.6548 10.7871 13.5923 10.7647 13.5274 10.7551C13.4624 10.7455 13.3962 10.7487 13.3325 10.7647C13.2688 10.7807 13.2088 10.809 13.1561 10.8482C13.1034 10.8873 13.0588 10.9365 13.0251 10.9928L11.8551 12.9428L11.3081 12.3958C11.2142 12.3019 11.0869 12.2492 10.9541 12.2492C10.8213 12.2492 10.694 12.3019 10.6001 12.3958C10.5062 12.4897 10.4535 12.617 10.4535 12.7498C10.4535 12.8826 10.5062 13.0099 10.6001 13.1038L11.3741 13.8768C11.4547 13.9575 11.5526 14.0188 11.6604 14.056C11.7682 14.0932 11.8831 14.1053 11.9963 14.0914C12.1095 14.0775 12.218 14.038 12.3136 13.9759C12.4092 13.9137 12.4894 13.8306 12.5481 13.7328L13.8831 11.5068C13.9169 11.4505 13.9392 11.388 13.9488 11.3231C13.9585 11.2581 13.9552 11.1919 13.9392 11.1282C13.9232 11.0645 13.8949 11.0045 13.8557 10.9518C13.8166 10.8991 13.7674 10.8546 13.7111 10.8208Z" fill="#2CB362"/>
                                    </svg>
                                </button>
                            @else
                                <input type="hidden" name="status" value="0">
                                <button type="submit" class="btn_update_status">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.6683 0.685806C15.7047 0.594942 15.7136 0.495402 15.6939 0.399526C15.6742 0.303649 15.6269 0.215653 15.5576 0.146447C15.4884 0.0772403 15.4004 0.0298668 15.3046 0.0101994C15.2087 -0.0094681 15.1092 -0.000564594 15.0183 0.0358061L0.471288 5.85481C0.343177 5.90609 0.231698 5.99172 0.149119 6.10227C0.0665401 6.21283 0.0160632 6.34402 0.00324374 6.48142C-0.00957573 6.61882 0.0157593 6.75709 0.0764603 6.88101C0.137161 7.00494 0.230875 7.10971 0.347288 7.18381L5.34229 10.3618L6.87329 12.7678C6.9456 12.877 7.05785 12.9534 7.18592 12.9807C7.31399 13.008 7.44766 12.984 7.55819 12.9138C7.66873 12.8436 7.74732 12.7328 7.77707 12.6053C7.80682 12.4778 7.78535 12.3437 7.71729 12.2318L6.34129 10.0698L13.8353 2.57581L11.9403 7.31381C11.9143 7.37504 11.9007 7.44085 11.9004 7.50738C11.9001 7.57392 11.9132 7.63984 11.9387 7.70128C11.9642 7.76273 12.0017 7.81846 12.0491 7.86521C12.0964 7.91196 12.1526 7.9488 12.2144 7.97355C12.2761 7.99831 12.3422 8.01049 12.4087 8.00938C12.4753 8.00828 12.5409 7.9939 12.6018 7.9671C12.6627 7.9403 12.7176 7.90162 12.7634 7.85332C12.8092 7.80502 12.8448 7.74807 12.8683 7.68581L15.6683 0.685806ZM13.1283 1.86881L5.63429 9.36281L1.29529 6.60181L13.1283 1.86881Z" fill="#B72C2C"/>
                                        <path d="M15.7041 12.4998C15.7041 13.4281 15.3354 14.3183 14.679 14.9747C14.0226 15.6311 13.1324 15.9998 12.2041 15.9998C11.2758 15.9998 10.3856 15.6311 9.72923 14.9747C9.07285 14.3183 8.7041 13.4281 8.7041 12.4998C8.7041 11.5716 9.07285 10.6813 9.72923 10.0249C10.3856 9.36857 11.2758 8.99982 12.2041 8.99982C13.1324 8.99982 14.0226 9.36857 14.679 10.0249C15.3354 10.6813 15.7041 11.5716 15.7041 12.4998ZM10.2041 12.4998C10.2041 12.6324 10.2568 12.7596 10.3505 12.8534C10.4443 12.9471 10.5715 12.9998 10.7041 12.9998H13.7041C13.8367 12.9998 13.9639 12.9471 14.0577 12.8534C14.1514 12.7596 14.2041 12.6324 14.2041 12.4998C14.2041 12.3672 14.1514 12.24 14.0577 12.1463C13.9639 12.0525 13.8367 11.9998 13.7041 11.9998H10.7041C10.5715 11.9998 10.4443 12.0525 10.3505 12.1463C10.2568 12.24 10.2041 12.3672 10.2041 12.4998Z" fill="#B72C2C"/>
                                    </svg>
                                </button>
                            @endif
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
           </tbody>
       </table>
       {!! $articles->links() !!}
   </div>
</div>
@push('modals')
    @include('admin.articles.modals')
@endpush
@push('scripts')
    @include('admin.articles.scripts')
@endpush

@push('styles')
  <!-- Styles -->
  <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
  <style>
    .dataTables_filter > label > input {
        border: 1px solid black;
        border-radius: 5px;
        margin-bottom: 10px;
        padding: 6px 10px;
    }
  </style>
@endpush
@endsection