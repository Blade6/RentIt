<?php
namespace Admin\Model;
use Think\Model;
class AccidentModel extends Model {
	private $accident;

	public function __construct(){
		$this->accident = M('accident');
	}

	public function read(){
		return $this->accident->order('date desc')->select();
	}

	public function add($rentID, $userId, $license_no, $date, $place=''){
		$data['rentid'] = $rentID;
		$data['userid'] = $userId;
		$data['license_no'] = $license_no;
		$data['date'] = $date;
		$data['place'] = $place;
		$this->accident->create($data);
		if(!$this->accident->add($data)) return false;
		return true;
	}

	public function delete($id){
		$flag = $this->accident->delete($id);
		if($flag!==false) return true;
		return false;
	}

	public function edit($id,$rentid,$userid,$license_no,$date,$place){
		$data['id'] = $id;
		$data['rentid'] = $rentid;
		$data['userid'] = $userid;
		$data['license_no'] = $license_no;
		$data['date'] = $date;
		$data['place'] = $place;
		if(!$this->accident->data($data)->save()) return false;
		return true;
	}

	public function searchByUserId($userid){
		$condition['userid'] = $userid;
		return $this->accident->where($condition)->select();
	}

	public function searchByLicense($license_no){
		$condition['license_no'] = $license_no;
		return $this->accident->where($condition)->select();
	}

	public function searchByDate($date){
		$condition['date'] = $date;
		return $this->accident->where($condition)->select();
	}

    /*
     * 永久删除某个用户的所有违章记录
     */
	public function deleteUser($userId){
		$map['userid'] = $userId;
		$flag = $this->accident->where($map)->delete();
		if($flag!==false) return true;
		return false;
	}

	/*
	 * 永久删除某辆车的所有事故记录
	 */
	public function deleteCar($license_no){
		$map['license_no'] = $license_no;
		$flag = $this->accident->where($map)->delete();
		if($flag!==false) return true;
		return false;
	}
}