<?php
namespace Home\Model;
use Think\Model;
class AdviceModel extends Model {
	private $advice;

	public function __construct(){
		$this->advice = M('board');
	}

	public function read(){
		$map['a.flag'] = false;
		$messages = $this->advice->alias('a')->join('user b ON a.user_ID = b.identity')->where($map)->order('date asc,time asc')->select();
		return $messages;
	}

	public function advise(){
		$this->advice->user_ID = I('session.user');
		$this->advice->date = date("Y-m-d");
		$this->advice->time = date("H:i:s");
		$this->advice->content = I('words');

		if($this->advice->add()) return true;
		else return false;
	}

	public function readByUserId($userId){
		$map['user_ID'] = $userId;
		return $this->advice->where($map)->select();
	}

	public function delete($id){
		$data['id'] = $id;
		$data['flag'] = true;
		if(!$this->advice->data($data)->save()) return false;
		return true;
	}

	public function back($id){
		$data['id'] = $id;
		$data['flag'] = false;
		if(!$this->advice->data($data)->save()) return false;
		return true;
	}

	public function deleteForever($id){
		$flag = $this->advice->delete($id);
		if($flag!==false) return true;
		return false;
	}
}