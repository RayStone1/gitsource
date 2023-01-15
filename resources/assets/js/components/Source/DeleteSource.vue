<template>
    <v-dialog v-if="item" v-model="value" max-width="500px" persistent>
        <v-card>
            <v-card-title class="text-h6">Вы действительно хотите удалить <br> "{{item.name}}"?</v-card-title>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">Отменить</v-btn>
                <v-btn color="blue darken-1" text @click="deleteSource">Удалить</v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import munrib from "../../api";

export default {
    name: "DeleteSource",
    props:{
        value:{
            type:Boolean
        }
    },
    computed:{
        ...mapGetters(["item"])
    },
    methods:{
        ...mapActions(['getFilteredSource',"setItem"]),
        close(){
            this.$emit('input',false)
            this.setItem(null)
        },
        deleteSource(){

            munrib.delete(`/source/${this.item.id}`)
                .then(res=>{
                    this.close()
                    this.getFilteredSource()
                })

        }
    }
}
</script>

<style scoped>

</style>
