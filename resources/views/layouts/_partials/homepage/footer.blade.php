<?php 
    if(isset($agendas)){
        if(count($agendas)>=1){
            $hasil = 'ada';
        } else {
            if(request()->query->count() > 0){
                $hasil = 'ada';
            } else {
                $hasil = NULL;
            }
        }
    } else if(isset($articles)){
        if(count($articles)>=1){
            $hasil = 'ada';
        } else {
            if(request()->query->count() > 0){
                $hasil = 'ada';
            } else {
                $hasil = NULL;
            }
        }
    } else if(isset($lpjs)){
        if(count($lpjs)>=1){
            $hasil = 'ada';
        } else {
            if(request()->query->count() > 0){
                $hasil = 'ada';
            } else {
                $hasil = NULL;
            }
        }
    } else if(isset($article)){
        $hasil = 'ada';
    }  else if(isset($agenda)){
        $hasil = 'ada';
    } else if(request()->segment(1) == 'donasi'){
        $hasil = 'ada';
    } else {
        $hasil = NULL;
    }
;?>
<footer class="bottom-0 {{$hasil == NULL ? 'absolute md:absolute' : 'fixed'}} w-full lg:pt-20 bg-white">
    <div class="bottom-0 w-full bg-[#EFF6FF]">
        <div class="container mx-auto flex flex-wrap text-center px-4 lg:px-8 lg:text-right justify-between items-center py-3">
            <p class="w-full lg:w-auto">Design by <span class="font-bold">me.</span></p>
            <p class="w-full lg:w-auto lg:order-first">© Copyright 2022 <span class="font-bold">Naufal Rafif</span>
                Alright Reserved</p>
                <p>Buy me a coffee</p>
        </div>
    </div>
</footer>