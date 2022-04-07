@extends('layouts.app.main')

@section('title', ' | Paket Soal : ' . $paketsoal->name)

@section('content')
<h3 class="text-gray-700 text-3xl font-medium">Paket Soal : {{ $paketsoal->name }}</h3>
<div class="container bg-white p-10 my-10" x-data="latihanCrud()">
    {{-- <button class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="livewire.emit('refreshUser')">Refresh Table</button> --}}
    <div x-show="successAlert.open" class="relative py-3 pl-4 pr-10 leading-normal text-blue-700 bg-blue-100 rounded-lg mb-3" role="alert" x-init="console.log(soal_list)">
        <p x-text="successAlert.message">A simple alert with text and a right icon</p>
        <span class="absolute inset-y-0 right-0 flex items-center mr-4" @click="successAlert.open = false">
          <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
        </span>
    </div>
    <div class="w-full flex flex-row" x-init="counter()">
        <div class="w-16 h-16 mx-1 border-2 align-middle rounded-lg border-gray-500">
            <h3 class="text-bold text-5xl text-center" x-text="countdown.hour">00</h3>
        </div>
        <div class="h-16 mx-1 animate-pulse">
            <h3 class="text-bold text-5xl text-center">:</h3>
        </div>
        <div class="w-16 h-16 mx-1 border-2 align-middle rounded-lg border-gray-500">
            <h3 class="text-bold text-5xl text-center" x-text="countdown.minute">00</h3>
        </div>
        <div class="h-16 mx-1 animate-pulse">
            <h3 class="text-bold text-5xl text-center">:</h3>
        </div>
        <div class="w-16 h-16 mx-1 border-2 align-middle rounded-lg border-gray-500">
            <h3 class="text-bold text-5xl text-center" x-text="countdown.second">00</h3>
        </div>
        <button class="text-xl font-bold border-2 hover:border-black border-blue-400 hover:bg-white bg-blue-400 
        hover:text-black text-white py-1 px-10 mx-2 rounded-md
        disabled:bg-white disabled:border-black disabled:text-blue-400 disabled:cursor-not-allowed"
        @click="confFinishIt()" style="display: none" >Selesaikan</button>
    </div>
    <div class="w-full my-5 grid lg:grid-cols-2 md:grid-cols-1 gap-2 p-2">
        <div x-init="renderSoal()">
            <h2 class="text-xl font-bold mb-2 mt-20">KOLOM <span x-text="label.kolom.no">0</span> </h2>
            <table class="w-full mb-5">
                <thead>
                    <tr>
                        <th class="border-2 border-black">a</th>
                        <th class="border-2 border-black">b</th>
                        <th class="border-2 border-black">c</th>
                        <th class="border-2 border-black">d</th>
                        <th class="border-2 border-black">e</th>
                    </tr>
                    <tr>
                        <th class="border-2 border-black text-xl" x-text="label.kolom.a">0</th>
                        <th class="border-2 border-black text-xl" x-text="label.kolom.b">0</th>
                        <th class="border-2 border-black text-xl" x-text="label.kolom.c">0</th>
                        <th class="border-2 border-black text-xl" x-text="label.kolom.d">0</th>
                        <th class="border-2 border-black text-xl" x-text="label.kolom.e">0</th>
                    </tr>
                </thead>
            </table>
            <h2 class="w-full mt-20 text-xl font-bold mb-2" style="display: none">Soal <span x-text="label.soal.no">0</span> </h2>
            <div class="w-full flex flex-row justify-center mt-20 mb-2">
                
                <table class="w-2/3">
                    <thead>
                        <tr>
                            <th class="text-2xl font-bold" x-text="label.soal.a">0</th>
                            <th class="text-2xl font-bold" x-text="label.soal.b">0</th>
                            <th class="text-2xl font-bold" x-text="label.soal.c">0</th>
                            <th class="text-2xl font-bold" x-text="label.soal.d">0</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <h2 class="w-full mt-20 text-xl font-bold mb-2" style="display: none">Jawaban Soal <span x-text="label.soal.no">0</span> </h2>
            <div class="w-full flex flex-wrap justify-center mt-20 mb-2">
                <button class="lg:text-xl md:text-base font-bold border-2 border-black hover:border-blue-400 hover:bg-blue-400 hover:text-white py-1 md:px-5 px-3 m-2 rounded-md disabled:bg-slate-400 disabled:cursor-not-allowed" :disabled="answerBtn.a" @click="answerIt('a')">A</button>
                <button class="lg:text-xl md:text-base font-bold border-2 border-black hover:border-blue-400 hover:bg-blue-400 hover:text-white py-1 md:px-5 px-3 m-2 rounded-md disabled:bg-slate-400 disabled:cursor-not-allowed" :disabled="answerBtn.b" @click="answerIt('b')">B</button>
                <button class="lg:text-xl md:text-base font-bold border-2 border-black hover:border-blue-400 hover:bg-blue-400 hover:text-white py-1 md:px-5 px-3 m-2 rounded-md disabled:bg-slate-400 disabled:cursor-not-allowed" :disabled="answerBtn.c" @click="answerIt('c')">C</button>
                <button class="lg:text-xl md:text-base font-bold border-2 border-black hover:border-blue-400 hover:bg-blue-400 hover:text-white py-1 md:px-5 px-3 m-2 rounded-md disabled:bg-slate-400 disabled:cursor-not-allowed" :disabled="answerBtn.d" @click="answerIt('d')">D</button>
                <button class="lg:text-xl md:text-base font-bold border-2 border-black hover:border-blue-400 hover:bg-blue-400 hover:text-white py-1 md:px-5 px-3 m-2 rounded-md disabled:bg-slate-400 disabled:cursor-not-allowed" :disabled="answerBtn.e" @click="answerIt('e')">E</button>
            </div>
            <div class="w-full flex justify-between mt-20 mb-2" style="display: none">
                <button 
                class="text-xl font-bold border-2 hover:border-black border-blue-400 hover:bg-white bg-blue-400 
                hover:text-black text-white py-1 px-10 mx-2 rounded-md
                disabled:bg-white disabled:border-black disabled:text-blue-400 disabled:cursor-not-allowed" 
                :disabled="btnPrev" 
                @click="prevSoal()">Prev</button>
                <button 
                class="text-xl font-bold border-2 hover:border-black border-blue-400 hover:bg-white bg-blue-400 
                hover:text-black text-white py-1 px-10 mx-2 rounded-md
                disabled:bg-white disabled:border-black disabled:text-blue-400 disabled:cursor-not-allowed"
                :disabled="btnNext" @click="nextSoal()">Next</button>
                
            </div>
        </div>
        <div class="bg-slate-300 w-full">
            <div class="mx-10 grid grid-cols-10 gap-1" x-html="soalboxes">
                <div class="bg-blue-200 p-1 border border-black text-center">1</div>
            </div>
        </div>
    </div>

    <!-- ini datatable -->
</div>
@endsection

<!-- Your Custom Javascript -->
@section('_inJs')
@include('app.latihan.paketsoal._inJs')
@endsection
<!-- /Your Custom Javascript --> 