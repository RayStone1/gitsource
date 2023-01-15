<template>
    <v-container fluid v-if="source">
        <v-card
            class="pa-4"
            elevation="3"
            rounded="lg"
        >
            <div class="py-2">
                <v-card-subtitle class="py-0">
                    <v-icon class="primary--text">mdi-content-copy</v-icon>
                    Command source
                </v-card-subtitle>
                <v-tabs
                    v-model="type"
                >
                    <v-tab
                        v-for="item in source.rules"
                        :key="item.type"
                        v-if="item !== null"
                        class="text--black"
                    >
                        {{ item.name }}
                    </v-tab>
                </v-tabs>
            </div>
            <div class="py-2">
                <v-card-subtitle class="py-0">
                    1!name
                </v-card-subtitle>
                <v-card-title class="py-0 subtitle-1">
                    <v-icon class="primary--text">mdi-content-copy</v-icon>
                    <span class="primary--text"> {{source.header_name}}</span>
                </v-card-title>
            </div>
            <div class="py-2">
                <v-card-subtitle class="py-0">
                    1!name
                </v-card-subtitle>
                <v-card-title class="py-0 subtitle-1">
                    <v-icon class="primary--text">mdi-content-copy</v-icon>
                    <span class="primary--text"> {{source.topic_name}}</span>
                </v-card-title>
            </div>
            <div class="action">
                <create-synonym
                    v-model="dialogCreateSyn"
                />
                <delete-synonym
                    v-model="dialogDeleteSyn"
                />
                <edit-synonym
                    v-model="dialogEditSyn"
                />
                <edit-subject
                    v-model="dialogEditSubject"
                />
            </div>
        </v-card>
        <v-tabs-items
            class="mt-6"
            v-model="type">
            <v-tab-item
                v-for="item in source.rules"
                :key="item.type"
                v-if="item !== null"
            >
               <v-card>
                   <div class="card-header d-flex justify-space-between align-center primary white--text">
                       <div class="">
                           <v-card-title class="pa-4"
                           >
                               {{item.name}}
                           </v-card-title>
                           <v-card-subtitle>В этих карточках можно изменять их название и синонимы</v-card-subtitle>
                       </div>
                       <div class="action" v-if="item.type!='province'">
                           <v-icon
                               color="white"
                               class="ma-2 pa-2"
                               @click="openCreateSynonym(item)"
                           >
                               mdi-plus-box
                           </v-icon>
                           <v-icon
                               color="white"
                               class="ma-2 pa-2"
                               @click="openEditSubject(item)"
                           >
                               mdi-pencil
                           </v-icon>
                       </div>
                   </div>
                   <v-card-text>
                       <v-list
                       >
                               <v-list-item
                                   v-for="(synonym, i) in item.synonyms"
                                   tile
                                   :key="i"
                                   class="elevation-1 rounded-lg"
                               >
                                   <v-list-item-content>
                                       <v-list-item-title v-text="synonym.name"></v-list-item-title>
                                   </v-list-item-content>
                                   <v-list-item-icon>
                                       <v-icon
                                           class="pa-2"
                                           @click="openEditSynonym(synonym,item.type)"
                                       >
                                           mdi-pencil
                                       </v-icon>
                                       <v-icon
                                           class="pa-2"
                                           @click="openDeleteSynonym(synonym)"
                                       >

                                           mdi-delete
                                       </v-icon>
                                   </v-list-item-icon>
                           </v-list-item>
                       </v-list>
                   </v-card-text>
               </v-card>
            </v-tab-item>
        </v-tabs-items>
    </v-container>
</template>

<script>

import {mapActions, mapGetters,mapMutations} from "vuex";

export default {
    name: "Source",
    async created() {
        await this.getSource(this.$route.params.id)
    },
    data:()=>({
        activeSubject:null,
        dialogCreateSyn:false,
        dialogDeleteSyn:false,
        dialogEditSyn:false,
        dialogEditSubject:false,
        type:null,
    }),
    computed:{
        ...mapGetters(['source'])
    },
    methods:{
        ...mapActions([
            'getSource',
            "ActiveType",
            "getMunOne",
            "getMunTwo",
            "getName",
            "setParent",
            "setItem",
        ]),
        openCreateSynonym(parent){
            this.setParent(parent)
            this.dialogCreateSyn=true
        },
        openEditSynonym(item){
            this.setItem(item)
            this.dialogEditSyn=true
        },
        openEditSubject(subject){
            this.setItem(subject)
            this.dialogEditSubject=true
        },
        openDeleteSynonym(synonym){
            this.setItem(synonym)
            this.dialogDeleteSyn=true
        }
    },
    components:{
        CreateSynonym:()=>import('../components/Source/CreateSynonym'),
        DeleteSynonym:()=>import('../components/Source/DeleteSynonym'),
        EditSynonym:()=>import('../components/Source/EditSynonym'),
        EditSubject:()=>import('../components/Source/EditSubject'),
    },

}
</script>

<style scoped>

</style>
