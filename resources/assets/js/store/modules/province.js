import munrib from "../../api";

const state= {
    province_list:null,
    province:null,
}
const getters= {
    province_list:state=>{
        return state.province_list
    },
    province:state=>{
        return state.province
    }
}
const mutations= {
    setProvinceList(state,province){
        state.province_list=province
    },
    setProvince(state,province){
        state.province=province
    },
}
const actions= {
    async getProvinceList({commit}){
        const res=await munrib.get("/province")
        commit('setProvinceList',res.data.data)
    },
    async getProvince({commit},id){
        const res=await munrib.get(`/province/${id}`)
        console.log('asd')
        commit('setProvince',res.data.data)
    },
}
export default  {
    state,mutations,getters,actions
}
