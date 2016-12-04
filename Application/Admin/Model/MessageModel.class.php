<?php
namespace Admin\Model;
use Think\Model;
class MessageModel extends Model {
	private $message;

	public function __construct(){
		$this->message = M('board');
	}

	public function read(){
		return $this->message->select();
	}

	public function orderByDateDesc(){
		return $this->message->order('date desc,time desc')->select();
	}

	/*
	 * 普通删除操作
	 */
	public function delete($id){
		$data['id'] = $id;
		$data['flag'] = array('exp','flag+2');//flag = flag + 2
		if(!$this->message->data($data)->save()) return false;
		return true;
	}

	/*
	 * 恢复操作
	 */
	public function back($id){
		$data['id'] = $id;
		$data['flag'] = array('exp','flag-2');//flag = flag -2
		if(!$this->message->data($data)->save()) return false;
		return true;
	}

	/*
	 * 永久删除操作
	 */
	public function deleteForever($id){
		$flag = $this->message->delete($id);
		if($flag!==false) return true;
		return false;
	}

	public function searchByUserID($userId){
		$map['userid'] = $userId;
		return $this->message->where($map)->select();
	}

	public function searchByDate($date){
		$map['date'] = $date;
		return $this->message->where($map)->select();
	}

	public function searchByContent($content){
		$map['content'] = array('like', '%'.$content.'%');
		return $this->message->where($map)->select();
	}

	/*
	 * 永久删除某用户的所有留言
	 */
	public function deleteUser($userId){
		$map['userid'] = $userId;
		$flag = $this->message->where($map)->delete();
		if($flag===false) return false;
		else if($flag===0) return 0;
		else return 1;
	}
}