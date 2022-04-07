<script>
    
    function soalkecermatanCrud() {
        return {
            openModal : false,
            formState : 'save',
            idData : null,
            paketsoal_id: "{{ $kolom->paketsoal_id }}",
            kolom_id: "{{ $kolom->id }}",
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
                kolom_id: '',
                soal: '',
                key: '',
            },
            errMsg: {
                soal: '',
                options: '',
                key: '',
            },
            soal: {
                a: '',
                b: '',
                c: '',
                d: '',
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
                        let dataSoal = []
                        if(this.soal.a != ''){ dataSoal.push(this.soal.a)}
                        if(this.soal.b != ''){ dataSoal.push(this.soal.b)}
                        if(this.soal.c != ''){ dataSoal.push(this.soal.c)}
                        if(this.soal.d != ''){ dataSoal.push(this.soal.d)}
                        if(dataSoal.length == 4){ this.form.soal = dataSoal.join('-') }
                        else{ this.errMsg.soal = 'Soal harus diisi dengan 4 pilihan'; return false; }
                        this.saveData()
                    }
                })
            },
            async saveData() {
                    try {
                        const response = this.formState == 'save' ? await axios.post('/data/soalkecermatan', this.form) 
                                                                : await axios.put('/data/soalkecermatan/' + this.idData, this.form)
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
                            livewire.emit('refreshSoalkecermatan') //refresh datatable livewire
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
                    const response = await axios.get('/data/soalkecermatan/'+id);
                    if(response.status == 200) {
                        const soalkecermatan = response.data.soalkecermatan;
                        this.form = {
                            paketsoal_id: soalkecermatan.paketsoal_id,
                            kolom_id: soalkecermatan.kolom_id,
                            key: soalkecermatan.key,
                        }
                        this.parseSoal(soalkecermatan.soal)
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
                    const response = await axios.delete('/data/soalkecermatan/'+this.idData);
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
                        livewire.emit('refreshSoalkecermatan') //refresh datatable livewire
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
                    kolom_id: this.kolom_id,
                    soal: '',
                    options: '',
                    key: '',
                }
                this.errMsg = {
                    soal: '',
                    options: '',
                    key: '',
                }
                this.soal = {
                    a: '',
                    b: '',
                    c: '',
                    d: '',
                }
            },
            parseSoal(soal) {
                let dataSoal = soal.split('-')
                this.soal.a = dataSoal[0]
                this.soal.b = dataSoal[1]
                this.soal.c = dataSoal[2]
                this.soal.d = dataSoal[3]
            }
        }
    }
</script>