<template>
    <div class="container">
        <h1 class="text-center">
         Login
        </h1>
        <div class="login-form mt-3">
 
            <form @submit.prevent="login">

            <p class="text-danger" v-if="error">{{error}}</p>

                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="form.email">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" v-model="form.password">
                </div>
  
                <button type="submit" class="btn btn-primary">Login</button>
              </form>

        </div>
    </div>
</template>


<script setup>
import { reactive } from 'vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
let error=ref('')
let form=reactive({
    email:'',
    password:''
});
const router=useRouter()
const login= async()=>{
    await axios.post('/api/login',form).then(res=>{
        if(res.data.success){
            localStorage.setItem('token',res.data.data.token);
            router.push({
        name:'Dashboard'
    })

        }else{
            error.value=res.data.message
        }
    })
}

</script>