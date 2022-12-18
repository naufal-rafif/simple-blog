@extends('layouts.dashboard')
@section('content')

<div class="container mx-2">
    <div class="block md:flex justify-between items-center">
        <div class="mb-3">
            <h2 class="font-semibold text-2xl">Edit Articles</h2>
        </div>
    </div>
</div>

<div class="card hidden">
    <div class="flex flex-wrap justify-between items-center">
        <div class="mb-3">
            <p class="text-lg font-semibold">Tag</p>
            <p class="text-sm font-thin text-gray-500 hidden">*if you want to submit an article, add tag before you input an article.</p>
        </div>
        <button class="px-4 py-2 bg-slate-900 text-sm rounded-lg text-white hover:bg-slate-700 flex items-center mb-3 " id="showModalMessage">Maintain Tag</button>
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

<div class="relative z-[99999] hide hidden " id="modalAdd" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="fixed inset-0 z-10 overflow-y-auto bg-gray-500/75 ">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0"
            id="closeModalAdd">
            <div
                class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl py-5">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="py-8">
                        <div class="px-5">
                            <div class="flex justify-between mb-5">
                                <p class="font-semibold text-2xl text-gray-700">Maintain Tag</p>
                                <button class="px-2 py-1 bg-slate-900 rounded-lg text-sm text-white hover:bg-slate-700 " id="addTag">tambah</button>
                            </div>
                            <div class="table-roll w-full overflow-x-auto">
                                <table class="table-auto w-full mb-5">
                                    <thead>
                                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                                            <th class="py-3 px-3 text-left">Preview</th>
                                            <th class="py-3 px-3 text-left">Tag</th>
                                            <th class="py-3 px-3 text-left">Background</th>
                                            <th class="py-3 px-3 text-left">Font Color</th>
                                            <th class="py-3 px-3 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 text-sm font-light" id="tableModalList">
                                        <form method="POST" action="" autocomplete="off">
                                            <input type="hidden" name="category" value="article">
                                            @csrf
                                            <tr class="border-b border-gray-200 hover:bg-gray-100 hidden" id="showTag">
                                                <td class="py-3 px-3 text-left">
                                                    <span class="changeSpan text-sm py-1 px-2 rounded-lg" style="color: #ffffff; background: #000000"></span>
                                                </td>
                                                <td class="py-3 px-3 text-left">
                                                    <input class="text-base w-32 text-input" name="name" >
                                                </td>
                                                <td class="py-3 px-3 text-left">
                                                    <div class="flex items-center mx-2">
                                                        <span class="spanColor hidden">Pilih Warna</span>
                                                        <input type="color" class="rounded-lg" name="background" value="#000000" id="">
                                                    </div>
                                                </td>
                                                <td class="py-3 px-3 text-left">
                                                    <div class="flex items-center mx-2">
                                                        <span class="spanColor hidden">Pilih Warna</span>
                                                        <input type="color" class="input_name rounded-lg" value="#ffffff" name="color" id="">
                                                    </div>
                                                </td>
                                                <td class="py-3 px-3 text-center">
                                                    <div class="flex item-center justify-center">
                                                        <button type="submit" class="mx-2 px-2 py-1 border-2 border-green-600 text-green-600 rounded-lg text-sm hover:bg-green-500 hover:text-white saveButton">simpan</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </form>
                                        @foreach ($tags as $tag)
                                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                                <td class="py-3 px-3 text-left">
                                                    <span class="changeSpan text-sm py-1 px-2 rounded-lg" style="color: {{$tag->color}}; background: {{$tag->background}}">{{$tag->name}}</span>
                                                </td>
                                                <td class="py-3 px-3 text-left">
                                                    <input class="text-base w-32 input_name" name="name" value="{{$tag->name}}" style="outline: none;background: transparent;" disabled>
                                                </td>
                                                <td class="py-3 px-3 text-left">
                                                    <div class="flex items-center mx-2">
                                                        <span class="spanColor hidden">Pilih Warna</span>
                                                        <input type="color" class="input_name rounded-lg" name="background" id="" value="{{$tag->background}}" disabled style="outline: none">
                                                        <span class="colorValue uppercase">{{$tag->background}}</span>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-3 text-left">
                                                    <div class="flex items-center mx-2">
                                                        <span class="spanColor hidden">Pilih Warna</span>
                                                        <input type="color" class="input_name rounded-lg" name="color" id="" value="{{$tag->color}}" disabled style="outline: none">
                                                        <span class="colorValue uppercase">{{$tag->color}}</span>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-3 text-center">
                                                    <div class="flex item-center justify-center">
                                                        <button class="mx-2 px-2 py-1 border-2 border-blue-500 text-blue-500 rounded-lg text-sm hover:bg-blue-700 hover:text-white editButton show">edit</button>
                                                        <button class="mx-2 px-2 py-1 border-2 border-green-600 text-green-600 rounded-lg text-sm hover:bg-green-500 hover:text-white saveButton hidden" data-name="{{$tag->name}}" data-color="{{$tag->color}}" data-background="{{$tag->background}}" data-route="">simpan</button>
                                                        <button class="mx-2 px-2 py-1 bg-white border-2 border-red-600 text-red-600 rounded-lg text-sm hover:bg-red-800 hover:text-white deleteButton show" data-route="">hapus</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-between">
                                <div></div>
                                
                                <button class="mx-2 px-2 py-1 border-2 border-gray-600 text-gray-600 rounded-lg text-sm hover:bg-gray-500 hover:text-white" id="closeButton">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" id=""></div> -->

