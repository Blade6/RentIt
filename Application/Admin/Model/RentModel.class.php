<?php
namespace Admin\Model;
use Think\Model;
class RentModel extends Model {
	private $rent;

	public function __construct(){
		$this->rent = M('rent');
	}

	public function read(){
		return $this->rent->select();
	}

	public function deleteOne($id){
		$flag = $this->rent->delete($id);
		if($flag!==false) return true;
		return false;
	}

	/*
	 * 永久删除某用户的所有租车记录
	 */
	public function deleteUser($userId){
		$map['user_ID'] = $userId;
		$flag = $this->rent->where($map)->delete();
		if($flag!==false) return true;
		return false;
	}

	/*
	 * 永久删除某辆车的所有出租记录
	 */
	public function deleteCar($license_no){
		$map['license_no'] = $license_no;
		$flag = $this->rent->where($map)->delete();
		if($flag!==false) return true;
		return false;
	}
}