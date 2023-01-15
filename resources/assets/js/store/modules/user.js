import munrib from "../../api";

const state= {
    user:null,
}
const getters= {
    user (state) {
        return state.user
    },
}
const mutations= {
    SET_USER (state, value) {
        state.user = value
    }
}
const actions= {


}
export default  {
    state,mutations,getters,actions
}
