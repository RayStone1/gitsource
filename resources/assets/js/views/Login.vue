<template>
    <v-main>
        <v-container fluid fill-height >
            <v-row align="center" justify="center" style="height:100vh">
                <v-col cols="12" sm="8" md="6">
                    <v-card elevation="3" class="mx-auto py-12" max-width="500px">
                        <v-form>
                            <v-img src="image/logo.svg" class="mx-auto" max-width="450"/>
                            <v-card-text class="pb-0">

                                <v-text-field
                                    class="main--input"
                                    label="Логин"
                                    name="login"
                                    v-model="user.login"
                                    :rules="[rules.required]"
                                    outlined
                                    clearable
                                ></v-text-field>
                                <v-text-field
                                    class="main--input"
                                    @click:append="passwordConfig.showPassword = !passwordConfig.showPassword"
                                    :append-icon="passwordConfig.showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                    :type="passwordConfig.showPassword ? 'text' : 'password'"

                                    v-model="user.password"
                                    :rules="[rules.required]"
                                    name="password"
                                    label="Пароль"

                                    outlined
                                    clearable
                                ></v-text-field>
                                <div v-if="errors" class="errors">
                                    <v-alert
                                        dense
                                        outlined
                                        type="error"
                                        v-for="(val,name) in errors"
                                        :key="name"
                                    >
                                        {{ val[0] }}
                                    </v-alert>
                                </div>
                            </v-card-text>
                            <v-card-actions class="px-4">
                                <v-row>
                                    <v-col cols="6">

                                    </v-col>
                                    <v-col cols="6">

                                    </v-col>
                                    <v-col cols="12">
                                        <v-btn
                                            class="rounded-lg mt-1"
                                            @click.prevent="login" dark x-large color="#0055A3" block>Войти</v-btn>
                                    </v-col>
                                </v-row>

                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-main>
</template>

<script>
import munrib from "../api";

export default {
    name: "Login",
    data :()=>({
        user:{
            login:null,
            password:null,
        },
        passwordConfig:{
            showPassword:false,
        },
        rules: {
            required: value => !!value || '',
        },
        errors:null,
    }),
    methods:{
        login(){
            axios.post('/api/login',this.user)
                .then(res=>{
                    if(res.data.access_token){
                        window.localStorage.setItem('token', res.data.access_token);
                        munrib.defaults.headers.common['Authorization'] = 'Bearer ' + res.data.access_token;
                        this.$router.push({name:"index"})
                    }

                })
                .catch(err=>{

                    if(err.response.status==401){
                        this.errors={
                            user:["Пользователь не найден"]
                        }
                        return
                    }
                    this.errors=err.response.data.errors
                })

        }
    }
}
</script>

<style scoped>

</style>
