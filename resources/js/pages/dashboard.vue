<template>

<div class="container">

    <h1>Dashboard</h1>

    <button class="btn btn-primary" @click="logout"> Logout</button>
</div>

</template>

<script setup>
import { useRouter } from 'vue-router';
const router=useRouter()
function logout(){

    localStorage.removeItem('token');
    router.push({
        name:'Home'
    })


}

</script>