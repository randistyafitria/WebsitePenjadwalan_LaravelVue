<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>EDIT DATA</h4>
                        <hr>

                        <form @submit.prevent="update">
                            <div class="form-group">
                                <label for="range_jam" class="font-weight-bold">Range Jam</label>
                                <input type="text" class="form-control" v-model="post.range_jam" placeholder="Masukkan Nama Range Jam">
                                <!-- validation -->
                                <div v-if="validation.range_jam" class="mt-2 alert alert-danger">
                                    {{ validation.range_jam[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="aktif" class="font-weight-bold">Aktif</label><br/>
                                    <select class="form-control" v-model="post.aktif"> 
                                        <option label="Y">Y</option> 
                                        <option label="N">N</option> 
                                    </select> 
                                <!-- validation -->
                                <div v-if="validation.aktif" class="mt-2 alert alert-danger">
                                    {{ validation.aktif[0] }}
                                </div>
                            </div><br/>
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

        //state posts
        const post = reactive({
            range_jam: '',
            aktif: ''
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
            axios.get(`http://localhost/Penjadwalan/Penjadwalan-Backend/public/api/jam/${route.params.id}`)
            .then(response => {
              
              //assign state posts with response data
              post.range_jam    = response.data.data.range_jam  
              post.aktif  = response.data.data.aktif

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //method update
        function update() {

            let range_jam   = post.range_jam
            let aktif = post.aktif

            axios.put(`http://localhost/Penjadwalan/Penjadwalan-Backend/public/api/jam/${route.params.id}`, {
                range_jam: range_jam,
                aktif: aktif
            }).then(() => {

                //redirect ke post index
                router.push({
                    name: 'post.index'
                })

            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })

        }

        //return
        return {
            post,
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