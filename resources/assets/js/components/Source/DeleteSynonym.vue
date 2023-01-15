<template>
    <v-dialog v-if="item" v-model="value" max-width="500px" persistent>
        <v-card>
            <v-card-title class="text-h6">Вы действительно хотите удалить "{{item.name}}"?</v-card-title>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">Отменить</v-btn>
                <v-btn color="blue darken-1" text @click="deleteSyn">Удалить</v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import munrib from "../../api";

export default {
    name: "DeleteSynonym",
    props:{
        value:{
            type:Boolean
        }
    },
    computed:{
        ...mapGetters(["item"])
    },
    methods:{
        ...mapActions(['getSource',"setItem"]),
        close(){
            this.$emit('input',false)
            this.setItem(null)
        },
        deleteSyn(){
            munrib.delete(`/${this.item.type}/${this.item.parent_id}/synonym/${this.item.id}`)
                .then(res=>{
                    this.close()
                    this.getSource(this.$route.params.id)
                })

        }
    }
}
</script>

<style scoped>

</style>
