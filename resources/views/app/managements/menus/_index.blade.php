@extends('layouts.app.main')

@section('title', ' | Menu')

@section('content')
<h3 class="text-gray-700 text-3xl font-medium">Menu</h3>
<div class="container bg-white p-10 my-10" x-data="menusCrud()">
    {{-- <button class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="livewire.emit('refreshUser')">Refresh Table</button> --}}
    <div x-show="successAlert.open" class="relative py-3 pl-4 pr-10 leading-normal text-blue-700 bg-blue-100 rounded-lg mb-3" role="alert">
        <p x-text="successAlert.message">A simple alert with text and a right icon</p>
        <span class="absolute inset-y-0 right-0 flex items-center mr-4" @click="successAlert.open = false">
          <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
        </span>
    </div>
    <x-modal :value="1">
        <x-slot name="trigger">
            <button  @click="addData"
            class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                <i class="fa fa-plus"></i>
                Tambah Data
            </button>
        </x-slot>
        
        <!-- Title -->
        <div class="border-b-2 border-black mb-4">
            <h2 class="text-3xl font-medium" :id="$id('modal-title')">Form Data Menu</h2>
        </div>
        <!-- Content -->
        <form action="#" @submit.prevent="confirmSave" >
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="menugroup_id">
                        Menu Group
                    </label>
                    <select name="menugroup_id" x-model="form.menugroup_id"
                    class="w-full h-9 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                    type="text" id="menugroupDom" x-init="getMenugroups"
                    placeholder="Menu Group">
                        <option value="" disabled>Loading...</option>
                    </select>
                    <small x-text="errMsg.menugroup_id" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="menu_label">
                        Label
                    </label>
                    <input name="menu_label" x-model="form.menu_label"
                    class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                    type="text" 
                    placeholder="Label">
                    <small x-text="errMsg.menu_label" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="menu_icon">
                        Icon
                    </label>
                    <textarea name="menu_icon" x-model="form.menu_icon"
                    class="w-full h-24 px-3 py-2 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                    type="text" 
                    placeholder="Icon">
                    </textarea>
                    <small x-text="errMsg.menu_icon" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="menu_desc">
                        Description
                    </label>
                    <textarea name="menu_desc" x-model="form.menu_desc"
                    class="w-full h-24 px-3 py-2 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                    type="text" 
                    placeholder="Description">
                    </textarea>
                    <small x-text="errMsg.menu_desc" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="menu_order">
                        Urutan
                    </label>
                    <input name="menu_order" x-model="form.menu_order"
                    class="w-full h-10 px-3 py-2 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                    type="number" 
                    placeholder="Urutan">
                    <small x-text="errMsg.menu_order" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="action_id">
                        Actions
                    </label>
                    <select name="action_id" x-model="form.action_id"
                    class="w-full h-9 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                    id="actionDom" x-init="getActions"
                    placeholder="Actions">
                        <option value="" disabled>Loading...</option>
                    </select>
                    <small x-text="errMsg.action_id" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="route">
                        Route
                    </label>
                    <input name="route" x-model="form.route"
                    class="w-full h-10 px-3 py-2 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                    type="text" 
                    placeholder="Route">
                    <small x-text="errMsg.route" class="ml-3 text-xs text-red-500"></small>
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
    <livewire:managements.menu-table  />
    <!-- ini datatable -->
</div>
@endsection

<!-- Your Custom Javascript -->
@section('_inJs')
@include('app.managements.menus._inJs')
@endsection
<!-- /Your Custom Javascript -->