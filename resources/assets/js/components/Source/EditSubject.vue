<template>
    <v-dialog
        v-model="value"
        persistent
        max-width="600px"
        v-if="subject"
    >
        <v-card>
            <v-card-title>
                <span class="text-h5">Изменить субъект</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-text-field
                        class="main--input"
                        auto-select-first
                        outlined
                        clearable
                        label="Субъект"
                        v-model="subject.name"
                    ></v-text-field>
                    <v-select
                        class="main--input"
                        :items="[1,2,3,4]"
                        clearable
                        label="MinD"
                        outlined
                        v-model="subject.mind"
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
                    @click="closeDialog"
                >
                    Отменить
                </v-btn>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="updateSubject"
                >
                    Изменить
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {mapActions, mapGetters, mapMutations} from "vuex";
import munrib from "../../api";

export default {
    name: "EditSynonym",
    props:{
        value:{
            type:Boolean
        }
    },
    data:()=>({
        errors:null,
    }),
    methods:{
        ...mapMutations([
            'setMunOne',
            'setMunTwo',
            'setName',
            "setItem",

        ]),
        ...mapActions([
            'getSource',
            "getFilteredMunOne",
            "getFilteredMunTwo",
            "getFilteredName",
        ]),
        closeDialog(){
            this.setItem(null)
            this.$emit('input',false)
        },
        updateSubject(){
            let url=`/${this.subject.type}/${this.subject.id}`
            munrib.put(url,this.subject)
                .then(res=>{
                    this.$route.params.id && this.getSource(this.$route.params.id)
                    this.subject.type=="mun-one" && this.getFilteredMunOne()
                    this.subject.type=="mun-two" && this.getFilteredMunTwo()
                    this.subject.type=="names" && this.getFilteredName()
                    this.closeDialog();
                })
                .catch(err=>{
                    this.errors=err.response.data.errors
                })
        }
    },
    computed:{
        ...mapGetters(["item"]),
        subject(){
            return {...this.item}
        }
    }
}
</script>

<style scoped>

</style>
