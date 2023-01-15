import munrib from "../../api";

const state= {
    mun_two_list:null,
    mun_two:null
}
const getters= {
    mun_two_list:state=>{
        return state.mun_two_list
    },
    mun_two:state=>{
        return state.mun_two
    },

}
const mutations= {
    setMunTwoList(state,mun_two){
        state.mun_two_list=mun_two
    },
    setMunTwo(state,mun_two){
        state.mun_two=mun_two
    },

}
const actions= {
    async getMunTwoList({commit}) {
        const res = await munrib.get("/mun-two",)
        if(res.data.data)commit('setMunTwoList',res.data.data)
    },
    async getMunTwo({commit},mun_two) {
        const res = await munrib.get(`/mun-two/${mun_two}`)
        if(res.data.data)commit('setMunTwo',res.data.data)
    },
}
export default  {
    state,mutations,getters,actions
}
