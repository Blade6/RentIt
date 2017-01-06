<?php
namespace Home\Controller;
use Think\Controller;
use Home\Event\MeEvent;
class MeController extends Controller {

	public function _initialize(){
		$me = new MeEvent();
		$userInfo = $me->readUser(I('session.user'));
		$this->assign('userInfo',$userInfo);
		$OnRentNum = $me->countOnRent(I('session.user'));
		$this->assign('OnRentNum',$OnRentNum);
		$AcciNum = $me->countAcci(I('session.user'));
		$this->assign('AcciNum',$AcciNum);
		$this->assign('title','个人页');
	}

	public function index(){		
		$this->display();
	}

	public function info(){
		if(isset($_POST['submit1'])){
			$me = new MeEvent();
			$flag = $me->changeUsername(I('session.user'), I('post.username'));
			if(!$flag){
				echo "<script>alert('操作失败!请稍后重试');</script>";
				$this->display();
			}
			else{
				$me = new MeEvent();
				$userInfo = $me->readUser(I('session.user'));
				$this->assign('userInfo',$userInfo);
				$this->display();
			}
		}
		else if(isset($_POST['submit2'])){
			$me = new MeEvent();
			$flag = $me->changePwd(I('session.user'),I('session.password'), I('post.password1'), I('post.password2'));
			switch ($flag) {
				case 1:
					echo "<script>alert('修改成功');</script>";
					$this->redirect('Me/index', '', 1, '页面跳转中...');
					break;
				case 0:
					echo "<script>alert('操作失败!请稍后重试');</script>";
					$this->display();
					break;
				case -1:
					echo "<script>alert('原密码不正确!');</script>";
					$this->display();
					break;
				default:
					$this->display();
					break;
			}
		}
		else if(isset($_POST["submit3"])){
			$me = new MeEvent();
			$flag = $me->uploadPic(I('session.user'),$_FILES["user-head"]);
			if(!$flag){
				echo "<script>alert('上传失败!');</script>";
				$this->display();
			}
			else{
			 	$me = new MeEvent();
				$userInfo = $me->readUser(I('session.user'));
				$this->assign('userInfo',$userInfo);
				$this->display();
			}
		}
		else $this->display();	
	}

	public function blog(){
		$me = new MeEvent();
		$blog = $me->readBlog(I('session.user'));
		$this->assign('data',$blog);
		$this->display();
	}

	public function post(){
		$me = new MeEvent();
		$post = $me->readPost(I('session.user'));
		$this->assign('data',$post);
		$this->display();
	}

	public function order(){
		$me = new MeEvent();
		$order = $me->readRent(I('session.user'));
		$this->assign('order',$order);
		$this->display();
	}

	public function accident(){
		$me = new MeEvent();
		$accident = $me->readAccident(I('session.user'));
		$this->assign('accident',$accident);
		$this->display();
	}

	public function delPost(){
		$me = new MeEvent();
		if(isset($_POST["delete"])){
			$flag = $me->deletePost(I('post.id'));
			if(!$flag){
				echo "<script>alert('操作失败!');</script>";
				$this->redirect('Me/post', '', 1, '页面跳转中...');
			}
			else $this->redirect('Me/post', '', 0, '页面跳转中...');
		}
	}

}