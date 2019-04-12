
import axios from 'axios';
import {getLocalUser} from "./helpers/auth.js";
const user=getLocalUser();


export default{

	state:{
		currentUser:user,
		islogedin:!!user,
		loading:false,
		auth_error:null,
		reg_error:null,
        registeredUser: null,
        profil_error:null,
        updateprofil: null,
        villes:[],
        category:[],
        adspayhome:[],
        adsfreehome:[],
       

	},
	getters:{
		isLoading(state){
			return state.loading;
		},
		islogedin(state){
			return state.islogedin;
		},
		currentUser(state){
			return state.currentUser;
		},
		autherror(state){
			return state.auth_error;
		},
		regError(state){
            return state.reg_error; 
        },
        registeredUser(state){
            return state.registeredUser; 
        },
         updateprofil(state){
            return state.updateprofil; 
        },
         profil_error(state){
            return state.profil_error; 
        },
        allville:(state)=>state.villes,
        allcategory:(state)=>state.category,
        adspayhome:(state)=>state.adspayhome,
        adsfreehome:(state)=>state.adsfreehome,
	},
	mutations:{
		login(state){
			state.loading=true;
			state.auth_error=null;
		},
		loginSuccess(state,payload){
            state.auth_error=null;
            state.islogedin=true;
            state.loading=false;
            state.currentUser=Object.assign({},payload.user,{token:payload.access_token});
            localStorage.setItem("user",JSON.stringify(state.currentUser));
		},
		loginFailed(state,payload){
             state.loading=false;
             state.auth_error=payload.error;
		},
		logout(state){
			localStorage.removeItem("user");
			state.isLoading=false;
			state.currentUser=null;
		},
        registerSuccess(state,payload){
            state.reg_error = null;
            state.registeredUser = payload.user;
        },
        registerFailed(state,payload){
            state.reg_error = payload.error;
         },
         profilSuccess(state,payload){
            state.profil_error = null;
            state. updateprofil= payload.profil;
         },
          profilFailed(state,payload){
            state.profil_error = payload.error;
         },
         setville:(state,villes)=>(state.villes=villes),
         setcategory:(state,category)=>(state.category=category),
         getadspay:(state,annonce)=>(state.adspayhome=annonce),
         getadsfree:(state,annonce)=>(state.adsfreehome=annonce),

	},
	actions:{
		login(context){
			context.commit("login");
		},
		async getville({commit}){
			const res = await axios.get('/api/ville');
			commit('setville',res.data);
		},
		async getcategory({commit}){
			const res = await axios.get('/api/category');
			commit('setcategory',res.data);
		},
		async getadspay({commit}){
			const res = await axios.get('/api/getpay');
			commit('getadspay',res.data);
		},
		async getadsfree({commit}){
			const res = await axios.get('/api/getfree');
			commit('getadsfree',res.data);
		},
		

	}
};