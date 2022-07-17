<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH DATA</h4>
                        <hr>

                        <form @submit.prevent="store">
                            <div class="form-group">
                                <label for="range_jam" class="font-weight-bold">Range Jam</label>
                                <input type="text" class="form-control" v-model="post.range_jam" placeholder="Masukkan Range Jam">
                                <!-- validation -->
                                <div v-if="validation.range_jam" class="mt-2 alert alert-danger">
                                    {{ validation.range_jam[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="aktif" class="font-weight-bold">Aktif</label><br/>
                                    <select v-model="post.aktif"> 
                                        <option disabled value="">Choose an option</option>
                                        <option label="Y">Y</option> 
                                        <option label="N">N</option> 
                                    </select> 
                                <!-- validation -->
                                <div v-if="validation.aktif" class="mt-2 alert alert-danger">
                                    {{ validation.aktif[0] }}
                                </div>
                            </div>
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

        //state posts
        const post = reactive({
            range_jam: '',
            aktif: ''
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //method store
        function store() {

            let range_jam   = post.range_jam
            let aktif = post.aktif

            axios.post('http://localhost/Penjadwalan/Penjadwalan-Backend/public/api/jam', {
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