<?php
/*
 * Model类之间能相互调用，以协助完成因为外键而导致的级联删除操作
 * user表和car表都有键被引用，删除这两个表的记录的时候需要先删除其他表中所有包含被引用键的记录
 */
namespace Admin\Event;
use Admin\Model\BlogModel;
use Admin\Model\PostModel;
use Admin\Model\AccidentModel;
use Admin\Model\RentModel;
class DeleteEvent {
	/*
	 * 删除某用户的所有违章记录
	 */
	public function delUserAccidents($userId){
		$accident = new AccidentModel();
		return $accident->deleteUser($userId);
	}

	/*
	 * 删除某用户的所有回复
	 */
	public function delUserPosts($userId){
		$post = new PostModel();
		return $post->deleteUser($userId);
	}

	/*
	 * 删除某个帖子下的所有回复
	 */
	public function deleteCol($col){
		$post = new PostModel();
		return $post->deleteColl($col);
	}

	/*
	 * 删除某用户的所有帖子
	 */
	public function delUserBlogs($userId){
		$blog = new BlogModel();
		//先取出该用户的所有帖子
		$userBlogs = $blog->readUser($userId);
		//对每一个帖子，删除该帖子下所有的回复
		foreach($userBlogs as $key=>$value){
			$flag = $this->deleteCol($value["collection"]);
			if(!$flag) return false;
		}
		//删除所有该用户的帖子
		return $blog->deleteUser($userId);
	}

	/*
	 * 删除某用户的所有租车记录，必须在delAccidents方法被执行后才能调用
	 * 因为accident表也外键引用了rent表的记录
	 */
	public function delUserRent($userId){
		if(!$this->delUserAccidents($userId)) return false;
		$rent = new RentModel();
		return $rent->deleteUser($userId);
	}

	public function delCarAccidents($license_no){
		$accident = new AccidentModel();
		return $accident->deleteCar($license_no);
	}

	public function delCarRent($license_no){
		if(!$this->delCarAccidents($license_no)) return false;
		$rent = new RentModel();
		return $rent->deleteCar($license_no);
	}
}