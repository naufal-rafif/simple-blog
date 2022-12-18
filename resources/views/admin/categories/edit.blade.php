@extends('layouts.dashboard')
@section('content')

<div class="container mx-2">
    <div class="block md:flex justify-between items-center">
        <div class="mb-3">
            <h2 class="font-semibold text-2xl">Edit Category</h2>
        </div>
    </div>
</div>

<div class="card mb-8">
    <form action="{{ route('categories.update', $category->id) }}" method="POST" autocomplete="off" id="formUpload" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex flex-wrap">
            <div class="basis-full md:basis-1/2">
                <div class="px-5 mb-5">
                    <label for="" class="mb-2">Name</label>
                    <input name="name" id="" class="text-input px-2 mt-1 w-full" placeholder="Add name" value="{{$category->name}}" required/>
                    @if($errors->has('name'))
                        <span class="error text-red-600 text-xs">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="px-5 mb-5 flex">
                    <a href="{{route('categories.index')}}" class="px-5 py-2 rounded-lg bg-gray-700 text-white hover:bg-gray-500 hidden md:flex mr-3">Back</a>
                    <button type="submit" class="px-5 py-2 rounded-lg bg-indigo-700 text-white hover:bg-indigo-500 cursor-pointer" id="savePublication">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection