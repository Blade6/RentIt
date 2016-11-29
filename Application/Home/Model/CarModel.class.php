<?php
namespace Home\Model;
use Think\Model;
class CarModel extends Model {
	private $cars;

	public function __construct(){
		$this->cars = M('car');
	}	

	/*
	 * 读取数据库所有未出租的车辆
	 */
	public function exhibit(){
		$map['flag'] = 0;
		return $this->cars->where($map)->select();		
	}

	/*
	 * 读取某靓车的信息
	 */
	public function readInfo($license_no){
		$map["license_no"] = $license_no;
		return $this->cars->where($map)->find();
	}

	public function check($license_no){
		$map['license_no'] = $license_no;
		$map['flag'] = 1;
		if($this->cars->where($map)->find()) return true;
		else{
			$_SESSION["car"] = $license_no;
			return false;
		}
	}
}