@extends('layouts.dashboard')
@section('content')

<div class="container mx-2">
    <div class="block md:flex justify-between items-center">
        <div class="mb-3">
            <h2 class="font-semibold text-2xl">Edit Articles</h2>
        </div>
    </div>
</div>

<div class="card mb-8">
    <form action="{{ route('articles.update', $article->id) }}" method="POST" autocomplete="off" id="formUpload" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="old_image" id="old_image" value="{{$article->image}}">
        <input type="hidden" name="tag" id="tagOutput" value="">
        <input type="hidden" name="status" id="statusArticle" value="{{$article->status}}">
        <div class="flex flex-wrap">
            <div class="basis-full md:basis-1/2">
                <div class="px-5 mb-5">
                    <label for="" class="mb-2">Title</label>
                    <textarea name="title" id="" class="text-input px-2 mt-1 w-full" placeholder="Add title" required>{{$article->title}}</textarea>
                    @if($errors->has('title'))
                        <span class="error text-red-600 text-xs">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="px-5 mb-5">
                    <label for="" class="">Category</label>
                    <select name="category_id" {{count($categories)==0 ? 'disabled' : ''}} class="text-input px-2 w-full">
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}" {{ $article->category_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                        <span class="error text-red-600 text-xs">{{ $errors->first('category_id') }}</span>
                    @endif
                </div>
            </div>
            <div class="basis-full md:basis-1/2">
                <div class="px-5 mb-5">
                    <label for="" class="mb-2">Tag</label>
                    <div class="flex">
                        <div class="w-full md:w-1/2">
                            <div class="mr-2" id="tagList">
                                @foreach ($article->tags as $tag)
                                    <div class="relative w-full">
                                        <p class="py-2 px-2 rounded border-1 bg-gray-200 px-2 mb-2" data-id="{{$tag->id}}">{{$tag->name}}</p>
                                        <span class="bx bx-x absolute right-0 top-0 text-xl font-bold p-2 cursor-pointer"></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <select name="tagValue" id="tagValue" class="text-input px-2 mt-1 w-full md:w-1/2" {{count($tags)==0 ? 'disabled' : ''}} style="height: max-content" required>
                            <option disabled selected>{{count($tags)==0 ? 'Tag Kosong' : 'Pilih Tag'}}</option>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('tag'))
                        <span class="error text-red-600 text-xs">{{ $errors->first('tag') }}</span>
                        @endif
                    </div>
                    <span class="error text-red-600 text-xs" id="tagError"></span>
                </div>
                <div class="px-5 mb-5">
                    <img src="{{asset('src/img/article/'.$article->image)}}" alt="" class="w-full" id="changeImage">
                    <div class="relative w-full flex items-center">
                        <label for="" class="mr-3 mb-2">Image</label>
                        <div class="group">
                            <i class='bx bx-info-circle text-gray-400 cursor-pointer'></i>
                            <div class="hidden absolute top-0 rounded-lg bg-white px-4 py-2 tooltips" style="margin-left: 2rem;margin-top: -2rem;box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.16);">Image have 10 : 6 portion of ratio and have maximum length is 300 Kb</div>
                        </div>
                    </div>
                    <input type="file" name="image" id="imageComponent" class="text-input px-2 w-full" required>
                    <span class="error text-red-600 text-xs" id="imageError"></span>
                    @if($errors->has('image'))
                    <span class="error text-red-600 text-xs">{{ $errors->first('image') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="px-5 mb-5">
            <label for="" class="">Content</label>
            <textarea name="content" id="description" class="text-input px-2 w-full h-40 mb-1" placeholder="Add Content">{{$article->content}}</textarea>
            @if($errors->has('content'))
                <span class="error text-red-600 text-xs">{{ $errors->first('content') }}</span>
            @endif
        </div>
        <div class="flex flex-wrap justify-between items-center px-5">
            <a href="{{route('articles.index')}}" class="px-5 py-2 rounded-lg bg-gray-700 text-white hover:bg-gray-500 hidden md:flex">Back</a>
            <div class="flex flex-wrap justify-between items-center">
                {{-- <div class="py-2 md:p-3"><div class="px-5 py-2 rounded-lg bg-gray-300 text-black hover:bg-gray-500 cursor-pointer" data-action="" id="showPreview">Preview</div></div> --}}
                <div class="py-2 md:p-3"><div class="px-5 py-2 rounded-lg bg-green-700 text-white hover:bg-green-500 cursor-pointer" data-action="{{ route('articles.update', $article->id) }}" id="saveDraft">Save ad Draft</div></div>
                <div class="py-2 md:p-3"><div class="px-5 py-2 rounded-lg bg-indigo-700 text-white hover:bg-indigo-500 cursor-pointer" data-action="{{ route('articles.update', $article->id) }}" id="savePublication">Publish</div></div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script src="{{asset('src/vendor/tinymce/js/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
    @include('admin.articles.scripts')
@endpush
@endsection