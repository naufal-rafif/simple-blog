@extends('layouts.auth')

@section('content')
<div class="flex justify-center">
    <div class="grid content-center justify-items-center w-full px-5 md:w-1/2 lg:w-1/3 h-screen">
        <img src="{!! asset('src/img/logo.png') !!}" alt="" class="w-20 h-20 mr-2">
        <p class="text-2xl font-semibold">Welcome to the jungle !</p>
        {{-- Error Alert --}}
        @if(session('errors'))
            @if (session('errors')->first('login_failed'))
            <div class="flex items-center mt-5 bg-red-100 px-4 py-2 rounded-full" role="alert">
                <p class="text-md text-red-600">{{session('errors')->first('login_failed')}}</p>
                <span class="bx bx-x ml-3 cursor-pointer font-bold text-gray-600" id="closeAlert"></span>
            </div>
            @endif
        @endif
        <div class="mt-8 w-full">
            <form  action="{{url('login')}}" method="POST" id="form_reset" autocomplete="off">
                {{ csrf_field() }}
                <div class="flex justify-center px-3">
                    <div class="mb-2 w-full md:w-4/5 relative">
                        <div class="absolute top-0 px-4 py-2 text-xs text-gray-400">Email</div>
                        <span class="bx bx-envelope absolute top-0 right-0 p-[1.15rem] text-gray-600"></span>
                        <input type="email"
                            class="form-control block border-2 w-full pt-5 px-4 pb-2 text-sm font-bold text-gray-700 bg-[#F2FAFF] bg-clip-padding border border-solid border-gray-300 {{$errors->has('email') ? 'border-red-600 bg-red-100' : 'focus:border-[#407BC1]'}} rounded-xl transition ease-in-out m-0 focus:text-gray-700 focus:outline-none"
                        id="exampleFormControlInput1" name="email" placeholder="" />
                        @if($errors->has('email'))
                            <span class="error text-red-600 text-xs">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="flex justify-center px-3">
                    <div class="mb-2 w-full md:w-4/5 relative">
                        <div class="absolute top-0 px-4 py-2 text-xs text-gray-400">Password</div>
                        <span class="bx bx-hide absolute top-0 right-0 p-[1.15rem] text-gray-600 cursor-pointer"></span>
                        <input type="password"
                            class="form-control block border-2 w-full pt-5 px-4 pb-2 text-sm font-bold text-gray-700 bg-[#F2FAFF] bg-clip-padding border border-solid border-gray-300   {{$errors->has('email') ? 'border-red-600 bg-red-100' : 'focus:border-[#407BC1]'}} rounded-xl transition ease-in-out m-0 focus:text-gray-700 focus:outline-none"
                        id="exampleFormControlInput1" name="password" placeholder="" />
                        @if($errors->has('password'))
                            <span class="error text-red-600 text-xs">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mt-3 flex justify-center px-3">
                    <button type="submit"
                        class="w-full md:w-4/5 bg-[#419CDE] hover:bg-blue-700 justify-center text-white py-2 rounded-md text-xl font-semibold">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('form_reset').addEventListener('click', (e) => {
        if (e.target.classList[0] == 'bx') {
            if(e.target.classList[1] != 'bx-envelope'){
                const parent = e.target.parentElement.getElementsByTagName("input")[0]
                parent.type == 'password' ? parent.type = 'text' : parent.type = 'password'
                e.target.classList.toggle('bx-show')
                e.target.classList.toggle('bx-hide')
            }
            // console.log(parent.type)
        }
    })
</script>
@endsection