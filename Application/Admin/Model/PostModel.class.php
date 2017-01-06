<?php
namespace Admin\Model;
use Think\Model;
class PostModel extends Model {
	private $post;

	public function __construct(){
		$this->post = M('post');
	}

	public function read($col){
		$map['coll'] = $col;
		return $this->post->where($map)->select();
	}

	public function delete($id){
		$flag = $this->post->delete($id);
		if($flag!==false) return true;
		return false;
	}

	public function deleteUser($userid){
		$map['userid'] = $userid;
		$flag = $this->post->where($map)->delete();
		if($flag!==false) return true;
		return false;
	}

	public function deleteColl($col){
		$map['coll'] = $col;
		$flag = $this->post->where($map)->delete();
		if($flag!==false) return true;
		return false;
	}

	public function searchByUserID($col, $userId){
		$map['coll'] = $col;
		$map['userid'] = $userId;
		return $this->post->where($map)->select();
	}

	public function searchByDate($col, $date){
		$map['coll'] = $col;
		$map['date'] = $date;
		return $this->post->where($map)->select();
	}

	public function searchByContent($col, $content){
		$map['coll'] = $col;
		$map['content'] = array('like', '%'.$content.'%');
		return $this->post->where($map)->select();
	}
}