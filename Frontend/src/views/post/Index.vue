<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        MAIN MENU 
                        <hr>
                        <ul class="list-group">
                            <router-link :to="{name: 'post.dashboard'}"
                            class="list-group-item text-dark text-decoration-none">DASHBOARD</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'post.dashboard'}"
                            class="list-group-item text-dark text-decoration-none">DOSEN</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'post.dashboard'}"
                            class="list-group-item text-dark text-decoration-none">HARI</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'post.index'}"
                            class="list-group-item text-dark text-decoration-none">JAM</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'post.dashboard'}"
                            class="list-group-item text-dark text-decoration-none">RUANG</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'post.dashboard'}"
                            class="list-group-item text-dark text-decoration-none">MATKUL</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'post.dashboard'}"
                            class="list-group-item text-dark text-decoration-none">PENGAMPU</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'post.dashboard'}"
                            class="list-group-item text-dark text-decoration-none">JADKUL</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'post.dashboard'}"
                            class="list-group-item text-dark text-decoration-none">WAKTU TIDAK BERSEDIA</router-link>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>PENJADWALAN</h4>
                        <hr>
                        <router-link :to="{name: 'post.create'}" class="btn btn-md btn-success">TAMBAH POST</router-link>

                        <table class="table table-striped table-bordered mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">RANGE JAM</th>
                                    <th scope="col">AKTIF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(post, index) in posts" :key="index">
                                    <td>{{++index}}</td>
                                    <td>{{ post.range_jam }}</td>
                                    <td>{{ post.aktif }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'post.edit', params:{id: post.id }}" class="btn btn-sm btn-primary mr-1">EDIT</router-link>
                                        <button @click.prevent="postDelete(post.id)" class="btn btn-sm btn-danger ml-1">DELETE</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from 'vue'

export default {

    setup() {

        //reactive state
        let posts = ref([])

        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://localhost/Penjadwalan/Penjadwalan-Backend/public/api/jam')
            .then(response => {
              
              //assign state posts with response data
              posts.value = response.data.data

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //method delete
        function postDelete(id) {
            
            //delete data post by ID
            let url = `http://localhost/Penjadwalan/Penjadwalan-Backend/public/api/jam/${id}`
            if (window.confirm("Are you sure you want to delete this data?")){
                axios.delete(url)
                .then(() => {
              
              //splice posts 
              posts.value.splice(posts.value.indexOf(id), 1);
 
            }).catch(error => {
                console.log(error.response.data)
            })
 
        }
        }

        //return
        return {
            posts,
            postDelete
            
        }

    }

}
</script>

<style>
    body{
        background: lightgray;
    }
</style>