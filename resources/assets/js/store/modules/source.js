import munrib from "../../api";

const state= {
    source:null,
    activeSubject:null,
}
const getters= {
    source:state=>{
        return state.source
    },
    activeSubject:state=>{
        return state.activeSubject
    },
    subject:state=>{
        return state.subject
    },
    method:state=>{
        return state.method
    }
}
const mutations= {
    setSource(state,source){
        state.source=source
    },
    setActiveSubject(state,activeSubject){
        state.activeSubject=activeSubject
    },
    setSubject(state,subject){
        state.subject=subject
    },
}
const actions= {
    async getSource({commit},id){
        const source=await munrib.get(`/source/${id}`)
        commit('setSource',source.data.data)
    },
    editProvince({commit}){
        commit('setActiveSubject',state.source.rules.province)
    },
    editMunOne({commit}){
        commit('setActiveSubject',state.source.rules.mun_one)
    },
    editMunTwo({commit}){
        commit('setActiveSubject',state.source.rules.mun_two)
    },
    editName({commit}){
        commit('setActiveSubject',state.source.rules.name)
    },
    editSubject({commit},subject={name:null,minD:null}){
        commit("setSubject",subject)
    },

}
export default  {
    state,mutations,getters,actions
}
