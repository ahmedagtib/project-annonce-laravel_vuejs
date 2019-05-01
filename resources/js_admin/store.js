
import axios from 'axios';
import {getLocalAdmin} from "./helpers/auth.js";
const admin=getLocalAdmin();


export default{

	state:{
		currentAdmin:admin,
		islogedin:!!admin,
		loading:false,
		auth_error:null,

	},
	getters:{
		isLoading(state){
			return state.loading;
		},
		islogedin(state){
			return state.islogedin;
		},
		currentUser(state){
			return state.currentAdmin;
		},
		autherror(state){
			return state.auth_error;
		},
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
            state.currentAdmin=Object.assign({},payload.data.data);
            localStorage.setItem("admin",JSON.stringify(state.currentAdmin));
		},
		loginFailed(state,payload){
             state.loading=false;
             state.auth_error=payload.error;
		},
		logout(state){
			localStorage.removeItem("admin");
			state.isLoading=false;
			state.currentUser=null;
		},
	},
	actions:{
		login(context){
			context.commit("login");
		},
	}
};