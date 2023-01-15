<template>
    <v-dialog
        v-model="value"
        persistent
        max-width="600px"
    >
        <v-card>
            <v-card-title>
                <span class="text-h5">Добавить источник</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-autocomplete
                        class="main--input"
                        auto-select-first
                        outlined
                        clearable
                        label="Субъекты РФ"
                        :items="province_list"
                        item-text="name"
                        item-value="id"
                        v-model="province"
                    ></v-autocomplete>
                    <v-autocomplete
                        class="main--input"
                        auto-select-first
                        outlined
                        clearable
                        label="Муниципальные образования 1ого уровня"
                        :items="mun_one_list"
                        item-text="name"
                        item-value="id"
                        v-model="mun_one"
                    ></v-autocomplete>
                    <v-autocomplete
                        class="main--input"
                        auto-select-first
                        outlined
                        clearable
                        label="Муниципальные образования 2ого уровня"
                        :items="mun_two_list"
                        item-text="name"
                        item-value="id"
                        v-model="mun_two"
                    ></v-autocomplete>
                    <v-autocomplete
                        class="main--input"
                        auto-select-first
                        outlined
                        clearable
                        label="Орган власти"
                        :items="name_list"
                        item-text="name"
                        item-value="id"
                        v-model="name"
                    ></v-autocomplete>
                    <v-text-field
                        label="В родительном падеже"
                        outlined
                        v-model="header_name"
                    ></v-text-field>
                    <v-text-field
                        label="topic_name"
                        outlined
                        v-model="topic_name"
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
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="closeDialog"
                >
                    Отменить
                </v-btn>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="create"
                >
                    Добавить
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import munrib from "../../api";

export default {

    name: "CreateSource",
    props:{
        value:{
            type:Boolean,
        },
    },
    data:()=>({
        errors:null,
        province:null,
        mun_one:null,
        mun_two:null,
        name:null,
        topic_name:null,
        header_name:null,
    }),
    mounted() {
        this.start()
    },
    methods:{
        ...mapActions([
            "getProvinceList",
            "getMunOneList",
            "getMunTwoList",
            "getNameList",
            "getFilteredMunOne",
            "getFilteredMunTwo",
            "getFilteredName",
            "getFilteredSource",
            "ActiveType"
        ]),
        create(){
            munrib.post(`/source`,this.source)
                .then(res=>{
                    if(res.status==200){
                        this.errors={
                            name:[
                                'Такой источник уже существует'
                            ],
                        }
                    }
                    if(res.status==201){
                        this.getFilteredMunOne()
                        this.getFilteredMunTwo()
                        this.getFilteredName()
                        this.getFilteredSource()
                        this.closeDialog();
                    }
                })
                .catch(err=>{
                    this.errors=err.response.data.errors
                })
        },
        closeDialog(){
            this.$emit('input',false)
            this.header_name=this.topic_name=this.errors=this.province=this.mun_one=this.mun_two=this.name=null
        },
        start(){
            this.province=this.filter.province??null
            this.mun_one=this.filter.mun_one??null
            this.mun_two=this.filter.mun_two??null
            this.name=this.filter.name??null
            this.getMunOneList()
            this.getProvinceList()
            this.getMunTwoList()
            this.getNameList()
        }
    },
    computed:{
        ...mapGetters([
            'name_list',
            "province_list",
            "mun_two_list",
            "mun_one_list",
            "filter"

        ]),
        source(){
            return {
                name_id:this.name,
                l1_id:this.mun_one,
                l2_id:this.mun_two,
                province_id:this.province,
                topic_name:this.topic_name,
                header_name:this.header_name
            }
        }
    },
    watch:{
        value(val){
            !val|| this.start()
        }
    }
}
</script>

<style scoped>

</style>
