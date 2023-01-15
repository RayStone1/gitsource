const state= {
    loadingTable:null,
    disableProvince:null,
    disableMunOne:null,
    disableMunTwo:null,
    disableName:null,

}
const getters= {
    loadingTable:state=>{
        return state.loadingTable
    },
    disableProvince:state=>{
        return state.disableProvince
    },
    disableMunOne:state=>{
        return state.disableMunOne
    },
    disableMunTwo:state=>{
        return state.disableMunTwo
    },
    disableName:state=>{
        return state.disableName
    },
}
const mutations= {
    isLoadingTable(state,load){
        state.loadingTable=load
    },
    disableProvince(state,disable){
        state.disableProvince=disable
    },
    disableMunOne(state,disable){
        state.disableMunOne=disable
    },
    disableMunTwo(state,disable){
        state.disableMunTwo=disable
    },
    disableName(state,disable){
        state.disableName=disable
    },

}
const actions= {

}
export default  {
    state,mutations,getters,actions
}
