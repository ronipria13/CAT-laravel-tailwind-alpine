<script>
    
    function controllersCrud() {
        return {
            openModal : false,
            formState : 'save',
            idData : null,
            successAlert: {
                open: false,
                message: ''
            },
            failedAlert: {
                open: false,
                message: ''
            },
            form: {
                controller_name: '',
                controller_desc: '',
            },
            errMsg: {
                controller_name: '',
                controller_desc: '',
            },
            addData() {
                this.resetForm()
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
                        const response = this.formState == 'save' ? await axios.post('/managements/controllers', this.form) 
                                                                : await axios.put('/managements/controllers/' + this.idData, this.form)
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
                            livewire.emit('refreshControllers') //refresh datatable livewire
                        }
                    } catch (e) {
                        if(e.response.status == 422) {
                            console.log(e.response);
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
                    console.log(e.response);
                    Swal.fire({
                        icon: 'error',
                        title: "something went wrong",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            confirmDelete(id = 0) {
                this.idData = id
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
                try {
                    const response = await axios.delete('/managements/controllers/'+this.idData);
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
                        livewire.emit('refreshControllers') //refresh datatable livewire
                    }
                } catch (e) {
                    console.log(e.response);
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
                    controller_name: '',
                    controller_desc: '',
                }
                this.errMsg = {
                    controller_name: '',
                    controller_desc: '',
                }
            }
        }
    }
</script>