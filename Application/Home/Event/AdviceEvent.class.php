<?php
namespace Home\Event;
use Home\Model\BlogModel;
use Home\Model\PostModel;
use Home\Model\UserModel;
class AdviceEvent {
	public function getBlog(){
		$blog = new BlogModel();
		return $blog->read();
	}

	public function getOneBlog($id){
		$blog = new BlogModel();
		return $blog->readOne($id);
	}

	public function getPostAuthor($userid){
		$user = new UserModel();
		return $user->getUnameAndPic($userid);
	}

	public function getPost($col){
		$post = new PostModel();
		return $post->read($col);
	}

	public function newBlog($title, $tag, $content, $userid){
		$date = date("Y-m-d");
		$time = date("H:i");
		$collection = $this->newCollection();

		$blog = new BlogModel();
		return $blog->add($collection, $title, $tag, $content, $date, $time, $userid);
	}

	public function newPost($col, $words, $userid){
		$date = date('Y-m-d');
		$time = date('H:i');
		$refloor = 0;
		$post = new PostModel();
		return $post->add($col,$userid,$date,$time,$words,$refloor);
	}

	/*
	 * 新建blog序列
	 * collection命名规则：前四位为月份日期，后四位为十位自然数和小写字母中随机选四位，是放回抽样。
	 * 存在的问题：使用的年份多了，生成的序列号会重复，随着时间增长需要修改数据库blog表collection长度
	 */
	public function newCollection(){
		$letters="0123456789abcdefghijklmnopqrstuvwxyz";
		$date=date('md');
		for($i=0;$i<4;$i++){
			$index = rand(0,35);
			$date.=$letters[$index];
		}
		return $date;
	}
	
}