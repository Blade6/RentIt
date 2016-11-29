function check(){
	if(form.ID.value==''){
		alert("身份证号不能为空!");
		return false;
	}
	else if(form.USERNAME.value==''){
		alert("用户名不能为空!");
		return false;
	}
	else if(form.PWD.value==''){
		alert("你还未输入密码!");
		return false;
	}
	else if(form.PWD2.value==''){
		alert("你尚未确认密码!");
		return false;
	}
	else if(form.PWD.value!==form.PWD2.value){
		alert("两次密码输入不一致!");
		return false;
	}
	else if(form.PWD.value.length<6||form.PWD.value.length>16){
		alert('密码长度不合格!');
		return false;
	}
	else return true;
}