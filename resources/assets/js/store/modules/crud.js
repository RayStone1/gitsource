const state= {
    activeType:null,
    synonym:null,
    parent:null,
    item:null,
}
const getters= {
    activeType:state=>{
        return state.activeType
    },

    synonym:state=>{
        return state.synonym
    },
    parent:state=>{
        return state.parent
    },
    item:state=>{
        return state.item
    },
}
const mutations= {
    setType(state,type){
        state.activeType=type
    },

    setSynonym(state,synonym){
        state.synonym=synonym
    },
    setParent(state,parent){
        state.parent=parent
    },
    setItem(state,item){
        state.item=item
    },
}
const actions= {
    ActiveType({commit},type){
        commit('setType',type)
    },
    setSynonym({commit},synonym){
        commit('setSynonym',synonym)
    },
    setParent({commit},parent){
        commit('setParent',parent)
    },
    setItem({commit},item){
        commit('setItem',item)
    },
}
export default  {
    state,mutations,getters,actions
}
