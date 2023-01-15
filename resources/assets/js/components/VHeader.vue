<template>
    <v-card tile v-if="page!=='login'">
        <v-app-bar app color="white">
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>
                <router-link :to="{name:'index'}">
                    <h4>Munrib</h4>
                </router-link>
            </v-toolbar-title>
            <v-spacer/>
            <log-out/>
        </v-app-bar>
        <v-navigation-drawer
            v-model="drawer"
            app
        >
            <v-sheet
                color="white"
                class="pa-4"
                dark
            >
                <v-img src="/image/garant_logo.svg" class="mx-auto" width="100%"/>
            </v-sheet>

            <v-divider></v-divider>
            <v-list
                nav
                dense
            >
                <v-list-item-group
                    v-model="group"
                    active-class="base--text text--accent-4"
                >
                    <v-list-item
                        v-for="link in links"
                        :key="link.name"
                        :to="link.route"
                    >
                        <v-list-item-icon>
                            <v-icon>{{ link.icon }}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>{{ link.name }}</v-list-item-title>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>
    </v-card>
</template>

<script>
export default {
    name: "VHeader",
    data:()=>({
        links: [
            {name:'Главная',route:'/',icon:"mdi-home"},
        ],
        drawer: false,
        group:null
    }),
    computed:{
        page(){
            return this.$route.name
        }
    },
    components:{
        LogOut:()=>import('../components/LogOut')
    }
}
</script>

<style scoped>

</style>
