<script>
    
    function latihanCrud() {
        return {
            timer: {{ $timer }}, 
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
            currentAnswers: [],
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
            soal_list: {!! $latihan->soal_list !!},
            counter(){
                setInterval(() => {
                    if(this.timer < 0){
                        location.href = "/paketsoal/soalkecermatan";
                    }
                    let hours = Math.floor(this.timer / (60 * 60));
                    let minutes = Math.floor((this.timer % (60 * 60)) /60 );
                    let seconds = Math.floor((this.timer % (60 * 60 )) % 60);
                    this.countdown.hour = hours > 9 ? hours : '0' + hours;
                    this.countdown.minute = minutes > 9 ? minutes : '0' + minutes;
                    this.countdown.second = seconds > 9 ? seconds : '0' + seconds;
                    // console.log(this.countdown.hour + ':' + this.countdown.minute + ':' + this.countdown.second);
                    this.timer--;
                }, 1000);
            },
            successAlert: {
                open: false,
                message: ''
            },
            renderSoal(){
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
                this.renderSoalBoxes();
                if(this.currentIndex.kolom == 0 && this.currentIndex.soal == 0){
                    this.btnPrev = true;
                }else{ 
                    this.btnPrev = false;
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
                    else this.soalboxes += `<div class="bg-blue-200 p-1 border border-blue-500 text-center cursor-pointer hover:bg-blue-400 hover:border-white" @click="gotoSoal(${i})" >${no}</div>`;
                }
            },
            answerIt(option)
            {
                let answer = this.soal_list[this.currentIndex.kolom][`col_${option}`];
                console.log(answer);
                this.nextSoal();
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
                this.currentIndex.soal = index;
                this.renderSoal();
            },
        }
    }
</script>