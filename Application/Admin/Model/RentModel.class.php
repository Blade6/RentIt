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

	public function readOne($id){
		$map['id'] = $id;
		return $this->rent->where($map)->find();
	}

	public function deleteOne($id){
		$flag = $this->rent->delete($id);
		if($flag!==false) return true;
		return false;
	}

	/*
	 * 用户支付押金后，管理员编辑租车信息
	 */
	public function editRentInfo($id, $license_no, $flag, $g_flag, $draw_date){
		$data['id'] = $id;
		$data['license_no'] = $license_no;
		$data['flag'] = $flag;
		$data['g_flag'] = $g_flag;
		$data['draw_date'] = $draw_date;

		if(!$this->rent->data($data)->save()) return false;
		return true;
	}

	/*
	 * 用户归还车辆完成交易后，管理员更新租车信息
	 */
	public function editRentInfoDone($id, $return_date, $penalty, $p_flag, $fare, $fare_flag){
		$data['id'] = $id;
		$data['return_date'] = $return_date;
		$data['penalty'] = $penalty;
		$data['p_flag'] = $p_flag;
		$data['fare'] =  $fare;
		$data['fare_flag'] = $fare_flag;

		if(!$this->rent->data($data)->save()) return false;
		return true;
	}

	public function searchByUserId($userId){
		$map['userid'] = $userId;
		return $this->rent->where($map)->select();
	}

	public function searchByLicense($license_no){
		$map['license_no'] = $license_no;
		return $this->rent->where($map)->select();
	}

	public function searchByDate($date){
		$map['date'] = $date;
		return $this->rent->where($map)->select();
	}

	/*
	 * 永久删除某用户的所有租车记录
	 */
	public function deleteUser($userId){
		$map['userid'] = $userId;
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