</div>
<div class="relative z-[99999] hide hidden" id="modalSosmed" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="fixed inset-0 z-10 overflow-y-auto bg-gray-500/75 ">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0"
            id="closeModalSosmed">
            <div
                class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg py-5">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="py-8">
                        <div class="px-5">
                            <form method="POST" id="formDelete">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="category" value="article">
                                <div class="text-center"><span class="bx bx-info-circle text-yellow-300 text-6xl"></span></div>
                                <h1 class="font-semibold text-center text-xl text-gray-600">Are you sure ?</h1>
                                <p class="font-thin text-center text-lg text-gray-600" id="warningText">Data will be disappear.</p>
                                <div class="flex justify-center mt-5">
                                    <div class="w-1/2 px-4 py-2 mx-2 text-gray-500 border-2 border-gray-300 font-semibold text-sm rounded-lg hover:bg-gray-500 hover:text-white text-center cursor-pointer" id="closeButton">Cancel</div>
                                    <button type="submit" class="w-1/2 px-4 py-2 text-white border-2 border-gray-700 mx-2 bg-blue-500 font-semibold text-sm rounded-lg hover:bg-blue-700 hover:text-white">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hidden">
    <form method="POST" id="formUpdate">
        @csrf
        @method('PUT')
        <input type="hidden" name="category" value="article">
        <input type="hidden" id="updateName" name="name">
        <input type="hidden" id="updateColor" name="color">
        <input type="hidden" id="updateBackground" name="background">
    </form>
</div>

