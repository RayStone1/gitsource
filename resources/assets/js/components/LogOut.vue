<template>
    <v-icon
    @click="logOut"
    >
        mdi-logout
    </v-icon>
</template>

<script>
import munrib from "../api";

export default {
    name: "LogOut",
    methods:{
        logOut(){

            munrib.get('/logout')
                .then(res=>{
                    localStorage.removeItem('token')
                    this.$router.push({name:"login"})
                })
        }
    }
}
</script>

<style scoped>

</style>
