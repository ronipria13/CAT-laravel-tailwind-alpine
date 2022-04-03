@extends('layouts.app.main')

@section('title', ' | Paket Soal Kecermatan')

@section('content')
<h3 class="text-gray-700 text-3xl font-medium">Paket Soal Kecermatan</h3>
<div class="container p-10 my-10" x-data="soalkecermatanCrud()">
    {{-- <button class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="livewire.emit('refreshUser')">Refresh Table</button> --}}
    <div x-show="successAlert.open"
        class="relative py-3 pl-4 pr-10 leading-normal text-blue-700 bg-blue-100 rounded-lg mb-3" role="alert">
        <p x-text="successAlert.message">A simple alert with text and a right icon</p>
        <span class="absolute inset-y-0 right-0 flex items-center mr-4" @click="successAlert.open = false">
            <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20">
                <path
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd" fill-rule="evenodd"></path>
            </svg>
        </span>
    </div>
    <div class="flex items-center">
        <div class="px-10 mx-auto container align-middle">
            <div class="grid grid-cols-2 gap-2">
                @foreach ($paketsoal as $item)
                <a href="/paketsoal/soalkecermatan/getready/{{ $item->id }}" class="shadow rounded-lg py-3 px-5 bg-white">
                    <div class="flex flex-row justify-between items-center">
                        <div>
                            <h6 class="text-2xl font-bold">{{ $item->name }}</h6>
                            <p>{{ $item->desc }}</p>
                            <h4 class="text-black text-2xl font-bold text-left">10 Kolom</h4>
                            <h4 class="text-black text-2xl font-bold text-left">500 Soal</h4>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                stroke="#EF4444" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-left flex flex-row justify-start items-center">
                        <p><span class="text-red-500 font-bold">10</span> menit</p>
                    </div>
                </a>
                    
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection

<!-- Your Custom Javascript -->
@section('_inJs')
@include('app.paketsoal.soalkecermatan._inJs')
@endsection
<!-- /Your Custom Javascript -->
