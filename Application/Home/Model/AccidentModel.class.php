<?php
namespace Home\Model;
use Think\Model;
class AccidentModel extends Model{
	private $accident;

	public function __construct(){
		$this->accident = M('accident');
	}

	public function readUser($userID){
		$map['userid'] = $userID;
		return $this->accident->where($map)->select();
	}

	public function countAcci($userID){
		$map['userid'] = $userID;
		return $this->accident->where($map)->count();
	}
}