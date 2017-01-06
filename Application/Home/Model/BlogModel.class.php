<?php
namespace Home\Model;
use Think\Model;
use Think\Page;
class BlogModel extends Model {
	private $blog;

	public function __construct(){
		$this->blog = M('blog');
	}

	public function read(){
		$map['a.flag'] = 0;

		$page = new Page($counts,10);
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','末页');
        $page->setConfig('theme', ' 共 %TOTAL_ROW% 条数据 共%TOTAL_PAGE%页 %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$list = $this->blog->field(array('id','collection','replyNum','title','tag','content','date','time','username'))->alias('a')->join('user b on a.userid = b.identity')->order('date desc,time desc')->where($map)->limit($page->firstRow.','.$page->listRows)->select();
		$pages = $page->show();
		return array(
			'pages'=>$pages,
			'list'=>$list
			);
	}

	public function readOne($id){
		$map['id'] = $id;
		return $this->blog->field(array('collection','title','tag','content','date','time','userid'))->where($map)->find();
	}

	public function readByUserId($userid){
		$map['userid'] = $userid;
		return $this->blog->where($map)->order('date desc,time desc')->select();
	}

	public function add($collection, $title, $tag, $content, $date, $time, $userid){
		$data['collection'] = $collection;
		$data['title'] = $title;
		$data['tag'] = $tag;
		$data['content'] = $content;
		$data['date'] = $date;
		$data['time'] = $time;
		$data['userid'] = $userid;

		$this->blog->create($data);
		if(!$this->blog->add($data)) return false;
		return true;
	}

}