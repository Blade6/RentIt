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
		$data['rent_id'] = $rentID;
		$data['user_ID'] = $userId;
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

	public function edit(){

	}

	public function searchByUserId($userId){

	}

	public function searchByLicense($license_no){
		
	}

	public function searchByDate($date){

	}

    /*
     * 永久删除某个用户的所有违章记录
     */
	public function deleteUser($userId){
		$map['user_ID'] = $userId;
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