<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>EDIT DOSEN</h4>
                        <hr>
 
                        <form @submit.prevent="update">
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
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'
 
export default {
 
    setup() {
 
        //state dosens
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
 
        //vue router
        const route = useRoute()
 
        //mounted
        onMounted(() => {
 
            //get API from Laravel Backend
            axios.get(`http://localhost:8000/api/dosen/${route.params.id}`)
            .then(response => {
              
              //assign state dosens with response data
              dosen.nidn    = response.data.data.nidn  
              dosen.nama  = response.data.data.nama 
              dosen.alamat  = response.data.data.alamat 
              dosen.telp  = response.data.data.telp 
 
            }).catch(error => {
                console.log(error.response.data)
            })
})
 
        //method update
        function update() {
 
            let nidn   = dosen.nidn
            let nama = dosen.nama
            let alamat = dosen.alamat
            let telp = dosen.telp
 
            axios.put(`http://localhost:8000/api/dosen/${route.params.id}`, {
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
            update
        }
 
    }
 
}
</script>
 
<style>
    body{
        background: lightgray;
    }
</style>
