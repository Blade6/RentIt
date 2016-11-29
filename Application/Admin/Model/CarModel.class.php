<?php
namespace Admin\Model;
use Think\Model;
use Admin\Event\DeleteEvent;
class CarModel extends Model {
	private $car;

	public function __construct(){
		$this->car = M('car');
	}

	public function read(){
		return $this->car->select();
	}

	public function readOne($license_no){
		$map['license_no'] = $license_no;
		return $this->car->where($map)->find();
	}

	public function editBaseInfo($license_no, $type, $brand, $seat_number, $color){
		$data['license_no'] = $license_no;
		$data['type'] = $type;
		$data['brand'] = $brand;
		$data['seat_number'] = $seat_number;
		$data['color'] = $color;
		if(!$this->car->data($data)->save()) return false;
		return true;
	}

	public function editRentInfo($license_no, $rent_fare, $value, $flag, $num){
		$data['license_no'] = $license_no;
		$data['rent_fare'] = $rent_fare;
		$data['value'] = $value;
		$data['flag'] = $flag;
		$data['num'] = $num;
		if(!$this->car->data($data)->save()) return false;
		return true;
	}

	/*
	 * 永久删除车辆，由于外键引用的原因，谨慎！
	 */
	public function delete($license_no){		
		$del = new DeleteEvent();
		if(!$del->delCarAccidents($license_no)) return false;
		if(!$del->delCarRent($license_no)) return false;
		$flag = $this->car->delete($license_no);
		if($flag!==false) return true;
		return false;
	}
}