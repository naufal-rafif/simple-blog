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
                            <form method="post" id="formDelete">
                                @csrf
                                @method('DELETE')
                                <div class="text-center"><span class="bx bx-info-circle text-yellow-300 text-6xl"></span></div>
                                <h1 class="font-semibold text-center text-xl text-gray-600">Are you sure ?</h1>
                                <p class="font-thin text-center text-lg text-gray-600" id="warningText">Data will deleted permanently</p>
                                <div class="flex justify-center mt-5">
                                    <div class="w-1/2 px-4 py-2 mx-2 text-gray-500 border-2 border-gray-300 font-semibold text-sm rounded-lg hover:bg-gray-500 hover:text-white text-center cursor-pointer" id="closeButton">Cancel</div>
                                    <button type="submit" class="w-1/2 px-4 py-2 text-white border-2 border-gray-700 mx-2 bg-blue-500 font-semibold text-sm rounded-lg hover:bg-blue-700 hover:text-white text-center">Yes</button>
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
    // const submitButton = document.getElementById('submitButton')

    showModalSosmed.addEventListener('click', (e) => {
        console.log()
        // console.log(e.target.parentElement.dataset.val)
        if (e.target.parentElement.classList[0] == 'btn_empty') {
            document.getElementById('modalSosmed').classList.toggle('hidden')
            document.getElementById('modalSosmed').classList.add('show')
            document.getElementById('modalSosmed').classList.remove('hide')
            document.getElementById('formDelete').action = e.target.parentElement.dataset.val
        }
    })
    
    // submitButton.addEventListener('click', (e) => {
    //     // console.log('hai')
    //     document.getElementById('formDelete').submit()
    // })
    
    closeModalSosmed.addEventListener('click', (e) => {
        // console.log(e.target.id)
        if (e.target.id == 'closeModalSosmed' || e.target.id == 'closeButton') {
            document.getElementById('modalSosmed').classList.remove('show')
            document.getElementById('modalSosmed').classList.add('hide')
            setTimeout(function () { document.getElementById('modalSosmed').classList.toggle('hidden') }, 500);
        }
    })
    
</script>
@endsection