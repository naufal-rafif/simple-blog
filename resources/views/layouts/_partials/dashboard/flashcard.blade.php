{{-- {{session('success')}} --}}
<div id="flashcard" class="w-full overflow-x-hidden">
    <div class="relative">
        @if(session('success'))
            <div
            class="fixed top-0 p-5 mt-20 right-0 bg-green-200 z-20 rounded-xl flex justify-between items-center mr-0 translate-x-full transition-all">
                <div class="text-gray-600">
                    <p class="font-semibold text-lg">Success!</p>
                    <p class="font-thin">{{session('success')}}</p>
                </div>
                <span class="bx bx-x-circle pl-6 text-center text-2xl cursor-pointer text-gray-500 hover:text-gray-700"></span>
            </div>
        @endif
        @if(session('error'))
            <div class="fixed top-0 p-5 mt-20 right-0 z-20 bg-red-200 rounded-xl flex justify-between items-center mr-0 translate-x-full transition-all">
                <div class="text-gray-600">
                    <p class="font-semibold text-lg">Failed!</p>
                    <p class="font-thin">{{session('error')}}</p>
                </div>
                <span class="bx bx-x-circle pl-6 text-center text-2xl cursor-pointer text-gray-500 hover:text-gray-700"></span>
            </div>
        @endif
    </div>
</div>