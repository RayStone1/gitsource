import munrib from "../../api";

const state= {
    name_list:null,
    name:null,
}
const getters= {
    name_list:state=>{
        return state.name_list
    },
    name:state=>{
        return state.name
    },

}
const mutations= {
    setNameList(state,name){
        state.name_list=name
    },
    setName(state,name){
        state.name=name
    },

}
const actions= {
    async getNameList({commit}) {
        const res = await munrib.get("/names")
        if(res.data.data)commit('setNameList', res.data.data)
    },
    async getName({commit},name) {
        const res = await munrib.get(`/names/${name}`)
        if(res.data.data)commit('setName', res.data.data)
    },
}
export default  {
    state,mutations,getters,actions
}
