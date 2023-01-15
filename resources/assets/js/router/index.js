import Vue from 'vue'
import VueRouter from 'vue-router'
//Views
import Search from "../views/Search";
import Source from "../views/Source";
import Login from "../views/Login";

Vue.use(VueRouter)

const routes = [
    {
        path:'/',
        component:Search,
        name:"index",
    },
    {
        path:'/source/:id',
        component:Source,
        name:"source",
    },
    {
        path:'/login',
        component:Login,
        name:"login",
    },
]
const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})
router.beforeEach((to,from,next)=>{
    const token=localStorage.getItem('token')
    if(!token){
        if(to.name==='login'){
            return next()
        }else{
            return next({
                name:'login'
            })
        }
    }
    next()
})
export default router
