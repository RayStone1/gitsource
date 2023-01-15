<template>
    <v-container
    >
        <v-row class="pt-8">
            <v-col
                lg="4"
                md="6"
                cols="12"
            >
                <search-form/>
            </v-col>

            <v-col
                lg="8"
                md="6"
                cols="12"
            >
                <search-table/>
                <div class="action">

                    <create-subject
                        v-model="dialogCreateSub"
                    />
                    <v-btn
                        v-if="!isProvinceOrSource && activeType"
                        class="mt-7"
                        outlined
                        @click="dialogCreateSub=!dialogCreateSub"
                    >
                        <v-icon>
                            mdi-plus-box
                        </v-icon>
                        Добавить субъект
                    </v-btn>
                </div>

            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import {mapActions, mapMutations,mapGetters} from "vuex";
export default {
    name: "Search",
    data:()=>({
        source_rules:null,
        dialogCreateSub:false,

    }),
    mounted() {
        this.setSource(null)

    },
    components:{
        searchTable:()=>import('../components/Search/Table'),
        searchForm:()=>import('../components/Search/Form'),
        createSubject:()=>import('../components/Source/CreateSubject'),
    },
    computed:{
        ...mapGetters(['province','mun_one',"mun_two","name","source","activeType"]),
        isProvinceOrSource(){
            return this.activeType=='province' || this.activeType=='source'
        },
    },
    methods:{
        ...mapMutations(["setSource"]),
        openSubject(){
            this.dialogSubject=true
        },
        setRules(val){
            this.source_rules=val
        }
    },
}
</script>

<style>

</style>
