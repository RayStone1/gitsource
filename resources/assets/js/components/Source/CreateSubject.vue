<template>
    <v-dialog
        v-model="value"
        persistent
        max-width="600px"
    >
        <v-card>
            <v-card-title>
                <span class="text-h5">Добавить  {{title}}</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-text-field
                        class="main--input"
                        auto-select-first
                        outlined
                        clearable
                        label="Субъекты РФ"
                        v-model="item.name"
                    ></v-text-field>
                    <v-select
                        class="main--input"
                        :items="[1,2,3,4]"
                        clearable
                        label="MinD"
                        v-model="item.mind"
                        outlined
                    ></v-select>
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
                    @click="closeDialog()"
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
import {mapGetters,mapActions} from "vuex"
import munrib from "../../api";
export default {
    name: "CreateSubject",
    props:{
        value:{
            type:Boolean,
        },
    },
    data:()=>({
        errors:null,
        item:{
           name:null,
           mind:null,
        }
    }),
    computed:{
        ...mapGetters(['activeType']),
        title(){
            switch (this.activeType) {
                case 'province':
                    return "Субъект РФ"
                    break
                case 'mun-one':
                    return "МО 1"
                    break
                case 'mun-two':
                    return "МО 2"
                    break
                case 'names':
                    return "Орган власти"
                    break
            }
        }
    },
    methods:{
        closeDialog(){
            this.$emit('input',false)
            this.item.name=this.item.mind=this.errors=null
        },
        create(){
            munrib.post(`/${this.activeType}`,this.item)
                .then(res=>{
                    this.closeDialog()
                })
                .catch(err=>{
                    console.log('asd')
                    this.errors=err.response.data.errors
                })
        },

    }
}
</script>

<style scoped>

</style>
