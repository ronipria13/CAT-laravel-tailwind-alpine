@extends('layouts.app.main')

@section('title', ' | Soal '.$paketsoal->name)

@section('content')
<h3 class="text-gray-700 text-3xl font-medium">{{ $paketsoal->name }}</h3>
<h3 class="text-gray-700 text-3xl font-medium">Soal Kolom : {{ $kolom->col_a }} {{ $kolom->col_b }} {{ $kolom->col_c }} {{ $kolom->col_d }} {{ $kolom->col_e }}</h3>
<div class="container bg-white p-10 my-10" x-data="soalkecermatanCrud()">
    {{-- <button class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="livewire.emit('refreshUser')">Refresh Table</button> --}}
    <div x-show="successAlert.open" class="relative py-3 pl-4 pr-10 leading-normal text-blue-700 bg-blue-100 rounded-lg mb-3" role="alert">
        <p x-text="successAlert.message">A simple alert with text and a right icon</p>
        <span class="absolute inset-y-0 right-0 flex items-center mr-4" @click="successAlert.open = false">
          <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
        </span>
    </div>
    <x-modal :value="1">
        <x-slot name="trigger">
            <a href="/data/paketsoal/kolom/{{ $kolom->paketsoal_id }}"
            class="relative bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mr-5 rounded mb-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                <i class="fa fa-arrow-left"></i>
                Kembali
            </a>
            <button  @click="addData"
            class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                <i class="fa fa-plus"></i>
                Tambah Data
            </button>
        </x-slot>
        
        <!-- Title -->
        <div class="border-b-2 border-black mb-4">
            <h2 class="text-3xl font-medium" :id="$id('modal-title')">Form Data Soal Kecermatan</h2>
        </div>
        <!-- Content -->
        <form action="#" @submit.prevent="confirmSave">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 my-3">
                    <h2 class="font-bold text-xl">Kolom</h2>
                    <h2 class="font-bold text-5xl text-center">
                        {{ $kolom->col_a }} {{ $kolom->col_b }} {{ $kolom->col_c }} {{ $kolom->col_d }} {{ $kolom->col_e }}
                    </h2>
                </div>
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="soal">
                        Soal
                    </label>
                    <div class="grid grid-flow-col grid-cols-4 gap-3">
                        <input name="a" x-model="soal.a"
                        class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                        type="text" 
                        placeholder="Soal..">
                        <input name="b" x-model="soal.b"
                        class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                        type="text" 
                        placeholder="Soal..">
                        <input name="c" x-model="soal.c"
                        class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                        type="text" 
                        placeholder="Soal..">
                        <input name="d" x-model="soal.d"
                        class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                        type="text" 
                        placeholder="Soal..">
                    </div>
                    <small x-text="errMsg.soal" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="key">
                        Kunci Jawaban
                    </label>
                    <input name="key" x-model="form.key"
                    class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                    type="text" autocomplete="off"
                    placeholder="Kunci Jawaban..">
                    <small x-text="errMsg.key" class="ml-3 text-xs text-red-500"></small>
                </div>
                              
            </div>
            <!-- Buttons -->
            <div class="mt-8 flex space-x-2 justify-end">
                <button type="button" x-on:click="openModal = false"  class="relative bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                    <i class="fa fa-times-circle"></i>
                    Cancel
                </button>
                <button type="submit" class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                    <i class="fa fa-check-circle"></i>
                    Save
                </button>
            </div>
        </form>
                
    </x-modal>

    <!-- ini datatable -->
    <livewire:data.soalkecermatan-table id="{{ $kolom->id }}"  />
    <!-- ini datatable -->
</div>
@endsection

<!-- Your Custom Javascript -->
@section('_inJs')
@include('app.data.soalkecermatan._inJs')
@endsection
<!-- /Your Custom Javascript -->