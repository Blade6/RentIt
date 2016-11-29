<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model {
	private $admin;

	public function __construct(){
		$this->admin = M('admin');
	}

	public function login($adminName, $passWord){
		$map['adminname'] = $adminName;
		$map['password'] = md5($passWord);
		if(!$this->admin->where($map)->find()) return false;
		
		session_start();
      	$time=10*60;
      	setcookie(session_name(),session_id(),time()+$time,"/");
		
		$_SESSION["admin"] = $adminName;
		$_SESSION["password"] = $passWord;
		return true;
	}

	public function read(){
		return $this->admin->select();
	}

	public function add($adminName, $password){
		$data['adminname'] = $adminName;
		$data['password'] = md5($password);
		$this->admin->create($data);
		if(!$this->admin->add($data)) return false;
		return true;
	}

	public function delete($id){
		$flag = $this->admin->delete($id);
		//delete()方法返回影响的记录数，sql执行出错的时候返回false，没有删除任何数据的时候返回0
		//0===false为false，0==false为true
		if($flag!==false) return true;
		return false;
	}

	public function edit($id, $adminName, $password){
		$data['id'] = $id;
		$data['adminname'] = $adminName;
		$data['password'] = md5($password);
		if(!$this->admin->data($data)->save()) return false;
		return true;
	}

	public function search($adminName){
		$map['adminname'] = $adminName;
		return $this->admin->where($map)->select();
	}
}