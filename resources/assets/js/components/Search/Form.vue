<template>
    <v-form @submit.prevent="findSource" class="pa-4 white">
        <h4 class="mb-7">Выберите необходимый уровень</h4>
        <v-autocomplete
            class="main--input"
            auto-select-first
            outlined
            clearable
            label="Субъект федерации"
            v-model="province"
            @click:clear="findProvince()"
            @input="clear('mun-one')"
            :items="province_list"
            item-text="name"
            item-value="id"
        ></v-autocomplete>
        <v-autocomplete
            class="main--input"
            auto-select-first
            outlined
            clearable
            label="Муниципальные образования 1ого уровня"
            v-model="mun_one"
            @click:clear="findMunOne()"
            @input="clear('mun-two')"
            :disabled="!province"
            :items="filteredMunOne"
            item-text="name"
            item-value="id"
        ></v-autocomplete>
        <v-autocomplete
            class="main--input"
            auto-select-first
            outlined
            clearable
            label="Муниципальные образования 2ого уровня"
            v-model="mun_two"
            @click:clear="findMunTwo()"
            @input="clear('name')"
            :disabled="!mun_one"
            :items="filteredMunTwo"
            item-text="name"
            item-value="id"
        ></v-autocomplete>
        <v-autocomplete
            class="main--input"
            auto-select-first
            outlined
            clearable
            label="Орган власти"
            v-model="name"
            @click:clear="findName()"
            :disabled="!mun_one"
            :items="filteredName"
            item-text="name"
            item-value="id"
        ></v-autocomplete>
        <v-btn
            class="rounded-lg mt-1"
            :disabled="!(province && mun_one)"
            type="submit"
            prepend-ico=""
            color="primary"
            block
            x-large
        >
            <v-icon

            >mdi-filter
            </v-icon>
            Применить фильтр
        </v-btn>
    </v-form>
</template>

<script>
import {mapActions, mapGetters, mapMutations} from "vuex";
export default {
    name: "Form",
    async mounted() {
        await this.ActiveType(null)
        await this.findProvince();
        await this.clear('province')
    },
    data:()=>({
    }),
    watch:{
        // source_rules: {
        //     handler: function (val) {
        //         this.$emit('source_rules',val)
        //     },
        //     deep: true
        // },
        province(val){
            val && this.findMunOne(),this.clear('mun_one')
        },
        mun_one(val){
            val && this.findMunTwo(),this.clear('mun_two')
        },
        mun_two(val){
            val && this.findName(),this.clear('name')
        },

    },
    methods:{
        ...mapActions([
            "getProvinceList",
            "ActiveType",
            "getFilteredMunOne",
            "getFilteredMunTwo",
            "getFilteredName",
            "getFilteredSource"
        ]),
        ...mapMutations([
            "isLoadingTable"
        ]),
        clear(type){
            switch (type){
                case "province":
                    this.province=null
                case "mun-one":
                    this.mun_one=null
                case "mun-two":
                    this.mun_two=null
                case "name":
                    this.name=null
            }
        },
        async findProvince(){
            await this.getProvinceList()
            await this.ActiveType("province")
        },
        async findMunOne(){
            await this.getFilteredMunOne()
            this.ActiveType("mun-one")
        },
        async findMunTwo(){
            await this.getFilteredMunTwo()
            await this.getFilteredName()
            if (Object.keys(this.filteredMunTwo)==0){
                this.findName();
                return
            }

            this.ActiveType("mun-two")
        },
        async findName(){
            await this.getFilteredName()
            this.ActiveType("names")
        },
        async findSource(){
            this.isLoadingTable(true)
            this.ActiveType(null)
            await this.getFilteredSource()
            this.isLoadingTable(false)
            this.ActiveType("source")
        },
    },
    computed:{
        ...mapGetters([
            "activeType",
            "province_list",
            "filteredMunOne",
            "filteredMunTwo",
            "filteredName",
            "disableProvince",
            "disableMunOne",
            "disableMunTwo",
            "disableName",
        ]),
        province:{
            get() { return this.$store.getters.filter.province; },
            set(value) {this.$store.commit('setFilterProvince', value); },
        },
        mun_one:{
            get() { return this.$store.getters.filter.mun_one; },
            set(value) {this.$store.commit('setFilterMunOne', value); },
        },
        mun_two:{
            get() { return this.$store.getters.filter.mun_two; },
            set(value) {this.$store.commit('setFilterMunTwo', value); },
        },
        name:{
            get() { return this.$store.getters.filter.name; },
            set(value) { this.$store.commit('setFilterName', value); },
        },
    },
}
</script>

<style scoped>

</style>
