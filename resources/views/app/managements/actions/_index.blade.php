@extends('layouts.app.main')

@section('title', ' | '.$module->module_name.' Module')

@section('content')
<h3 class="text-gray-700 text-3xl font-medium">{{ $module->module_name }} Module</h3>
<div class="container bg-white p-10 my-10" x-data="actionsCrud()">
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
            <button  x-show="selectedActions.length > 0" @click="confirmDelete"
            class="relative bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                <i class="fa fa-trash"></i>
                Delete
            </button>
        </x-slot>
        
        <!-- Title -->
        <div class="border-b-2 border-black mb-4">
            <h2 class="text-3xl font-medium" :id="$id('modal-title')">Setting Actions</h2>
        </div>
        <!-- Content -->
        <form action="#" @submit.prevent="confirmSave" name="formAction">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="controller_id">
                        Controller
                    </label>
                    <select name="controller_id" x-model="form.controller_id"
                    class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-300 border rounded-lg focus:shadow-outline" 
                    type="text" 
                    placeholder="Choose Controller..." x-init="getControllers()">
                        <option value="">Choose Controller...</option>
                        <template x-if="controllers != null">
                            <template x-for="controller in controllers">
                                <option :value="controller.id" x-text="controller.controller_name"></option>
                            </template>
                        </template>
                    </select>
                    <small x-text="errMsg.controller_id" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="function_id">
                        Function
                    </label>
                    <select name="function_id" x-model="form.function_id"
                    class="w-full h-10" 
                    type="text" multiple autocomplete="off" id="functionOptions"
                    placeholder="Choose Function..." x-init="getFunctions()">
                        {{-- <option value="">Choose Function...</option> --}}
                    </select>
                    <small x-text="errMsg.function_id" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="ajax_only">
                        Ajax Request ?
                    </label>
                    <label class="text-gray-700 px-2">
                        <input type="radio" name="ajax_only" x-model="form.ajax_only" value="true" />
                        <span class="ml-1">Yes</span>
                    </label>
                    <label class="text-gray-700 px-2">
                        <input type="radio" name="ajax_only" x-model="form.ajax_only" value="false" />
                        <span class="ml-1">No</span>
                    </label>
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

    <div class="w-full overflow-x-scroll" >
        <table class="w-full text-md bg-white shadow-md rounded mb-4" x-init="getActions()">
            <thead>
                <tr class="border-b">
                    <th class="w-10">
                        <label class="inline-flex items-center mt-3">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600" x-model="checkall" value="1" @change="checkActions">
                        </label>
                    </th>
                    <th class="text-left p-1 px-5 w-32">Actions</th>
                    <th class="text-left p-1 px-5">&nbsp;</th>
                    <th class="text-left p-1 px-5 w-16">Ajax Only</th>
                    <th class="text-left p-1 px-5 w-28">Type</th>
                </tr>
            </thead>
            <tbody x-html="actionDom">
                
                
            </tbody>
        </table>
    </div>

</div>
@endsection


<!-- Your Custom Javascript -->
@section('_inJs')
    @include('app.managements.actions._inJs')
@endsection
<!-- /Your Custom Javascript -->