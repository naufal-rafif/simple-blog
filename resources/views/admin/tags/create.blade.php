@extends('layouts.dashboard')
@section('content')

<div class="container mx-2">
    <div class="block md:flex justify-between items-center">
        <div class="mb-3">
            <h2 class="font-semibold text-2xl">Edit Tags</h2>
        </div>
    </div>
</div>

<div class="card mb-8">
    <form action="{{ route('tags.store') }}" method="POST" autocomplete="off" id="formUpload">
        @csrf
        <div class="flex flex-wrap">
            <div class="basis-full md:basis-1/2">
                <div class="px-5 mb-5">
                    <label for="" class="mb-2">Name</label>
                    <input name="name" id="tagName" class="text-input px-2 mt-1 w-full" placeholder="Add name" value="{{old('name')}}" required/>
                    @if($errors->has('name'))
                        <span class="error text-red-600 text-xs">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="flex">
                    <div class="px-5 mb-5">
                        <label for="" class="mb-2">Color</label>
                        <input type="color" name="color" id="tagColor" class="text-input px-2 mt-1 w-20 h-20" value="{{old('color')}}"/>
                    </div>
                    <div class="px-5 mb-5">
                        <label for="" class="mb-2">Backgorund</label>
                        <input type="color" name="background" id="tagBackground" class="text-input px-2 mt-1 w-20 h-20" value="{{old('background')}}"/>
                    </div>
                    <div class="px-5 mb-5">
                        <label for="" class="mb-2">Preview</label>
                        <div>
                            <span class="text-lg py-1 px-2 rounded-lg" id="changePreview" style="color: {{old('color')}}; background: {{old('background')}}">{{old('name')}}</span>
                        </div>
                    </div>
                </div>
                <div class="px-5 mb-5 flex justify-between">
                    <a href="{{route('tags.index')}}" class="px-5 py-2 rounded-lg bg-gray-700 text-white hover:bg-gray-500 hidden md:flex mr-3">Back</a>
                    <button type="submit" class="px-5 py-2 rounded-lg bg-indigo-700 text-white hover:bg-indigo-500 cursor-pointer">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('tagName').addEventListener('input', ()=> {
        document.getElementById('changePreview').innerHTML = document.getElementById('tagName').value
    })
    document.getElementById('tagColor').addEventListener('input', ()=> {
        document.getElementById('changePreview').style.color = document.getElementById('tagColor').value
    })
    document.getElementById('tagBackground').addEventListener('input', ()=> {
        document.getElementById('changePreview').style.background = document.getElementById('tagBackground').value
    })
</script>

@endsection