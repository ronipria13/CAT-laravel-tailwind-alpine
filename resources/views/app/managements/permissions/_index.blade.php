@extends('layouts.app.main')

@section('title', ' |  Permissions')

@section('content')
<h3 class="text-gray-700 text-3xl font-medium">Permissions</h3>
<div x-data="permissionsCrud()">
    <div class="container bg-white p-10 my-10">
        {{-- <button class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="livewire.emit('refreshUser')">Refresh Table</button> --}}
        <div x-show="successAlert.open" class="relative py-3 pl-4 pr-10 leading-normal text-blue-700 bg-blue-100 rounded-lg mb-3" role="alert">
            <p x-text="successAlert.message">A simple alert with text and a right icon</p>
            <span class="absolute inset-y-0 right-0 flex items-center mr-4" @click="successAlert.open = false">
            <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
            </span>
        </div>
        <form action="#" @submit.prevent="confirmSave" name="formAction">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="md:basis-1/2 w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="role_id">
                        Roles
                    </label>
                    <select name="role_id" x-model="form.role_id"
                    class="w-full h-9 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                    type="text" id="roleSelect"
                    placeholder="Choose Role..." x-init="getRoles()" @change="getPermissions()">
                    </select>
                    <small x-text="errMsg.role_id" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="md:basis-1/2 w-full px-3 my-3 pt-7">
                    <button type="submit" :disabled="loadingSave" :class="loadingSave ? 'bg-gray-500 cursor-not-allowed' : 'bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-aqua-400'"
                    class="text-white font-bold py-2 px-4 rounded mb-2">
                        <template x-if="loadingSave == false">
                            <i class="fa fa-check-circle"></i>
                        </template>
                        <span x-text="loadingSave ? 'Saving...' : 'Save'"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="container my-10 grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5" x-html="actionDom" x-init="getActions">
        <div class="bg-gray-900 py-4 px-5 xl:col-span-4 lg:col-span-3 md:col-span-2">
            <h2 class="text-center text-xl font-bold text-white">Loading...</h2>
        </div>
    </div>
</div>
@endsection


<!-- Your Custom Javascript -->
@section('_inJs')
    @include('app.managements.permissions._inJs')
@endsection
<!-- /Your Custom Javascript -->