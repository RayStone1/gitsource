<template>
    <v-app>
        <v-header></v-header>
        <v-main style="background-color: #F9FAFB">
            <router-view/>
        </v-main>
    </v-app>
</template>

<script>
export default {
    name: "App",
    components:{
        VHeader:()=>import('./components/VHeader')
    }
}
</script>

<style>
a{
    color: black !important;
    text-decoration: none;
}
h1{
    font-weight: 300;
    font-size: 96px;
    line-height: 120%;
}
h2{
    font-weight: 300;
    font-size: 60px;
    line-height: 120%;
}
h3{
    font-weight: 400;
    font-size: 48px;
    line-height: 120%;
}
h4{
    font-weight: 400;
    font-size: 34px;
    line-height: 120%;
}
h5{
    font-weight: 400;
    font-size: 24px;
    line-height: 120%;
}
h6{
    font-weight: 500;
    font-size: 20px;
    line-height: 120%;
}
.v-button.v-size--default{
    font-weight: 500;
    font-size: 18px;
    line-height: 120%;
}
.v-button.v-size--large{
    font-weight: 500;
    font-size: 15px;
    line-height: 120%;
}
.v-button.v-size--small{
    font-weight: 500;
    font-size: 14px;
    line-height: 120%;
}
.v-button.v-size--x-large{
    font-weight: 500;
    font-size: 17px;
    line-height: 120%;
}
input{
    font-weight: 400;
    font-size: 16px;
    line-height: 120%;
}
.base--text{
    color: #0055A3;
}
.main--input .mdi-close{
    font-size:16px;
    padding: 8px;
    border-radius: 8px;
}
.main--input .mdi-close:hover{
    color:white !important;;
    background-color: #7AA0CF;
}
.cursor-pointer{
    cursor:pointer;
}
.v-btn:hover{
    transform: translateY(-2px);
}
</style>
