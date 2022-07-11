<template>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        MAIN MENU 
                        <hr>
                        <ul class="list-group">
                            <router-link :to="{name: 'dashboard'}"
                            class="list-group-item text-dark text-decoration-none">DASHBOARD</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'dosen.index'}"
                            class="list-group-item text-dark text-decoration-none">DOSEN</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'hari.index'}"
                            class="list-group-item text-dark text-decoration-none">HARI</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'jam.index'}"
                            class="list-group-item text-dark text-decoration-none">JAM</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'ruang.index'}"
                            class="list-group-item text-dark text-decoration-none">RUANG</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'matkul.index'}"
                            class="list-group-item text-dark text-decoration-none">MATAKULIAH</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'pengampu.index'}"
                            class="list-group-item text-dark text-decoration-none">PENGAMPU</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'jadkul.index'}"
                            class="list-group-item text-dark text-decoration-none">JADWAL KULIAH</router-link>
                        </ul>
                        <ul class="list-group">
                            <router-link :to="{name: 'wkt_tdk_bersedia.index'}"
                            class="list-group-item text-dark text-decoration-none">WAKTU TIDAK BERSEDIA</router-link>
                        </ul>
                        <li @click.prevent="logout" class="list-group-item text-dark text-decoration-none" style="cursor:pointer">LOGOUT</li>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        DATA DOSEN
                        <hr>
                        <router-link :to="{name: 'dosen.create'}" class="btn btn-md btn-success">TAMBAH DOSEN</router-link>
 
                        <table class="table table-striped table-bordered mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">NIDN</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">ALAMAT</th>
                                    <th scope="col">TELP</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="(dosen, index) in dosens" :key="index">
                                    <td>{{ dosen.nidn }}</td>
                                    <td>{{ dosen.nama }}</td>
                                    <td>{{ dosen.alamat }}</td>
                                    <td>{{ dosen.telp }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'dosen.edit', params:{id: dosen.id }}" class="btn btn-sm btn-primary mr-1">EDIT</router-link>
                                        <button @click.prevent="dosenDelete(dosen.id)" class="btn btn-sm btn-danger ml-1">DELETE</button>
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
        let dosens = ref([])
 
        //mounted
        onMounted(() => {
          
            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/dosen')
            .then(response => {
              
              //assign state dosens with response data
              dosens.value = response.data.data
 
            }).catch(error => {
                console.log(error.response.data)
            })
 
        })

        //method delete
            function dosenDelete(id) {
            
            //delete data dosen by ID
            axios.delete(`http://localhost:8000/api/dosen/${id}`)
            .then(() => {
              
              //splice dosens 
              dosens.value.splice(dosens.value.indexOf(id), 1);
 
            }).catch(error => {
                console.log(error.response.data)
            })
            
        }

//method logout
        function logout() {

        //logout
        axios.defaults.headers.common.Authorization = `Bearer ${token}`
        axios.post('http://localhost:8000/api/logout')
        .then(response => {

            if(response.data.success) {

            //remove localstorage
            localStorage.removeItem('token')

            //redirect ke halaman login
            return router.push({
                name: 'login'
            })

            }

        })
        .catch(error => {
            console.log(error.response.data)
        })

        }

         //return
        return {
            token,
            dosens,
            dosenDelete,
            logout
        }
 
    }
 
    }
 
</script>
 
<style>
    body{
        background: lightgray;
 }
</style>
