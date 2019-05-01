
export function getLocalAdmin(){
	const adminStr = localStorage.getItem("admin");
	if(adminStr === 'undefined'){
    return null;
    console.log('Enter')
  }
  console.log(adminStr)
	return JSON.parse(adminStr);
}