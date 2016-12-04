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
		$result = $this->admin->where($map)->find();
		if(!$result) return false;
		
		session('admin',$adminName);
		session('level',$result["level"]);
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
		//模糊查询，匹配所有包含adminName子串的记录
		$map['adminname'] = array('like', '%'.$adminName.'%');
		return $this->admin->where($map)->select();
	}
}