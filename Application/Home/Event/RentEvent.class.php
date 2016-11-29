<?php
namespace Home\Event;
use Think\Controller;
use Home\Model\CarModel;
use Home\Model\UserModel;
class RentEvent extends Controller{
	public function GetCarList(){
		$car = new CarModel();
		$cars = $car->exhibit();
		return $cars;
	}

	public function GetTime(){
		//今天和两周后
		$Today = time();
		//1周有604800秒
		$TwoWeeksLater = $Today + 604800*2;
		$today = date("Y-m-d",$Today);
		$twoWeeksLater = date("Y-m-d",$TwoWeeksLater);

		return array(
			'today' => $today,
			'twoWeeksLater' => $twoWeeksLater,
		);
	}

	public function checkLogin($userID){
		if(empty($userID)){
			echo "<script>alert('您尚未登录!请登录');</script>";
			return false;
		}
		return true;
	}

	public function checkCar($license_no){
		$check = new CarModel();
		$result = $check->check($license_no);
		if($result){
			echo "<script>该车辆已被租,请刷新后重试!</script>";
			return true;
		}
		else{
			$_SESSION["license_no"] = $license_no;
			$_SESSION["draw_date"] = I('post.draw_date');
			$_SESSION["days"] = I('post.days');
			return false;
		}
	}

	public function checkUser($userID){
		$check = new UserModel();
		$result = $check->beforeRent($userID);
		return $result;
	}

	public function read(){
		$user = new UserModel();
		$userInfo = $user->readInfo(I('session.user'));
		$name = $userInfo["name"];
		$phone = $userInfo["phone_num"];

		$car = new CarModel();
		$carInfo = $car->readInfo(I('session.license_no'));
		$carImg = $carInfo["picture"];
		$rent_fare = $carInfo["rent_fare"];
		$deposit = $carInfo["value"] /10;

		return array(
			'userID' => I('session.user'),
			'name' => $name,
			'phone' => $phone,
			'license_no' => I('session.license_no'),
			'carImg' => $carImg,
			'draw_date' => I('session.draw_date'),
			'days' => I('session.days'),
			'rent_fare' => $rent_fare,
			'deposit' => $deposit,		
		);
	}
}