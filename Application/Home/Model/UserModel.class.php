<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
	private $user;

	public function __construct(){
		$this->user = M('user');
	}

	public function login(){
		$map['identity'] = I('post.ID');
		$map['password'] = I('post.password','','md5');

		$result = $this->user->where($map)->find();

		//判断是否能够登录
		if($result){
			//登陆成功，记录用户登录session值
			session('user',I('post.ID'));
			session('username',$result["username"]);
			session('password',$result["password"]);
			session('picture',$result["picture"]);
			session('name',$result["name"]);
			session('gender',$result["gender"]);
			session('age',$result["age"]);
			session('phone_num',$result["phone_num"]);
			session('shutup',$result["shutup"]);
			//跳转到首页
			return true;
		}
		else return false;
	}

	public function register(){
		$data['identity'] = I('post.ID');
		$data['password'] = I('post.password','','md5');
		$data['username'] = I('post.username');
		$data['name'] = I('post.name');
		$data['gender'] = I('post.gender');
		$data['age'] = I('post.age');
		$data['phone_num'] = I('phone_num');
		
		$this->user->create($data);
		if($this->user->add($data)) return true;
		else return false;
	}

	/*
	 * 在租车订单预定之前先判断用户是否有租车资格
	 */
	public function beforeRent($userID){
		$map['identity'] = array('eq', $userID);
		$result = $this->user->where($map)->find();
		if($result['flag']) return 1;
		else if($result['checked']!=1) return 2;
		else if($result['accident_num']==10) return 3;
		else return 0;
	}

	public function readInfo($userID){
		$map['identity'] = $userID;
		return $this->user->where($map)->find();
	}

	public function changeUsername(char $userID, char $newUsername){
		$data['identity'] = $userID;
		$data['username'] = $newUsername;
		if(!$this->user->data($data)->save()) return false;
		return true;
	}

	public function changePwd($userID, $newPwd){
		$data['identity'] = $userID;
		$data['password'] = md5($newPwd);
		if(!$this->user->data($data)->save()) return 0;
		return 1;
	}

	public function changePic($userID, $newPicPath){
		$data['identity'] = $userID;
		$data['picture'] = $userID.'/'.$newPicPath;
		if(!$this->user->data($data)->save()) return false;
		return true;
	}

	
}