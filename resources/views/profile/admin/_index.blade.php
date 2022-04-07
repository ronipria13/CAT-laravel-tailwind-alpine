@extends('layouts.app.main')

@section('title', ' | Profile User')

@section('content')
<h3 class="text-gray-700 text-3xl font-medium">Profile User</h3>
<div class="container bg-white p-10 my-10" x-data="userCrud()">
    {{-- <button class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="livewire.emit('refreshUser')">Refresh Table</button> --}}
    <div x-show="successAlert.open" class="relative py-3 pl-4 pr-10 leading-normal text-blue-700 bg-blue-100 rounded-lg mb-3" role="alert">
        <p x-text="successAlert.message">A simple alert with text and a right icon</p>
        <span class="absolute inset-y-0 right-0 flex items-center mr-4" @click="successAlert.open = false">
          <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
        </span>
    </div>

    <div class="bg-gray-200 font-sans h-96 pt-20 w-full flex flex-row justify-center items-center">
        <div class="card w-96 mx-auto bg-white  shadow-xl hover:shadow">
           <img class="w-32 mx-auto rounded-full -mt-20 border-8 border-white" src="{{ asset('images/avatar/default-user-icon.jpg') }}" alt="">
           <div class="text-center mt-2 text-3xl font-medium">{{ $user->name }}</div>
           <div class="text-center mt-2 font-light text-sm">{{ $user->username }}</div>
           <div class="text-center font-normal text-lg">{{ $current_role_name }}</div>
           <div class="px-6 text-center mt-2 font-light text-sm">
           </div>
           <hr class="mt-8">
           <div class="flex p-4">
             <div class="w-full text-center">
               Bergabung sejak : <span class="font-bold">{{ date('d M Y', strtotime( substr($user->created_at,0,10) )) }}</span>
             </div>
           </div>
        </div>
      </div>

</div>
@endsection
