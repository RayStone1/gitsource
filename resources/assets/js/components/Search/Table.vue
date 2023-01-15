<template             >
    <v-card style="box-shadow: unset">
        <v-card-title>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Поиск"
                single-line
                hide-details
            ></v-text-field>
            <v-spacer/>
            <v-btn
                class="mt-7"
                outlined
                @click="dialogCreateSource=!dialogCreateSource"
            >
                <v-icon>
                    mdi-plus-box
                </v-icon>
                Добавить источник
            </v-btn>

            <create-source
                v-model="dialogCreateSource"
            />
            <delete-source
                v-if="activeType=='source'"
                v-model="dialogDeleteSubject"
            />
            <edit-subject
                v-model="dialogEditSubject"
            />
            <edit-source
                v-if="activeType=='source' && item"
                v-model="dialogEditSource"
            />
        </v-card-title>
        <v-data-table
            v-if="result"
            style="min-height: 60vh"
            :headers="headers"
            :items="result"
            :search="search"
            :page.sync="page"
            @page-count="pageCount = $event"
            :loading="loadingTable"
            loading-text="Загрузка..."
            hide-default-footer
        >
            <template v-if="activeType=='source'" v-slot:item.name="{ item }">
                <router-link :to="{name:'source',params:{id:item.id}}" >
                    <p class="mb-0">
                    <span>{{item.rules.province.name}}\</span><span>{{item.rules.mun_one.name}}\</span><span v-if="item.rules.mun_two">{{item.rules.mun_two.name}}\</span><span>{{item.rules.name.name}}</span>
                    </p>
                </router-link>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    v-if="activeType!='source' && activeType!='province'"
                    @click="openEditSubject(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    class="mr-2"
                    v-if="activeType=='source'"
                    @click="openEditSource(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    v-if="activeType=='source'"
                    @click="openDeleteSource(item)"
                    small
                >
                    mdi-delete
                </v-icon>
            </template>
        </v-data-table>
        <div class="text-center pt-2">
            <v-pagination
                v-model="page"
                :length="pageCount"
            ></v-pagination>
        </div>
    </v-card>
</template>
<script>
import {mapGetters,mapActions} from "vuex";
export default {
    name: "Table",
    data: () => ({
        search: null,
        dialogDeleteSubject: false,
        dialogEditSubject: false,
        dialogCreateSource:false,
        dialogEditSource:false,
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        headers: [
            {
                text: 'Наименование',
                align: 'start',
                value: 'name',
            },
            { text: '', value: 'actions', sortable: false,align: 'end', },
        ],

    }),
    methods: {
        ...mapActions(['setItem']),
        openEditSubject(item){
            this.setItem(item)
            this.dialogEditSubject=true
        },
        openDeleteSource(item){
            this.setItem(item)
            this.dialogDeleteSubject=true
        },
        openEditSource(source){
            this.setItem(source)
            this.dialogEditSource=true
        }
    },
    watch:{

    },
    computed:{
        ...mapGetters([
            "activeType",
            "province_list",
            "filteredMunOne",
            "filteredMunTwo",
            "filteredName",
            "filteredSource",
            "loadingTable",
            "item"
        ]),
        result(){
            switch(this.activeType){
                case "province":
                    return this.province_list;
                    break;
                case "mun-one":
                    return this.filteredMunOne;
                    break;
                case "mun-two":
                    return this.filteredMunTwo;
                    break;
                case "names":
                    return this.filteredName;
                    break;
                case "source":
                    return this.filteredSource
                    break;
                default:
                    return []
            }
        }
    },
    components:{
        createSource:()=>import('../Source/CreateSource'),
        deleteSource:()=>import('../Source/DeleteSource'),
        editSource:()=>import('../Source/EditSource'),
        editSubject:()=>import('../Source/EditSubject')
    }
}
</script>
