@extends('layouts.app.main')

@section('title', ' | Dashboard')

@section('content')
<h3 class="text-gray-700 text-3xl font-medium">Dashboard</h3>
        
<div class="mt-4">
    <div class="flex flex-wrap -mx-6">
        <div class="w-full mt-6 px-6 xl:mt-0">
            <div class="flex flex-col items-left px-5 py-6 shadow-sm rounded-md bg-white">
                <h3 class="text-lg font-bold">Selamat Datang!</h3>
                <p class="font-bold">{{ $user->name }}, anda login sebagai {{ $current_role_name }}</p>
            </div>
        </div>
    </div>
</div>

@endsection