<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH DOSEN</h4>
                        <hr>
 
                        <form @submit.prevent="store">
                            <div class="form-group">
                                <label for="nidn" class="font-weight-bold">NIDN</label>
                                <input type="text" class="form-control" v-model="dosen.nidn" placeholder="Masukkan NIDN">
                                <!-- validation -->
                                <div v-if="validation.nidn" class="mt-2 alert alert-danger">
                                    {{ validation.nidn[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="font-weight-bold">NAMA</label>
                                <input type="text" class="form-control" v-model="dosen.nama" placeholder="Masukkan Nama">
                                <!-- validation -->
                                <div v-if="validation.nama" class="mt-2 alert alert-danger">
                                    {{ validation.nama[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="font-weight-bold">ALAMAT</label>
                                <input type="text" class="form-control" v-model="dosen.alamat" placeholder="Masukkan Alamat">
                                <!-- validation -->
                                <div v-if="validation.alamat" class="mt-2 alert alert-danger">
                                    {{ validation.alamat[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telp" class="font-weight-bold">TELP</label>
                                <input type="text" class="form-control" v-model="dosen.telp" placeholder="Masukkan Telp">
                                <!-- validation -->
                                <div v-if="validation.telp" class="mt-2 alert alert-danger">
                                    {{ validation.telp[0] }}
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
</form>                        
 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
 
export default {
 
    setup() {
 
        //state dosen
        const dosen = reactive({
            nidn: '',
            nama: '',
            alamat: '',
            telp: ''
        })
 
        //state validation
        const validation = ref([])
 
        //vue router
        const router = useRouter()

        //method store
        function store() {
 
            let nidn   = dosen.nidn
            let nama = dosen.nama
            let alamat = dosen.alamat
            let telp = dosen.telp
 
            axios.post('http://localhost:8000/api/dosen', {
                nidn: nidn,
                nama: nama,
                alamat: alamat,
                telp: telp
            }).then(() => {
 
                //redirect ke dosen index
                router.push({
                    name: 'dosen.index'
                })
 
            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })
 
        }
 
        //return
        return {
            dosen,
            validation,
            router,
            store
        }
 
    }
 
}
</script>
 
<style>
    body{
        background: lightgray;
    }
</style>
