import munrib from "../../api";

const state= {
    filter:{
      province:null,
      mun_one:null,
      mun_two:null,
      name:null,
    },
    filteredMunOne:null,
    filteredMunTwo:null,
    filteredName:null,
    filteredSource:null,
}
const getters= {
    filter:state=>{
        return state.filter
    },
    filteredMunOne:state=>{
        return state.filteredMunOne
    },
    filteredMunTwo:state=>{
        return state.filteredMunTwo
    },
    filteredName:state=>{
        return state.filteredName
    },
    filteredSource:state=>{
        return state.filteredSource
    },
}
const mutations= {
    setFilterProvince(state,id){
        state.filter.province=id
    },
    setFilterMunOne(state,id){
        state.filter.mun_one=id
    },
    setFilterMunTwo(state,id){
        state.filter.mun_two=id
    },
    setFilterName(state,id){
        state.filter.name=id
    },
    setFilteredMunOne(state,item){
        state.filteredMunOne=item
    },
    setFilteredMunTwo(state,item){
        state.filteredMunTwo=item
    },
    setFilteredName(state,item){
        state.filteredName=item
    },
    setFilteredSource(state,item){
        state.filteredSource=item
    },
}
const actions= {
    async getFilteredMunOne({commit}){
        const res=await munrib.get("/mun-one", {params: state.filter})
        commit('setFilteredMunOne',res.data.data)
    },
    async getFilteredMunTwo({commit}){
        const res=await munrib.get("/mun-two", {params: state.filter})
        commit('setFilteredMunTwo',res.data.data)
    },
    async getFilteredName({commit}) {
        const res = await munrib.get("/names", {params: state.filter})
        commit('setFilteredName', res.data.data)
    },
    async getFilteredSource({commit}) {
        const res = await munrib.get("/source", {params: state.filter})
        commit('setFilteredSource', res.data.data)
    },

}
export default  {
    state,mutations,getters,actions
}
