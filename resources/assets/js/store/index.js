import Vue from 'vue'
import Vuex from 'vuex'
import Province from "./modules/province";
import MunOne from "./modules/munone";
import MunTwo from "./modules/muntwo";
import Name from "./modules/name";
import Search from "./modules/search";
import Source from "./modules/source";
import Crud from "./modules/crud";
import Loading from "./modules/loading";


Vue.use(Vuex)

export default new Vuex.Store({
    modules:{
        Search,
        Source,
        Crud,
        Province,
        MunOne,
        MunTwo,
        Name,
        Loading
    }
})
