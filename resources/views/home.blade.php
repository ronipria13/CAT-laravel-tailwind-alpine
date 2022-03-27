@extends('layouts.app.main')

@section('title', ' | Home')

@section('content')
<h3 class="text-gray-700 text-3xl font-medium">Home</h3>
<div class="container bg-white p-10 my-10" x-data="userCrud()">
    {{-- <button class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="livewire.emit('refreshUser')">Refresh Table</button> --}}
    <div x-show="successAlert.open" class="relative py-3 pl-4 pr-10 leading-normal text-blue-700 bg-blue-100 rounded-lg mb-3" role="alert">
        <p x-text="successAlert.message">A simple alert with text and a right icon</p>
        <span class="absolute inset-y-0 right-0 flex items-center mr-4" @click="successAlert.open = false">
          <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
        </span>
    </div>
    <x-modal :value="1">
        <x-slot name="trigger">
            <button class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                <i class="fa fa-plus"></i>
                Tambah Data
            </button>
        </x-slot>
        
        <!-- Title -->
        <div class="border-b-2 border-black mb-4">
            <h2 class="text-3xl font-medium" :id="$id('modal-title')">Input Data User</h2>
        </div>
        <!-- Content -->
        <form action="#" @submit.prevent="saveData">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="nama">
                        Nama
                    </label>
                    <input name="name" x-model="form.name"
                    class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-600 border rounded-lg focus:shadow-outline" 
                    type="text" 
                    placeholder="Nama">
                    <small x-text="errMsg.name" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full px-3 my-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input name="username" x-model="form.username"
                    class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-600 border rounded-lg focus:shadow-outline" 
                    type="text" 
                    placeholder="Username">
                    <small x-text="errMsg.username" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full my-3 px-3" >
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="password">
                        Passowrd
                    </label>
                    <input name="password" x-model="form.password"
                    class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-600 border rounded-lg focus:shadow-outline" type="password" placeholder="Password">
                    <small x-text="errMsg.password" class="ml-3 text-xs text-red-500"></small>
                </div>
                <div class="w-full my-3 px-3">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="password">
                        Re-Type Passowrd
                    </label>
                    <input name="password_confirmation " x-model="form.password_confirmation"
                    class="w-full h-10 px-3 text-base text-gray-700 placeholder-gray-600 border rounded-lg focus:shadow-outline" type="password" placeholder="Ketik Ulang Password">
                    <small x-text="errMsg.password_confirmation" class="ml-3 text-xs text-red-500"></small>
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
    <livewire:user-table  />
    <!-- ini datatable -->
</div>
<script>
    Swal.fire(
    'The Internet?',
    'That thing is still around?',
    'question'
    )
    function userCrud() {
        return {
            openModal : false,
            successAlert: {
                open: false,
                message: ''
            },
            failedAlert: {
                open: false,
                message: ''
            },
            form: {
                name: '',
                username: '',
                password: '',
                password_confirmation: ''
            },
            errMsg: {
                name: '',
                username: '',
                password: '',
                password_confirmation: ''
            },
            async saveData() {
                    try {
                        const response =  await axios.post('/user', this.form);
                        if(response.status == 200) {
                            
                            this.successAlert = {
                                open: true,
                                message: response.data.message
                            }
                            this.openModal = false;
                            this.resetForm();
                            livewire.emit('refreshUser');
                        }
                    } catch (e) {
                        if(e.response.status == 422) {
                            let errors = e.response.data.errors;
                            Object.keys(this.errMsg).forEach(key => {
                                if(key !== "password_confirmation")
                                this.errMsg[key] = errors[key].map((value) => {
                                return value;
                                }).join(' ');
                            });
                            // this.errMsg['name'] = errors.name.map((value) => {
                            //     return value;
                            // }).join(' ');
                        }
                    }
                
            },
            async editData(id = 0) {
                // console.log(id);
                try {
                    const response = await axios.get('/user/'+id);
                    if(response.status == 200) {
                        const user = response.data.user;
                        this.form = {
                            name: user.name,
                            username: user.username,
                            password: '',
                            password_confirmation: ''
                        }
                        this.openModal = true;
                        console.log(this.openModal)
                    }
                } catch (e) {
                    console.log(e);
                }
            },
            deleteData(id = 0) {
                console.log(id);
            },
            resetForm() {
                this.form = {
                    name: '',
                    username: '',
                    password: '',
                    password_confirmation: ''
                }
                this.errMsg = {
                    name: '',
                    username: '',
                    password: '',
                    password_confirmation: ''
                }
            }
        }
    }
</script>
    

@endsection