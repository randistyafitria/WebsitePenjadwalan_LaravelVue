<template>
  <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div v-if="loginFailed" class="alert alert-danger">
                    Email atau Password Anda salah.
                </div>
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>LOGIN</h4>
                        <hr>
                        <form @submit.prevent="login">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" v-model="user.email" class="form-control"
                                    placeholder="Email Address">
                            </div>
                            <div v-if="validation.email" class="mt-2 alert alert-danger">
                                {{ validation.email[0] }}
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" v-model="user.password" class="form-control"
                                    placeholder="Password">
                            </div>
                            <div v-if="validation.password" class="mt-2 alert alert-danger">
                                {{ validation.password[0] }}
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
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

    //inisialisasi vue router on Composition API
    const router = useRouter()

    //state user
    const user = reactive({
      email: '',
      password: '',
    })

    //state validation
    const validation = ref([])

    //state loginFailed
    const loginFailed = ref(null)

    //method login
    function login() {

      //define variable
      let email = user.email
      let password = user.password

      //send server with axios
      axios.post('http://localhost:8000/api/login', {
        email,
        password,
      })
      .then(response => {
        
        if(response.data.success){

          //set token
          localStorage.setItem('token', response.data.token)

          //redirect ke halaman dashboard
          return router.push({
            name: "dashboard"
          })
        }

        //set state loggedIn to true
        loginFailed.value = true

      }).catch(error => {
        //set validation dari error response
        validation.value = error.response.data
      })
    }
    return {
      user,         // <-- state user
      validation,   // <-- state validation
      loginFailed,  // <-- state loggedInd
      login         // <-- method login
    }
  }
}
</script>

<style>

</style>