<link href="{{ asset('css/tom-select.default.css') }}" rel="stylesheet">
<script src="{{ mix('js/tom-select.complete.js') }}" defer></script>
<script>
    
    function actionsCrud() {
        return {
            openModal : false,
            formState : 'save',
            idData : null,
            module_id: "{{ $module->id }}",
            functionsTomSelect : null,
            successAlert: {
                open: false,
                message: ''
            },
            failedAlert: {
                open: false,
                message: ''
            },
            controllers: null,
            functions: null,
            form: {
                module_id: '',
                controller_id: '',
                function_id: '',
                ajax_only: '',
            },
            errMsg: {
                controller_id: '',
                function_id: '',
            },
            addData() {
                this.resetForm()
                // this.functionsTomSelect.addItem("5a8d195f-c2f6-4a2d-a662-89a67a8eeb81");
                // this.functionsTomSelect.addItem("7ac18b68-6097-4a7e-8fee-05f123c4ab76");
                this.idData = null
                this.formState = 'save'
                this.openModal = true
            },
            confirmSave() {
                const title = this.formState == 'edit' ? 'Ubah data?' : 'Simpan data?'
                Swal.fire({
                title: title,
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
                })
            },
            async saveData() {
                    try {
                        const response = this.formState == 'save' ? await axios.post('/managements/actions', this.form) 
                                                                : await axios.put('/managements/actions/' + this.idData, this.form)
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
                            this.openModal = false
                            this.resetForm()
                            this.getActions()
                        }
                    } catch (e) {
                        if(e.response.status == 422) {
                            Swal.fire({
                                icon: 'error',
                                title: e.response.data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            let errors = e.response.data.errors;
                            Object.keys(this.errMsg).forEach(key => {
                                this.errMsg[key] = Array.isArray(errors[key]) ? errors[key].map((value) => {
                                return value;
                                }).join(' ') : errors[key]
                            });
                            
                        }
                    }
                
            },
            async editData(id = 0) {
                this.resetForm();
                this.idData = id
                this.formState = 'edit'
                try {
                    const response = await axios.get('/managements/controllers/'+id);
                    if(response.status == 200) {
                        const dataApi = response.data.controller;
                        this.form = {
                            controller_name: dataApi.controller_name,
                            controller_desc: dataApi.controller_desc,
                        }
                        this.openModal = true
                    }
                } catch (e) {
                    Swal.fire({
                        icon: 'error',
                        title: "something went wrong",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            confirmDelete() {

                Swal.fire({
                title: 'Hapus data ini?',
                text: "data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.deleteData()
                    }
                })
            },
            async deleteData() {
                let ids = this.selectedActions.join('&')
                try {
                    const response = await axios.delete('/managements/actions/'+ids);
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
                        this.getActions()
                    }
                } catch (e) {
                    Swal.fire({
                        icon: 'error',
                        title: "something went wrong",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            resetForm() {
                this.form = {
                    module_id: this.module_id,
                    controller_id: '',
                    function_id: '',
                    ajax_only: 'false',
                }
                this.errMsg = {
                    controller_id: '',
                    function_id: '',
                }
                this.functionsTomSelect.clear()
            },
            async getControllers() {
                this.form.controller_id = ''
                try {
                    const response = await axios.get('/managements/controllers/showall');
                    if(response.status == 200) {
                        this.controllers = response.data.controllers;
                    }
                } catch (e) {
                    Swal.fire({
                        icon: 'error',
                        title: "Controllers failed to load",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            async getFunctions() {
                this.form.function_id = ''
                try {
                    const response = await axios.get('/managements/functions/showall');
                    if(response.status == 200) {
                        this.functions = response.data.functions;
                        // this.renderFunctionOption();
                        this.functionsTomSelect = new TomSelect('#functionOptions',{
                            create: true,
                            valueField: 'id',
                            labelField: 'function_name',
                            searchField: 'function_name',
                            options: this.functions,
                            render: {
                                option: function(data, escape) {
                                    return '<div class="flex flex-col mb-2">' +
                                                '<span class="px-2 py-1 text-sm font-bold">' + escape(data.function_name) + '</span>' +
                                                '<span class="px-2 text-xs">' + escape(data.function_desc) + '</span>' +
                                            '</div>';
                                },
                                item: function(data, escape) {
                                    return '<div title="' + escape(data.function_desc) + '" class="text-base font-bold" >' + escape(data.function_name) + '</div>';
                                }
                            }
                        
                        });

                    }
                } catch (e) {
                    Swal.fire({
                        icon: 'error',
                        title: "Functions failed to load",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            actions : [],
            selectedActions : [],
            selectedActionsByControllers : [],
            actionsValue : [],
            checkall : [],
            actionDom : '',
            async getActions() {
                this.actionDom = '';
                this.actionDom += `<tr class="border-b hover:bg-blue-500 bg-gray-200 text-gray-700">
                                                        <td colspan="5" class="p-1 px-5 text-center">Loading...</td>
                                                </tr>`;
                try {
                    const response = await axios.get('/managements/actions/showall/'+this.module_id);
                    this.actionDom = '';
                    this.actionsValue = [];
                    if(response.status == 200) {
                        
                        this.actions = response.data.actions.length > 0 ? response.data.actions[0].controllers : [];
                        this.renderActions();
                    }
                } catch (e) {
                    this.actionDom = ''
                    this.actionDom += `<tr class="border-b hover:bg-blue-500 bg-gray-200 text-gray-700">
                                                        <td colspan="5" class="p-1 px-5 text-center">Actions failed to load</td>
                                                </tr>`;
                        
                    Swal.fire({
                        icon: 'error',
                        title: "Actions failed to load",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            renderActions(){
                
                if(this.actions.length > 0) {
                    this.actions.map((action) => {
                        this.actionDom += `<tr class="border-b hover:bg-blue-500 bg-gray-500 text-white">
                                                <td class="p-1 px-5">
                                                    <label class="inline-flex items-center mt-3">
                                                        <input 
                                                        type="checkbox" 
                                                        x-model="selectedActionsByControllers" @change="checkByControllers()"
                                                        class="form-checkbox h-4 w-4 text-blue-600" 
                                                        value="`+action.controller_id+`">
                                                    </label>
                                                </td>
                                                <td colspan="4" class="p-1 px-5">Controller name : `+action.controller+`</td>
                                            </tr>`
                        action.functions.map((functionData) => {
                            this.actionsValue.push(functionData.action_id)
                            let ajaxonly = functionData.ajax_only ?  
                                                                `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>`
                                                                : `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>`;
                            let checkBox = functionData.type == "core" ? '' 
                                            : `<label class="inline-flex items-center mt-3">
                                                <input 
                                                type="checkbox" 
                                                name="selectedActions[]"  
                                                x-model="selectedActions" @change="checkIndividual('`+functionData.action_id+`','`+functionData.controller_id+`')"
                                                class="form-checkbox h-4 w-4 text-blue-600" 
                                                value="`+functionData.action_id+`">
                                            </label>`
                            this.actionDom += `<tr class="border-b hover:bg-orange-100 odd:bg-gray-100">
                                                    <td class="p-1 px-5">
                                                        `+checkBox+`
                                                    </td>
                                                    <td class="p-1 px-5">`+functionData.function_name+`</td>
                                                    <td class="p-1 px-5">`+functionData.function_desc+`</td>
                                                    <td class="p-1 px-5">`+ajaxonly+`</td>
                                                    <td class="p-1 px-5">`+functionData.type+`</td>
                                                </tr>`
                        })
                    })
                }
                else{
                    this.actionDom += `<tr class="border-b hover:bg-blue-500 bg-gray-200 text-gray-700">
                                                <td colspan="5" class="p-1 px-5 text-center">no data</td>
                                        </tr>`;
                }
            },
            checkActions()
            {
                if(this.checkall.length > 0) {
                    this.actions.map((action) => {
                        this.selectedActionsByControllers.push(action.controller_id);
                    })
                }
                else{
                    this.selectedActionsByControllers = [];
                }
                this.checkByControllers()
            },
            checkByControllers(controller_id = "")
            {
                if(controller_id != "" && this.selectedActionsByControllers.includes(controller_id)) {
                    this.actions.map((action) =>{
                        if(action.controller_id == controller_id) {
                            action.functions.map((functionData) => {
                                let index = this.selectedActions.indexOf(functionData.action_id)
                                if(index == -1) {
                                    this.selectedActions.splice(index,1)
                                }
                            })
                            
                        }
                    })
                }
                else if(this.selectedActionsByControllers.length > 0) {
                    this.selectedActionsByControllers.map((controller) => {
                        this.actions.map((action) => {
                            if(action.controller_id == controller) {
                                action.functions.map((functionData) => {
                                    if(functionData.type == "core") {
                                        this.selectedActions.push(functionData.action_id)
                                    }
                                })
                            }
                        })
                    })
                    if(this.selectedActionsByControllers.length == this.actions.length){ this.checkall = ["1"] }
                }
                else{
                    this.selectedActions = [];
                }
            },
            checkIndividual(lastAction = "", controller_id = "")
            {
                this.actions.map((action) =>{
                    if(action.controller_id == controller_id) {
                        let leng = action.functions.length;
                        let cur_leng = 0;
                        action.functions.map((functionData) => {
                            if(this.selectedActions.includes(functionData.action_id)) {
                                cur_leng++;
                            }
                        })
                        const add = leng == cur_leng ? this.selectedActionsByControllers.push(action.controller_id) : this.selectedActionsByControllers.splice(this.selectedActionsByControllers.indexOf(action.controller_id),1);
                        
                    }
                })
            }
            
        }
    }
</script>