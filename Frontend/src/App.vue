<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <router-link :to="{name: 'dashboard'}" class="navbar-brand">PENJADWALAN KULIAH</router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <router-link :to="{name: 'register'}" class="nav-link" href="">REGISTER</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name: 'login'}" class="nav-link" href="">LOGIN</router-link>
          </li>
        </ul>
      </div>
    </nav>
    <router-view/>
  </div>
</template>

<script>
  export default {
  }
</script>


<style>
  #app {
    font-family: Poppins;
    background: lightgray !important;
  }
</style>