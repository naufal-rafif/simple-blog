
<div class="relative z-[99999] hide hidden" id="modalDelete" aria-labelledby="modal-title" role="dialog"
aria-modal="true">
<div class="fixed inset-0 z-10 overflow-y-auto bg-gray-500/75 ">
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0"
        id="closeModalDelete">
        <div
            class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg py-5">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="py-8">
                    <div class="px-5">
                        <form method="POST" id="formDelete">
                            @csrf
                            <div id="deleteMethod">
                                
                            </div>
                            <input type="hidden" name="ids" id="ids">
                            <div class="text-center"><span class="bx bx-info-circle text-yellow-300 text-6xl"></span></div>
                            <h1 class="font-semibold text-center text-xl text-gray-600">Are you sure ?</h1>
                            <p class="font-thin text-center text-lg text-gray-600" id="warningText"></p>
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
</div>