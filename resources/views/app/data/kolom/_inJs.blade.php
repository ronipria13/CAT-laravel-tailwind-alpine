<script>
    
    function kolomCrud() {
        return {
            openModal : false,
            formState : 'save',
            idData : null,
            totalData : {{ $total }},
            maxData: {{ $max }},
            paketsoal_id: "{{ $paketsoal->id }}",
            successAlert: {
                open: false,
                message: ''
            },
            failedAlert: {
                open: false,
                message: ''
            },
            form: {
                paketsoal_id: '',
                col_a: '',
                col_b: '',
                col_c: '',
                col_d: '',
                col_e: '',
            },
            errMsg: {
                col_a: '',
                col_b: '',
                col_c: '',
                col_d: '',
                col_e: '',
            },
            addData() {
                
                if(this.totalData >= this.maxData) {
                    Swal.fire({
                        icon: 'warning',
                        title: "Kolom sudah mencapai batas maksimal",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                else{
                    this.resetForm()
                    this.idData = null
                    this.formState = 'save'
                    this.openModal = true
                }
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
                        const response = this.formState == 'save' ? await axios.post('/data/kolom', this.form) 
                                                                : await axios.put('/data/kolom/' + this.idData, this.form)
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
                            livewire.emit('refreshKolom') //refresh datatable livewire
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
                                if(key !== "password_confirmation")
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
                    const response = await axios.get('/data/kolom/'+id);
                    if(response.status == 200) {
                        const kolom = response.data.kolom;
                        this.form = {
                            paketsoal_id: kolom.paketsoal_id,
                            col_a: kolom.col_a,
                            col_b: kolom.col_b,
                            col_c: kolom.col_c,
                            col_d: kolom.col_d,
                            col_e: kolom.col_e,
                        }
                        this.openModal = true
                    }
                } catch (e) {
                    console.log(e);
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
                    const response = await axios.delete('/data/kolom/'+this.idData);
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
                        livewire.emit('refreshKolom') //refresh datatable livewire
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
                    paketsoal_id: this.paketsoal_id,
                    col_a: '',
                    col_b: '',
                    col_c: '',
                    col_d: '',
                    col_e: '',
                }
                this.errMsg = {
                    col_a: '',
                    col_b: '',
                    col_c: '',
                    col_d: '',
                    col_e: '',
                }
            }
        }
    }
</script>