<script src="{{asset('src/vendor/tinymce/js/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
<script>
    document.getElementById('saveDraft').addEventListener('click', (e)=>{
        const inputTags = document.getElementById('tagList').querySelectorAll('.relative > p')
        var showTags = ''
        for(var i = 0; i < inputTags.length; i++) {
            showTags = showTags + ',' + inputTags[i].dataset.id ;
        }
        document.getElementById('tagOutput').value = showTags.substr(1);
        document.getElementById('statusArticle').value = 0
        if(document.getElementById('tagOutput').value != ''){
            document.getElementById('formUpload').action = e.target.dataset.action
                document.getElementById('formUpload').submit();
        } else {
            document.getElementById('tagError').innerHTML = 'tag tidak boleh kosong silahkan diisi terlebih dahulu'
        }
    })
    document.getElementById('savePublication').addEventListener('click', (e)=>{
        const inputTags = document.getElementById('tagList').querySelectorAll('.relative > p')
        var showTags = ''
        for(var i = 0; i < inputTags.length; i++) {
            showTags = showTags + ',' + inputTags[i].dataset.id ;
        }
        document.getElementById('tagOutput').value = showTags.substr(1);
        document.getElementById('statusArticle').value = 1
        if(document.getElementById('tagOutput').value != ''){
            document.getElementById('formUpload').action = e.target.dataset.action
            document.getElementById('formUpload').target = ''
            document.getElementById('formUpload').submit();
        } else {
            document.getElementById('tagError').innerHTML = 'tag tidak boleh kosong silahkan diisi terlebih dahulu'
        }
    })
    document.getElementById('showPreview').addEventListener('click', (e)=>{
        if(document.getElementById('imageComponent').value != ''){
            const inputTags = document.getElementById('tagList').querySelectorAll('.relative > p')
            var showTags = ''
            for(var i = 0; i < inputTags.length; i++) {
                showTags = showTags + ',' + inputTags[i].dataset.id ;
            }
            document.getElementById('tagOutput').value = showTags.substr(1);
            if(document.getElementById('tagOutput').value != ''){
                document.getElementById('formUpload').action = e.target.dataset.action
                document.getElementById('formUpload').target = '_blank'
                document.getElementById('formUpload').submit();
                document.getElementById('formUpload').target = ''
                document.getElementById('tagError').innerHTML = ''
            } else{
                document.getElementById('tagError').innerHTML = 'tag tidak boleh kosong silahkan diisi terlebih dahulu'
            }
        } else {
            document.getElementById('imageError').innerHTML = 'gambar tidak boleh kosong silahkan diisi terlebih dahulu'
        }
    })
</script>
<script>
   tinymce.init({
    setup : function(ed) {
      ed.on('keydown', function(event) {
        if (event.keyCode == 9) { // tab pressed
            ed.execCommand('mceInsertContent', false, '&emsp;&emsp;'); // inserts tab
            event.preventDefault();
            return false;
        }
        if (event.keyCode == 32) { // space bar
            if (event.shiftKey) {
                ed.execCommand('mceInsertContent', false, '&hairsp;'); // inserts small space
                event.preventDefault();
                return false;
            }
        }
      });
    },
     selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
     plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help',
   });

    document.getElementById('tagList').addEventListener('click', (e) => {
        if(e.target.classList[0] == 'relative'){
            e.target.remove()
        } else if(e.target.classList[0] == 'py-2' || e.target.classList[0] == 'bx'){
            e.target.parentElement.remove()
        }
    })

    document.getElementById('tagValue').addEventListener('input', (e) => {
        document.getElementById('tagList').innerHTML += `
        <div class="relative w-full">
            <p class="py-2 px-2 rounded border-1 bg-gray-200 px-2 mb-2" data-id="${e.target.value}">${e.target.options[e.target.selectedIndex].text}</p>
            <span class="bx bx-x absolute right-0 top-0 text-xl font-bold p-2 cursor-pointer"></span>
        </div>`
    })
