@extends('layouts.dashboard')

@section('content')
<div class="mx-2">
    <div class="block md:flex justify-between items-center mt-5">
        <div class="mb-5">
            <h2 class="font-semibold text-2xl">Categories</h2>
        </div>
        <div class="flex flex-wrap items-center mb-3">
            <form action="" method="GET" class="flex items-center relative mb-5" autocomplete="off">
                @csrf
                <input type="text" name="search" class="text-input w-60 mr-3 pl-8" placeholder="Find Category">
                <button type="submit" class="absolute bx bx-search-alt ml-2 text-gray-400"></button>
            </form>
            <a href="{{route('categories.create')}}" class="px-3 py-2 bg-slate-900 rounded-lg text-white hover:bg-slate-700 flex items-center mb-5"><span class="bx bx-plus-circle"></span><span class="ml-1">Add Category</span></a>
        </div>
    </div>
</div>
<div class="card mb-5">
   <div class="flex justify-between items-center mb-5">
        <div class="md:flex items-center">
            <p class="text-lg font-semibold">Category List</p>
        </div>
   </div>
   

   <div class="table-roll w-full overflow-x-auto">
       <table class="table-auto w-full mb-5">
           <thead>
               <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                   <th class="py-3 px-3 text-left">Category Name</th>
                   <th class="py-3 px-3 text-center">Action</th>
               </tr>
           </thead>
           <tbody class="text-gray-600 text-sm font-light" id="tableList">
            @foreach ($categories as $category)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-3 text-left">
                    <p class="text-base">{{$category->name}}</p>
                </td>
                <td class="py-3 px-3 text-center">
                    <div class="flex item-center justify-center">
                        <a href="{{route('categories.edit',$category->id)}}" class="mr-2 transform hover:text-indigo-500 hover:scale-110">
                            <span class="bx bx-pencil text-lg"></span>
                        </a>
                        <button data-val="{{route('categories.destroy',$category->id)}}" class="btn_empty mr-2 transform hover:text-indigo-500 hover:scale-110 text-red-600">
                            <span class="bx bx-trash text-lg"></span>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
           </tbody>
       </table>
       {!! $categories->links() !!}
   </div>
</div>

@push('modals')
    @include('admin.categories.modals')
@endpush
@push('scripts')
    @include('admin.categories.scripts')
@endpush
@endsection