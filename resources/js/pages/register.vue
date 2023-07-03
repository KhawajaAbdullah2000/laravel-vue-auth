<template>
    <div class="container">
        <h1>
         Register
        </h1>
  

        <div class="register-form mt-3">
<p class="text-danger" v-for="error in errors" :key="error">
  <span v-for="err in error" :key="err">
    <br>
    <span v-for="e in err" :key="e">{{e}}

    </span>

</span>
</p>
            <form @submit.prevent="register">


                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" v-model="form.name">
                  </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  v-model="form.email">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1"  v-model="form.password">
                </div>

                <div class="mb-3">
                    <label for="confirm_pass" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="conf_pass" v-model="form.c_password">
                  </div>
  
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>

        </div>
    </div>
</template>


<script setup>
import { reactive } from 'vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
let errors=ref([])
let form=reactive({
    name:'',
    email:'',
    password:'',
    c_password:''
});
const router=useRouter()
const register= async()=>{
    await axios.post('/api/register',form).then(res=>{
        if(res.data.success){
            localStorage.setItem('token',res.data.data.token);
            router.push({name:'Dashboard' })
        }

    }).catch(e=>{
        console.log(e)
        errors.value=e.response.data
    })
}

</script>
