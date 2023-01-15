<template>
    <v-dialog
        v-model="value"
        persistent
        max-width="600px"
    >
        <v-card>
            <v-card-title>
                <span class="text-h5">Добавить синоним</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-text-field
                        class="main--input"
                        auto-select-first
                        outlined
                        clearable
                        label="Синоним"
                        v-model="synonym.name"
                    ></v-text-field>
                    <v-select
                        class="main--input"
                        :items="[1,2,3,4]"
                        clearable
                        label="MinD"
                        v-model="synonym.minD"
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
import {mapActions, mapGetters} from "vuex";
import munrib from "../../api";

export default {
    name: "CreateSynonym",
    props:{
        value:{
            type:Boolean,
        },
    },
    data:()=>({
        errors:null,
        synonym:{
            name:null,
            minD:null,
        }

    }),
    computed:{
        ...mapGetters(['parent'])
    },
    methods:{
        ...mapActions(['getSource']),
        closeDialog(){
            this.$emit('input',false)
            this.synonym.name=this.synonym.minD=this.errors=null
        },
        create(){
            munrib.post(`/${this.parent.type}/${this.parent.id}/synonym`,this.synonym)
                .then(res=>{
                    this.getSource(this.$route.params.id)
                    this.closeDialog()
                })
                .catch(err=>{

                    this.errors=err.response.data.errors
                })
        }
    }
}
</script>

<style scoped>

</style>
