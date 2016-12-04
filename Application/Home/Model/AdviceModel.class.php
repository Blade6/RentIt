<?php
namespace Home\Model;
use Think\Model;
class AdviceModel extends Model {
	private $advice;

	public function __construct(){
		$this->advice = M('board');
	}

	public function read(){
		$map['a.flag'] = 0;
		$messages = $this->advice->alias('a')->join('user b ON a.userid = b.identity')->where($map)->order('date asc,time asc')->select();
		return $messages;
	}

	public function advise(){
		$this->advice->userid = I('session.user');
		$this->advice->date = date("Y-m-d");
		$this->advice->time = date("H:i:s");
		$this->advice->content = I('words');

		if($this->advice->add()) return true;
		else return false;
	}

	public function readByUserId($userId){
		$map['userid'] = $userId;
		$map['flag'] = array('lt',2);//flag less than 2
		return $this->advice->where($map)->select();
	}

	public function delete($id){
		$data['id'] = $id;
		$data['flag'] = 1;
		if(!$this->advice->data($data)->save()) return false;
		return true;
	}

	public function appear($id){
		$data['id'] = $id;
		$data['flag'] = 0;
		if(!$this->advice->data($data)->save()) return false;
		return true;
	}

}