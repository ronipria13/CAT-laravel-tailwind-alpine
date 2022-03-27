<link href="{{ asset('css/tom-select.default.css') }}" rel="stylesheet">
<script src="{{ mix('js/tom-select.complete.js') }}" defer></script>
<script>
    
    function permissionsCrud() {
        return {
            openModal : false,
            formState : 'save',
            idData : null,
            loadingSave: false,
            successAlert: {
                open: false,
                message: ''
            },
            failedAlert: {
                open: false,
                message: ''
            },
            form: {
                role_id: '',
                action_id: [],
                permissions: [],
            },
            errMsg: {
                role_id: '',
                action_id: '',
                permissions: '',
            },
            async getPermissions() {
                try {
                    const response = await axios.get('/managements/permissions/showall/'+this.form.role_id);
                    if(response.status == 200) {
                        this.form.permissions = response.data.permissions;
                        this.form.action_id = [];
                        const addpermission = this.form.permissions.length > 0 ? this.form.permissions.map(permission => {
                            this.form.action_id.push(permission.action_id); 
                        }) : null
                        this.statusChecked();
                    }
                } catch (e) {
                    console.log(e);
                    Swal.fire({
                        icon: 'error',
                        title: "Permissions failed to load",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            confirmSave() {
                this.loadingSave = true;
                Swal.fire({
                title: "Simpan Permissions",
                text: "pastikan data yang diinputkan sudah benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.saveData()
                    }
                    else{
                        this.loadingSave = false;
                    }
                })
            },
            async saveData() {
                try {
                    const response = await axios.post('/managements/permissions', this.form) 
                    if(response.status == 200) {
                        
                        Swal.fire({
                            icon: 'success',
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })

                        this.successAlert = {
                            open: true,
                            message: response.data.message
                        }
                        //refresh data permission
                        this.form.permissions = response.data.permissions;
                        this.modules = [];
                        this.controllers = [];
                        this.form.action_id = [];
                        const addpermission = this.form.permissions.length > 0 ? this.form.permissions.map(permission => {
                            this.form.action_id.push(permission.action_id);
                        }) : null
                        this.statusChecked();
                        this.loadingSave = false;
                    }
                } catch (e) {
                    this.loadingSave = false;
                    Swal.fire({
                        icon: 'error',
                        title: e.response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    if(e.response.status == 422) {
                        console.log(e.response);
                        let errors = e.response.data.errors;
                        Object.keys(this.errMsg).forEach(key => {
                            this.errMsg[key] = Array.isArray(errors[key]) ? errors[key].map((value) => {
                            return value;
                            }).join(' ') : errors[key]
                        });
                        
                    }
                }
                
            },
            roleOptions: [],
            rolesDomSelect: null,
            async getRoles()
            {
                try {
                    const response = await axios.get('/managements/roles/showall')
                    if(response.status == 200) {
                        this.roleOptions = response.data.roles
                        this.rolesDomSelect = new TomSelect('#roleSelect', {
                            valueField: 'id',
                            labelField: 'role_name',
                            searchField: 'role_name',
                            options: this.roleOptions,
                            render: {
                                option: function(data, escape) {
                                    return '<div class="flex flex-col mb-2">' +
                                                '<span class="px-2 py-1 text-sm font-bold">' + escape(data.role_name) + '</span>' +
                                                '<span class="px-2 text-xs">' + escape(data.role_desc) + '</span>' +
                                            '</div>';
                                },
                            }
                        
                        })
                        this.rolesDomSelect.addItem(this.roleOptions[0].id)
                    }
                } catch (e) {
                    Swal.fire({
                        icon: 'error',
                        title: "Roles failed to load",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            
            actions: [],
            actionDom: '',
            modules: [],
            controllers: [],
            async getActions() {
                try {
                    const response = await axios.get('/managements/actions/showall/all');
                    if(response.status == 200) {
                        this.actions = response.data.actions;
                        this.renderActions()
                    }
                } catch (e) {
                        
                    Swal.fire({
                        icon: 'error',
                        title: "Actions failed to load",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            renderActions()
            {
                this.actionDom = "";
                this.actions.forEach(action => {
                    this.actionDom +=   `<div class="bg-gray-900 py-4 px-5 xl:col-span-4 lg:col-span-3 md:col-span-2">
                                            <label class="text-xl font-bold text-white">
                                                <input 
                                                    type="checkbox" 
                                                    name="modules[]"  
                                                    x-model="modules" @change="checkmodule('`+action.module_id+`')"
                                                    class="form-checkbox h-4 w-4 mr-3 text-blue-600" 
                                                    value="`+action.module_id+`">
                                                    `+action.module+`
                                            </label>
                                        </div>`
                    action.controllers.forEach(controller => {
                        this.actionDom +=   `<div class="bg-white">
                                                <div class="bg-gray-400 py-2 px-5">
                                                    <label class="font-bold">
                                                        <input 
                                                        type="checkbox" 
                                                        name="controllers[]"  
                                                        x-model="controllers" @change="checkcontroller('`+controller.controller_id+`','`+action.module_id+`')"
                                                        class="form-checkbox h-4 w-4 mr-3 text-blue-600" 
                                                        value="`+controller.controller_id+`">
                                                        `+controller.controller+`
                                                    </label>
                                                </div>
                                                <div class="flex flex-col divide-y">`
                        controller.functions.forEach(fungsi => {
                            this.actionDom +=   `<label class="inline-flex items-center py-2 px-5">
                                                    <input 
                                                    type="checkbox" 
                                                    name="permissions[]"  
                                                    x-model="form.action_id"" @change="checkaction('`+fungsi.function_id+`','`+action.module_id+`','`+controller.controller_id+`')"
                                                    class="form-checkbox h-4 w-4 mr-3 text-blue-600" 
                                                    value="`+fungsi.action_id+`"> `+fungsi.function_name+`
                                                </label>`
                        })
                            
                        this.actionDom += `     </div>
                        </div>`
                    })
                    
                })
            },
            checkmodule(module_id)
            {
                if(module_id != "")
                {
                    this.actions.map(action => {
                        if(action.module_id == module_id)
                        {
                            action.controllers.map(controller => {
                                if(this.modules.includes(module_id)){
                                    if(!this.controllers.includes(controller.controller_id))
                                    {
                                        this.controllers.push(controller.controller_id)
                                    }
                                } 
                                else{
                                    if(this.controllers.includes(controller.controller_id)) this.controllers.splice(this.controllers.indexOf(controller.controller_id), 1);
                                } 
                                this.checkcontroller(controller.controller_id,module_id)
                            })
                        }
                    })
                }
            },
            checkcontroller(controller_id,module_id)
            {
                if(controller_id != "")
                {
                    this.actions.map(action => {
                        if(action.module_id == module_id){
                            action.controllers.map(controller => {
                                if(controller.controller_id == controller_id)
                                {
                                    controller.functions.map(fungsi => {
                                        if(this.controllers.includes(controller_id)){ 
                                            if(!this.form.action_id.includes(fungsi.action_id)) this.form.action_id.push(fungsi.action_id); 
                                        }
                                        else {
                                            if(this.form.action_id.includes(fungsi.action_id)) this.form.action_id.splice(this.form.action_id.indexOf(fungsi.action_id), 1);
                                            this.statusChecked()
                                        }
                                    })
                                }
                                
                            })
                        }
                        
                    })
                }
            },
            checkaction()
            {
                this.statusChecked()                
            },
            statusChecked()
            {
                this.actions.map(modul => {
                    let lc = modul.controllers.length; // count of controllers
                    let clc = 0 //current count of controllers
                    modul.controllers.map(controller => {

                        let lf = controller.functions.length; // count of functions
                        let clf = 0 // current count of functions
                        controller.functions.map(fungsi => {
                            if(this.form.action_id.includes(fungsi.action_id)){ //count of checked functions
                                clf++;
                            }
                        })
                        if(lf == clf){ // if all functions checked
                            //if not in array push to form
                            if(!this.controllers.includes(controller.controller_id)) this.controllers.push(controller.controller_id)
                        }
                        else{ // if not all functions checked
                            //if in array remove from form
                            if(this.controllers.includes(controller.controller_id)) this.controllers.splice(this.controllers.indexOf(controller.controller_id), 1);
                        }
                    })
                    modul.controllers.map(controller => {
                        if(this.controllers.includes(controller.controller_id)){
                            clc++;
                        }
                    })
                    if(lc == clc){ // if all controllers checked
                        //if not in array push to form
                        if(!this.modules.includes(modul.module_id)) this.modules.push(modul.module_id)
                    }
                    else{ // if not all controllers checked
                        //if in array remove from form
                        if(this.modules.includes(modul.module_id)) this.modules.splice(this.modules.indexOf(modul.module_id), 1);
                    }
                })
            }
        }
    }
</script>