</script>
<script>
    const showModalMessage = document.getElementById('showModalMessage')
    const closeModalSosmed = document.getElementById('closeModalSosmed')
    const closeModalAdd = document.getElementById('closeModalAdd')
    const tableModalList = document.getElementById('tableModalList')
    const addTag = document.getElementById('addTag')

    closeModalSosmed.addEventListener('click', (e) => {
        // console.log(e.target.id)
        if (e.target.id == 'closeModalSosmed' || e.target.id == 'closeButton') {
            document.getElementById('modalSosmed').classList.remove('show')
            document.getElementById('modalSosmed').classList.add('hide')
            setTimeout(function () { document.getElementById('modalSosmed').classList.toggle('hidden') }, 500);
        }
    })

    closeModalAdd.addEventListener('click', (e) => {
        // console.log(e.target.id)
        if (e.target.id == 'closeModalAdd' || e.target.id == 'closeButton') {
            document.getElementById('modalAdd').classList.remove('show')
            document.getElementById('modalAdd').classList.add('hide')
            setTimeout(function () { document.getElementById('modalAdd').classList.toggle('hidden') }, 500);
        }
    })
    
    showModalMessage.addEventListener('click', (e) => {
        document.getElementById('modalAdd').classList.toggle('hidden')
        document.getElementById('modalAdd').classList.add('show')
        document.getElementById('modalAdd').classList.remove('hide')
    })

    tableModalList.addEventListener('click', (e)=>{
        // console.log(e.target.closest('.border-b'))
        checkButton = e.target.classList.length - 2
        if(e.target.classList[checkButton] == 'editButton'){
            // e.target.closest('.border-b').querySelector('input[name=tagName]').disabled = false
            // e.target.closest('.border-b').querySelector('input[name=backgroundColor]').disabled = false
            // e.target.closest('.border-b').querySelector('input[name=fontColor]').disabled = false
            var inputs = e.target.closest('.border-b').getElementsByClassName('input_name');
            for(var i = 0; i < inputs.length; i++) {
                inputs[i].disabled = false;
            }
            const lengthSpanColor = e.target.closest('.border-b').getElementsByClassName('spanColor')
            for(var i = 0; i < lengthSpanColor.length; i++) {
                lengthSpanColor[i].classList.toggle('hidden')
            }
            const lengthValueColor = e.target.closest('.border-b').getElementsByClassName('colorValue')
            for(var i = 0; i < lengthValueColor.length; i++) {
                lengthValueColor[i].classList.toggle('hidden')
            }
            e.target.closest('.border-b').querySelector('.saveButton').classList.toggle('show')
            e.target.closest('.border-b').querySelector('.saveButton').classList.toggle('hidden')
            e.target.classList.toggle('show')
            e.target.classList.toggle('hidden')
        } else if (e.target.classList[checkButton] == 'deleteButton'){
            document.getElementById('formDelete').action = e.target.dataset.route
            document.getElementById('modalSosmed').classList.toggle('hidden')
            document.getElementById('modalSosmed').classList.add('show')
            document.getElementById('modalSosmed').classList.remove('hide')
        } else if (e.target.classList[checkButton] == 'saveButton'){
            document.getElementById('formUpdate').action = e.target.dataset.route
            document.getElementById('updateName').value = e.target.closest('.border-b').querySelector('input[name=name]').value
            document.getElementById('updateColor').value = e.target.closest('.border-b').querySelector('input[name=color]').value
            document.getElementById('updateBackground').value = e.target.closest('.border-b').querySelector('input[name=background]').value
            document.getElementById('formUpdate').submit()
        }
    })

    tableModalList.addEventListener('input', (e)=>{
        // console.log(e.target.name)
        if(e.target.name == 'tagName' || e.target.name == 'name'){
            e.target.closest('.border-b').querySelector('.changeSpan').innerHTML = `${e.target.value}` 
        }
        if(e.target.name == 'backgroundColor' || e.target.name == 'background'){
            e.target.closest('.border-b').querySelector('.changeSpan').style.background = `${e.target.value}` 
        }
        if(e.target.name == 'fontColor' || e.target.name == 'color'){
            e.target.closest('.border-b').querySelector('.changeSpan').style.color = `${e.target.value}` 
        }
    })

    addTag.addEventListener('click', () => {
        document.getElementById('showTag').classList.toggle('hidden')
        addTag.innerHTML == 'tambah' ? addTag.innerHTML = 'Cancel' : addTag.innerHTML = 'tambah'
        addTag.classList.toggle('hover:bg-green-700')
        addTag.classList.toggle('bg-green-500')
        addTag.classList.toggle('hover:bg-gray-700')
        addTag.classList.toggle('bg-gray-500')
    })

</script>

@endsection