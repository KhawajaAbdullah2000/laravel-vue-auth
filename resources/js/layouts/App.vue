<template>
    <div>
   <nav class="p-3">
    <router-link to='/'> Home| </router-link>
    <router-link :to="{name:'Login'}">Login| </router-link>
    <router-link to='/register'>Register| </router-link>
    <router-link to='/dashboard'>Dashboard</router-link>
   </nav>
    </div>

    <router-view></router-view>
</template>
