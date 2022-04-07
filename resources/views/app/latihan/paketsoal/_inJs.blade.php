<script>
    
    function latihanCrud() {
        return {
            timer: {{ $timer }}, 
            timerpercol: {{ $timerpercol }},
            btnPrev: false,
            btnNext: false,
            countdown: {
                hour: '99',
                minute: '99',
                second: '99'
            },
            currentIndex: {
                kolom: 0,
                soal: 0,
            },
            currentId: {
                kolom: "",
                soal: ""
            },
            currentAnswers: {!! $answer !!},
            answerList: {!! $answerList !!},
            soalboxes: "",
            label:{
                kolom: {
                    no: "$",
                    a: "$",
                    b: "$",
                    c: "$",
                    d: "$",
                    e: "$"
                },
                soal: {
                    no: "$",
                    a: "$",
                    b: "$",
                    c: "$",
                    d: "$"
                }
            },
            answerBtn: {
                a: false,
                b: false,
                c: false,
                d: false,
                e: false
            },
            soal_list: {!! $latihan->soal_list !!},
            counter(){
                return setInterval(() => {
                    if(this.timer == 0){
                        this.timeup()
                        clearInterval(this.counter)
                    }
                    else{
                        let hours = Math.floor(this.timer / (60 * 60));
                        let minutes = Math.floor((this.timer % (60 * 60)) /60 );
                        let seconds = Math.floor((this.timer % (60 * 60 )) % 60);
                        this.countdown.hour = hours > 9 ? hours : '0' + hours;
                        this.countdown.minute = minutes > 9 ? minutes : '0' + minutes;
                        this.countdown.second = seconds > 9 ? seconds : '0' + seconds;

                        let devidedTimer = Math.floor(this.timer / 60); //timer dibagi 60
                        let kolomLength = this.soal_list.length; //jumlah kolom
                        devidedTimer = devidedTimer > kolomLength ? kolomLength : devidedTimer;
                        let expectCol = Math.floor(kolomLength - devidedTimer); //kolom yang harus dikerjakan pada saat ini
                        console.log(devidedTimer, kolomLength, expectCol);

                        if(seconds == 0 && expectCol > this.currentIndex.kolom){ // jika sudah tepat 60 detik dan masih ada waktu
                            if(this.currentIndex.kolom < this.soal_list.length){  //jika kolom yang sedang dikerjakan lebih kecil dari kolom yang harus dikerjakan
                                this.currentIndex.kolom = expectCol; //set kolom ke kolom seharusnya
                                this.currentIndex.soal = 0;
                                this.renderSoal(); //render soal
                            }
                        }
                        // console.log(this.countdown.hour + ':' + this.countdown.minute + ':' + this.countdown.second);
                        this.timer--;
                    }
                }, 1000);
            },
            successAlert: {
                open: false,
                message: ''
            },
            renderSoal(){
                this.resetAnswer();
                this.label.kolom.no = Math.floor(this.currentIndex.kolom + 1);
                this.label.kolom.a = this.soal_list[this.currentIndex.kolom].col_a;
                this.label.kolom.b = this.soal_list[this.currentIndex.kolom].col_b;
                this.label.kolom.c = this.soal_list[this.currentIndex.kolom].col_c;
                this.label.kolom.d = this.soal_list[this.currentIndex.kolom].col_d;
                this.label.kolom.e = this.soal_list[this.currentIndex.kolom].col_e;
                this.label.soal.no = Math.floor(this.currentIndex.soal + 1);
                this.label.soal.a = this.soal_list[this.currentIndex.kolom].soals[this.currentIndex.soal].soal[0];
                this.label.soal.b = this.soal_list[this.currentIndex.kolom].soals[this.currentIndex.soal].soal[1];
                this.label.soal.c = this.soal_list[this.currentIndex.kolom].soals[this.currentIndex.soal].soal[2];
                this.label.soal.d = this.soal_list[this.currentIndex.kolom].soals[this.currentIndex.soal].soal[3];
                let soal_id = this.soal_list[this.currentIndex.kolom].soals[this.currentIndex.soal].id;
                if(this.answerList[soal_id] != undefined){
                    if(this.label.kolom.a == this.answerList[soal_id]){
                        this.answerBtn.a = true;
                    }
                    if(this.label.kolom.b == this.answerList[soal_id]){
                        this.answerBtn.b = true;
                    }
                    if(this.label.kolom.c == this.answerList[soal_id]){
                        this.answerBtn.c = true;
                    }
                    if(this.label.kolom.d == this.answerList[soal_id]){
                        this.answerBtn.d = true;
                    }
                    if(this.label.kolom.e == this.answerList[soal_id]){
                        this.answerBtn.e = true;
                    }
                }
                this.renderSoalBoxes();
                if(this.currentIndex.kolom == 0 && this.currentIndex.soal == 0){
                    this.btnPrev = true;
                }else{ 
                    this.btnPrev = false;
                }
                if(this.currentIndex.kolom == (this.soal_list.length - 1) && this.currentIndex.soal == (this.soal_list[this.currentIndex.kolom].soals.length - 1)){
                    this.btnNext = true;
                }else{
                    this.btnNext = false;
                }
            },
            renderSoalBoxes()
            {
                this.soalboxes = "";
                for(let i = 0; i < this.soal_list[this.currentIndex.kolom].soals.length; i++){
                    let no = i + 1;
                    if(i == this.currentIndex.soal){ 
                        this.soalboxes += `<div class="bg-blue-500 p-1 border border-white text-center">${no}</div>`;
                    }
                    else {
                        let soal_id = this.soal_list[this.currentIndex.kolom].soals[i].id;
                        let bgCol = "bg-slate-200"
                        if(this.currentAnswers.includes(soal_id)){ bgCol = "bg-green-400" }
                        this.soalboxes += `<div class="${bgCol} p-1 border border-blue-500 text-center cursor-pointer hover:bg-blue-400 hover:border-white" @click="gotoSoal(${i})" >${no}</div>`;
                    }
                }
            },
            async answerIt(option)
            {
                if(this.timer > 0){
                    let answer = this.soal_list[this.currentIndex.kolom][`col_${option}`];
                    let soal_id = this.soal_list[this.currentIndex.kolom].soals[this.currentIndex.soal].id;
                    let latihan_id = "{{ $latihan->id }}";
                    this.answerList[soal_id] = answer;
                    if(!this.currentAnswers.includes(soal_id)) this.currentAnswers.push(soal_id);
                    this.nextSoal();
                    try {
                        const sendIt = await axios.post('/latihan/jawaban/store', {
                            answer: answer,
                            soal_id: soal_id,
                            latihan_id: latihan_id
                        });
                    } catch (err) {
                        console.log(err);
                    }
                }
                else{
                    this.successAlert.open = true;
                    this.successAlert.message = "Waktu telah habis, mohon menunggu proses selesai";
                    Swal.fire({
                            icon: 'warning',
                            title: 'Waktu telah habis, mohon menunggu proses selesai',
                            showConfirmButton: false,
                            timer: 1500
                        })
                }
            },
            nextSoal(){
                if(this.currentIndex.soal < this.soal_list[this.currentIndex.kolom].soals.length - 1){
                    this.currentIndex.soal++;
                    this.renderSoal();
                }else{
                    if(this.currentIndex.kolom < this.soal_list.length - 1){
                        this.currentIndex.kolom++;
                        this.currentIndex.soal = 0;
                        this.renderSoal();
                    }else{
                        this.successAlert.open = true;
                        this.successAlert.message = 'Selamat Anda telah menyelesaikan latihan ini';
                        setTimeout(() => {
                            location.href = "/paketsoal/soalkecermatan";
                        }, 2000);
                    }
                }
            },
            prevSoal(){
                if(this.currentIndex.soal > 0){
                    this.currentIndex.soal--;
                    this.renderSoal();
                }else{
                    if(this.currentIndex.kolom > 0){
                        this.currentIndex.kolom--;
                        this.currentIndex.soal = this.soal_list[this.currentIndex.kolom].soals.length - 1;
                        this.renderSoal();
                    }
                }
            },
            gotoSoal(index){
                // this.currentIndex.soal = index;
                // this.renderSoal();
            },
            resetAnswer(){
                this.answerBtn = {
                    a: false,
                    b: false,
                    c: false,
                    d: false,
                    e: false
                }
            },
            confFinishIt(){
                Swal.fire({
                title: 'Apakah anda yakin?',
                text: "pastikan semua soal sudah dijawab!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.finishIt();
                    }
                })
                
                
            },
            async finishIt(){
                try {
                    const response = await axios.patch('/latihan/paketsoal/{{ $latihan->id }}');
                    if(response.data.success == true){
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Selamat Anda telah menyelesaikan latihan ini',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.successAlert.open = true;
                        this.successAlert.message = 'Selamat Anda telah menyelesaikan latihan ini';
                        setTimeout(() => {
                            location.href = "/latihan/riwayat/{{ $latihan->id }}";
                        }, 1000);
                    }
                } catch (err) {
                    console.log(err);
                }
            },
            timeup(){
                this.successAlert.open = true;
                this.successAlert.message = "Waktu telah habis, mohon menunggu proses selesai";
                Swal.fire({
                        icon: 'warning',
                        title: 'Waktu telah habis, mohon menunggu proses selesai',
                        showConfirmButton: false,
                        timer: 1500
                    })
                setTimeout(() => {
                    location.href = "/latihan/riwayat/{{ $latihan->id }}";
                }, 1000);
            }
        }
    }
</script>