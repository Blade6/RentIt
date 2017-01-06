<?php
namespace Admin\Model;
use Think\Model;
use Admin\Event\DeleteEvent;
class BlogModel extends Model {
	private $blog;

	public function __construct(){
		$this->blog = M('blog');
	}

	public function read(){
		return $this->blog->alias('a')->field(array('id','collection','title','tag','content','date','time','username','a.flag'))->join('user b on a.userid = b.identity')->order('a.date desc,a.time desc')->select();
	}

	public function readUser($userid){
		$map['userid'] = $userid;
		return $this->blog->field('collection')->where($map)->select();
	}
	
	/*
	 * 普通删除操作
	 */
	public function delete($id){
		$data['id'] = $id;
		$data['flag'] = 1;
		if(!$this->blog->data($data)->save()) return false;
		return true;
	}

	/*
	 * 恢复操作
	 */
	public function back($id){
		$data['id'] = $id;
		$data['flag'] = 0;
		if(!$this->blog->data($data)->save()) return false;
		return true;
	}

	/*
	 * 永久删除操作
	 */
	public function deleteForever($id, $col){
		$event = new DeleteEvent();
		if(!$event->deleteCol($col)) return false;

		$flag = $this->blog->delete($id);
		if($flag!==false) return true;
		return false;
	}

	public function searchByUserID($userId){
		$map['userid'] = $userId;
		return $this->blog->where($map)->select();
	}

	public function searchByDate($date){
		$map['date'] = $date;
		return $this->blog->where($map)->select();
	}

	public function searchByContent($content){
		$map['content'] = array('like', '%'.$content.'%');
		return $this->blog->where($map)->select();
	}

	/*
	 * 永久删除某用户的所有帖子
	 */
	public function deleteUser($userId){
		$map['userid'] = $userId;
		$flag = $this->blog->where($map)->delete();
		if($flag===false) return false;
		else return 1;
	}
}