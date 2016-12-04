<?php
namespace Admin\Model;
use Think\Model;
use Think\Upload;
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

	public function add($license_no, $type, $brand, $seat_number, $color, $rent_fare, $value){
		$data['license_no'] = $license_no;
		$data['type'] = $type;
		$data['brand'] = $brand;
		$data['seat_number'] = $seat_number;
		$data['color'] = $color;
		$data['rent_fare'] = $rent_fare;
		$data['value'] = $value;

		$this->car->create($data);
		if(!$this->car->add($data)) return false;
		return true;
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

	public function editCarPic($license_no, $photo){
		$upload  = new Upload();
		$upload->maxSize =  1048576;//设置上传文件大小为1M
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		$upload->rootPath = 'Public/pictures/';
		$upload->savePath = '';
		$upload->saveName = array('uniqid','');
		$upload->autoSub =  false;
		$info  = $upload->uploadOne($photo);
		if(!$info) return false;
		
		$data['license_no'] = $license_no;
		$data['picture'] = $info["savename"];
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

	public function searchByLicense($license_no){
		$map['license_no'] = $license_no;
		return $this->car->where($map)->select();
	}

	public function searchByType($type){
		$map['type'] = $type;
		return $this->car->where($map)->select();
	}

	public function searchByBrand($brand){
		$map['brand'] = array('like','%'.$brand.'%');
		return $this->car->where($map)->select();
	}
}