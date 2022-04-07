<script>
    
    function changepassCrud() {
        return {
            openModal : false,
            token : "{{ $thisUser->id }}",
            successAlert: {
                open: false,
                message: ''
            },
            failedAlert: {
                open: false,
                message: ''
            },
            form: {
                oldpassword: '',
                password: '',
                password_confirmation: ''
            },
            errMsg: {
                oldpassword: '',
                password: '',
                password_confirmation: ''
            },
            confirmSave() {
                
                Swal.fire({
                title: "Apakah anda yakin",
                text: "pastikan password yang anda inputkan sudah benar dan mudah diingat!",
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
                    const response = await axios.put('/changepassword/' + this.token, this.form)
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
            resetForm() {
                this.form = {
                    oldpassword: '',
                    password: '',
                    password_confirmation: ''
                }
                this.errMsg = {
                    oldpassword: '',
                    password: '',
                    password_confirmation: ''
                }
            }
        }
    }
</script>