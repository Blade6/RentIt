<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
use Home\Event\AdviceEvent;
class AdviceController extends Controller {
	public function index(){
		$event = new AdviceEvent();
		$result = $event->getBlog();
		$pages = $result['pages'];
		$data = $result['list'];
		$this->assign('data',$data);
		$this->assign('pages',$pages);
		$this->display();
	}

	public function post($col='',$id='',$page=1){
		$event = new AdviceEvent();
		$blog = $event->getOneBlog($id);
		$author = $event->getPostAuthor($blog["userid"]);
		$post = $event->getPost($col);
		$this->assign('id',$id);
		$this->assign('blog',$blog);
		$this->assign('author',$author);
		$this->assign('data',$post);
		$this->display();
	}

	public function newBlog(){
		if(isset($_POST["submit"])){
			if(!empty($_SESSION["user"])){
				if(!I('session.shutup')){
					$verify = new Verify();
					if(!$verify->check(I('post.verify'))) $this->error('验证码错误！');
					
					$event = new AdviceEvent();
					$flag = $event->newBlog(I('post.title'),I('post.tag'),I('post.content'),I('session.user'));
					if(!$flag) echo "<script>alert('发帖失败！');</script>";
				}
				else echo "<script>alert('您被禁言!');</script>";
			}
			else echo "<script>alert('您尚未登录,不能发言!');</script>";
		}
		$this->redirect('Advice/index', '', 1, '页面跳转中...');
	}

	public function repost(){
		if(isset($_POST["submit"])){
			if(!empty($_SESSION["user"])){
				if(!I('session.shutup')){
					$event = new AdviceEvent();
					$flag = $event->newPost(I('post.col'),I('post.words'),I('session.user'));
					if(!$flag) echo "<script>alert('回复失败！');</script>";
				}
				else echo "<script>alert('您被禁言!');</script>";
			}
			else echo "<script>alert('您尚未登录,不能发言!');</script>";
		}
		$this->redirect('Advice/post', array('col'=>I('post.col'),'id'=>I('post.blogid'),'page'=>1), 1, '页面跳转中');
	}

	public function verify(){
		$config =[
            'fontSize' => 16, // 验证码字体大小
            'length' => 4, // 验证码位数
            'imageH' => 38,
            'useNoise' => false,
            'useCurve' => false,
        ];
        $Verify = new Verify($config);
        $Verify->entry();
	}

}