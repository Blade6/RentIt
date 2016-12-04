<?php
namespace Admin\Model;
use Think\Model;
use Admin\Event\DeleteEvent;
class UserModel extends Model{
	private $user;

	public function __construct(){
		$this->user = M('user');
	}

	public function read(){
		return $this->user->select();
	}

	public function readOne($identity){
		$map['identity'] = $identity;
		return $this->user->where($map)->find();
	}

	public function editPersonality($identity, $name, $gender, $age, $phone_num){
		$data['identity'] = $identity;
		$data['name'] = $name;
		$data['gender'] = $gender;
		$data['age'] = $age;
		$data['phone_num'] = $phone_num;
		if(!$this->user->data($data)->save()) return false;
		return true;
	}

	public function editRentInfo($identity, $flag, $checked, $accident_num){
		$data['identity'] = $identity;
		$data['flag'] = $flag;
		$data['checked'] = $checked;
		$data['accident_num'] = $accident_num;
		if(!$this->user->data($data)->save()) return false;
		return true;
	}

	/*
	 * 永久删除某用户，由于外键引用的原因，将会先删除子表的记录，再删除父表记录
	 */
	public function delete($identity){
		$del = new DeleteEvent();
		if(!$del->delUserAccidents($identity)) return false;
		if(!$del->delUserMessages($identity)) return false;
		if(!$del->delUserRent($identity)) return false;
		$flag = $this->user->delete($identity);
		if($flag!==false) return true;
		return false;
	}

	public function searchByUserId($userId){
		$map['identity'] = $userId;
		return $this->user->where($map)->select();
	}

	public function searchByUserName($userName){
		$map['username'] = array('like', '%'.$userName.'%');
		return $this->user->where($map)->select();
	}

	public function searchByName($name){
		$map['name'] = array('like', '%'.$name.'%');
		return $this->user->where($map)->select();
	}

	/*
	 * 用户禁言，不能在意见反馈页面留言
	 */
	public function noSpeak($userId){
		$data['identity'] = $userId;
		$data['shutup'] = 1;
		if(!$this->user->data($data)->save()) return false;
		return true;
	}

	/*
	 * 解除用户禁言
	 */
	public function Speak($userId){
		$data['identity'] = $userId;
		$data['shutup'] = 0;
		if(!$this->user->data($data)->save()) return false;
		return true;
	}
}