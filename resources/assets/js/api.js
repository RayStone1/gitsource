import axios from "axios";
import router from "./router";

const munrib=axios.create({
    baseURL:'/api',
})
const token=localStorage.getItem('token')
if(token){
    munrib.defaults.headers.common['Authorization'] = 'Bearer ' + token;
}
munrib.interceptors.response.use({},err=>{
    if(err.response.status===401 || err.response.status===419 ){
        localStorage.removeItem('token')
        // router.push({name:'login'})
    }else{
        return Promise.reject(err);
    }
})
export default munrib
