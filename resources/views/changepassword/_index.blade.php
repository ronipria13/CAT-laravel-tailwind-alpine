@extends('layouts.app.main')

@section('title', ' | Change Password')

@section('content')
<h3 class="text-gray-700 text-3xl font-medium">Change Password</h3>
        
<div class="mt-4" x-data="changepassCrud()">
    
    {{-- <button class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="livewire.emit('refreshUser')">Refresh Table</button> --}}
    <div x-show="successAlert.open" class="relative py-3 pl-4 pr-10 leading-normal text-blue-700 bg-blue-100 rounded-lg mb-3" role="alert">
        <p x-text="successAlert.message">A simple alert with text and a right icon</p>
        <span class="absolute inset-y-0 right-0 flex items-center mr-4" @click="successAlert.open = false">
          <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
        </span>
    </div>
    <div class="flex flex-wrap -mx-6">
        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
            <div class="flex flex-col items-center px-5 py-6 shadow-sm rounded-md bg-white">
                <form action="#" @submit.prevent="confirmSave">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full my-3 px-3" >
                            <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="oldpassword">
                                Password Lama
                            </label>
                            <input name="oldpassword" x-model="form.oldpassword" autocomplete="off"
                            class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" type="password" placeholder="Password Lama">
                            <small x-text="errMsg.oldpassword" class="ml-3 text-xs text-red-500"></small>
                        </div>
                        <div class="w-full my-3 px-3" >
                            <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="password">
                                Password Baru
                            </label>
                            <input name="password" x-model="form.password" autocomplete="off"
                            class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" type="password" placeholder="Password Baru">
                            <small x-text="errMsg.password" class="ml-3 text-xs text-red-500"></small>
                        </div>
                        <div class="w-full my-3 px-3">
                            <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="password">
                                Re-Type Password
                            </label>
                            <input name="password_confirmation " x-model="form.password_confirmation" autocomplete="off"
                            class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" type="password" placeholder="Ketik Ulang Password">
                            <small x-text="errMsg.password_confirmation" class="ml-3 text-xs text-red-500"></small>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="mt-8 flex space-x-2 justify-end">
                        <button type="submit" class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                            <i class="fa fa-check-circle"></i>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Your Custom Javascript -->
@section('_inJs')
@include('changepassword._inJs')
@endsection
<!-- /Your Custom Javascript -->

@endsection