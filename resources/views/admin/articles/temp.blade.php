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
            <a  data-val="{{route('dashboard.articles.destroyMultiple')}}" class="md:ml-8 text-sm text-red-600 font-semibold cursor-pointer hidden" id="checkDestroy">Destroy All</a>
            <p class="px-5 text-gray-300 hidden" id="separator">|</p>
            <a data-val="{{route('dashboard.articles.recoverMultiple')}}" class="text-sm text-green-700 font-semibold cursor-pointer hidden" id="checkPemulihan">Recover All</a>
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
                       <button data-val="{{route('articles.destroy',$article->id)}}" class="btn_empty mr-2 transform hover:text-indigo-500 hover:scale-110 text-red-600">
                            <span class="bx bx-trash text-lg"></span>
                        </button>
                        <button data-val="{{route('dashboard.articles.recover',$article->id)}}" class="btn_recover mr-2 transform hover:text-indigo-500 hover:scale-110 text-green-600">
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
                                {{-- <a class="btn btn-primary" href="{{ route('article.edit',$article->id) }}">Edit</a> --}}
                                @csrf
                                <div id="deleteMethod">
                                    
                                </div>
                                <input type="hidden" name="ids" id="ids">
                                <div class="text-center"><span class="bx bx-info-circle text-yellow-300 text-6xl"></span></div>
                                <h1 class="font-semibold text-center text-xl text-gray-600">Are u sure ?</h1>
                                <p class="font-thin text-center text-lg text-gray-600" id="warningText">Data yang terhapus dapat dilihat pada halaman sampah</p>
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
    <!-- <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" id=""></div> -->

</div>
<script>
    const showModalSosmed = document.getElementById('tableList')
    const closeModalSosmed = document.getElementById('closeModalSosmed')

    showModalSosmed.addEventListener('click', (e) => {
        console.log()
        // console.log(e.target.parentElement.dataset.val)
        if (e.target.parentElement.classList[0] == 'btn_empty') {
            document.getElementById('modalSosmed').classList.toggle('hidden')
            document.getElementById('modalSosmed').classList.add('show')
            document.getElementById('deleteMethod').innerHTML = '<input type="hidden" name="_method" value="DELETE">'
            document.getElementById('modalSosmed').classList.remove('hide')
            document.getElementById('formDelete').action = e.target.parentElement.dataset.val
            document.getElementById('warningText').innerHTML = 'Data will be deleted permanently.'
        } else if (e.target.parentElement.classList[0] == 'btn_recover') {
            document.getElementById('modalSosmed').classList.toggle('hidden')
            document.getElementById('modalSosmed').classList.add('show')
            document.getElementById('deleteMethod').innerHTML = ''
            document.getElementById('modalSosmed').classList.remove('hide')
            document.getElementById('formDelete').action = e.target.parentElement.dataset.val
            document.getElementById('warningText').innerHTML = 'Data will be restored to article page'
        }
    })
    
    
    closeModalSosmed.addEventListener('click', (e) => {
        // console.log(e.target.id)
        if (e.target.id == 'closeModalSosmed' || e.target.id == 'closeButton') {
            document.getElementById('modalSosmed').classList.remove('show')
            document.getElementById('modalSosmed').classList.add('hide')
            setTimeout(function () { document.getElementById('modalSosmed').classList.toggle('hidden') }, 500);
        }
    })
    
    document.getElementById('checkPemulihan').addEventListener('click', ()=>{
        const checkbox = document.getElementsByClassName("checkbox");
        let checkValue = ''
        // console.log(checkbox[0].dataset.id)
        for(i=0;i<checkbox.length;i++){
            if(checkbox[i].checked == true){
                checkValue += checkbox[i].dataset.id + ','
            }
        }
        document.getElementById('modalSosmed').classList.toggle('hidden')
        document.getElementById('modalSosmed').classList.add('show')
        document.getElementById('modalSosmed').classList.remove('hide')
        document.getElementById('deleteMethod').innerHTML = ''
        document.getElementById('warningText').innerHTML = 'All data will be restored to article page'
        document.getElementById('checkPemulihan').dataset.val
        document.querySelector('#formDelete > #ids').value = checkValue.slice(0, -1)
        document.getElementById('formDelete').action = document.getElementById('checkPemulihan').dataset.val
    })
    
    document.getElementById('checkDestroy').addEventListener('click', ()=>{
        const checkbox = document.getElementsByClassName("checkbox");
        let checkValue = ''
        // console.log(checkbox[0].dataset.id)
        for(i=0;i<checkbox.length;i++){
            if(checkbox[i].checked == true){
                checkValue += checkbox[i].dataset.id + ','
            }
        }
        // document.getElementById('deleteMethod').innerHTML = '<input type="hidden" name="_method" value="DELETE">'
        document.getElementById('modalSosmed').classList.toggle('hidden')
        document.getElementById('modalSosmed').classList.add('show')
        document.getElementById('modalSosmed').classList.remove('hide')
        document.getElementById('warningText').innerHTML = 'All data will be deleted permanently'
        document.getElementById('checkDestroy').dataset.val
        document.querySelector('#formDelete > #ids').value = checkValue.slice(0, -1)
        document.getElementById('formDelete').action = document.getElementById('checkDestroy').dataset.val
    })

    const checkBoxes = (e) => {
        const checkbox = document.getElementsByClassName("checkbox");
        let checkValue = ''
        let lengthChecked = 0
        let lengthUnchecked = 0
        for(i=0;i<checkbox.length;i++){
            if(checkbox[i].checked == true){
                checkValue += checkbox[i].dataset.id + ','
                lengthChecked = lengthChecked + 1
            } else {
                lengthUnchecked = lengthUnchecked + 1
            }
        }
        if(lengthChecked == 0){
            document.getElementById('checkboxEvent').checked = false
            document.getElementById('checkDestroy').classList.add('hidden')
            document.getElementById('checkPemulihan').classList.add('hidden')
            document.getElementById('separator').classList.add('hidden')
        } else {
            document.getElementById('checkDestroy').classList.remove('hidden')
            document.getElementById('checkPemulihan').classList.remove('hidden')
            document.getElementById('separator').classList.remove('hidden')
        }
        // e.checked == true ? 
    }
</script>
@endsection