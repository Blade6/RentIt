<?php
namespace Home\Model;
use Think\Model;
class PostModel {
	private $post;

	public function __construct(){
		$this->post = M('post');
	}

	public function read($col){
		$map['coll'] = $col;
		$map['a.flag'] = 0;
		return $this->post->field(array('floor','username','picture','date','time','content','refloor'))->alias('a')->join('user b on a.userid = b.identity')->where($map)->order('floor asc')->select();
	}

	public function readByUserId($userid){
		$map['a.userid'] = $userid;
		$map['a.flag'] = 0;
		return $this->post->alias('a')->field(array('a.id','title','a.refloor','a.content','a.date','a.time'))->join('blog b on a.coll = b.collection')->where($map)->order('a.date desc,a.time desc')->select();
	}

	public function add($coll, $userid, $date, $time, $content, $refloor){
		$data['coll'] = $coll;
		
		$curFloor = $this->post->field('floor')->where($data)->order('floor desc')->limit('1')->find();
		$data['floor'] = $curFloor["floor"]+1;
				
		$data['userid'] = $userid;
		$data['date'] = $date;
		$data['time'] = $time;
		$data['content'] = $content;
		$data['refloor'] = $refloor;

		$this->post->create($data);
		if(!$this->post->add($data)) return false;
		return true;
	}

	public function delete($id){
		$data['id'] = $id;
		$flag = $this->post->delete($id);
		if($flag!==false) return true;
		return false;
	}
}