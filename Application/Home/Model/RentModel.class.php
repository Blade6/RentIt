<?php
namespace Home\Model;
use Think\Model;
class RentModel extends Model{
	private $item;

	public function __construct(){
		$this->item = M('rent');
	}

	public function rent(){
		$data['userid'] = I('post.userID');
		$data['license_no'] = I('post.license_no');
		$data['draw_date'] = I('post.draw_date');
		$data['days'] = I('post.days');
		$data['deposit'] = I('post.deposit');

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