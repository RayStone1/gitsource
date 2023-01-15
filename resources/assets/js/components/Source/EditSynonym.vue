<template>
    <v-dialog
        v-model="value"
        persistent
        max-width="600px"

    >
        <v-card>
            <v-card-title>
                <span class="text-h5">Изменить синоним</span>
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
                        outlined
                        v-model="synonym.mind"
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
                    @click="updateSynonym"
                >
                    Изменить
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
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
        ...mapActions(['setItem',"getSource"]),
        closeDialog(){
            this.setItem(null)
            this.$emit('input',false)
        },
        updateSynonym(){
            let url=`/${this.synonym.type}/${this.synonym.parent_id}/synonym/${this.synonym.id}`
            munrib.put(url,this.synonym)
                .then(res=>{
                    this.getSource(this.$route.params.id)
                    this.closeDialog();
                })
                .catch(err=>{
                    this.errors=err.response.data.errors
                })
        }
    },
    computed:{
        ...mapGetters(["item"]),
        synonym(){
            return {...this.item}
        }
    },
}
</script>

<style scoped>

</style>
