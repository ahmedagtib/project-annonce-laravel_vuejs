export  function login(credentials){
	return new Promise((res,rej)=>{
		axios.post('/api/auth/login',credentials)
		 .then((response)=>{
		 	res(response.data);
		 })
		 .catch((err)=>{
		 	rej("wrong email or password");
		 })
	})
}

export function getLocalUser(){
	const userStr =localStorage.getItem("user");
	if(!userStr){
		return null;
	}
	return JSON.parse(userStr);
}

export function registerUser(credentials){
    return new Promise((res,rej)=>{
        axios.post('/api/auth/register',credentials)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('An error occured.. try again later.')
        })
    })
}

export function updateprofil(credentials){
    return new Promise((res,rej)=>{
        axios.post('/api/auth/profile',credentials)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('An error occured.. try again later.')
        })
    })
}

export function editreg(credentials){
    return new Promise((res,rej)=>{
        axios.post('/api/auth/editreg',credentials)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('An error occured.. try again later.')
        })
    })
}

export function addfreeads(credentials){
    return new Promise((res,rej)=>{
        axios.post('/api/postannonce',credentials)
        .then(response => {
            if(res.state=="error"){
                 res(response.data);

                }else{
                     res(response.data); 
                }
        })
        .catch(err => {
            rej('An error occured.. try again later.')
        })
    })
}
