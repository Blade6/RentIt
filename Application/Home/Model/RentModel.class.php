<?php
namespace Home\Model;
use Think\Model;
use Vendor\phpRPC;
class RentModel extends Model{
	private $item;

	public function __construct(){
		$this->item = M('rent');
	}

	public function rent($userId, $license_no, $date, $draw_date, $days, $rent_fare, $deposit){
		$data['userid'] = $userId;
		$data['license_no'] = $license_no;
		$data['date'] = $date;
		$data['draw_date'] = $draw_date;
		$data['days'] = $days;
		$data['fare'] = $rent_fare*$days;
		$data['deposit'] = $deposit;

		$this->item->create($data);
		if($this->item->add($data)) return true;
		else return false;
	}

	public function readUser($userID){
		$map['userid'] = $userID;
		return $this->item->where($map)->order('date desc')->select();
	}

	public function countOnRent($userID){
		$map['userid'] = $userID;
		$map['flag'] = 1; //已支付押金的订单
		$map['return_date'] = null; //实际归还日期字段为空的
		return $this->item->where($map)->count();
	}
}