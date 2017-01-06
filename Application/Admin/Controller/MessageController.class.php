<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\BlogModel;
use Admin\Model\PostModel;
use Admin\Model\UserModel;
use Admin\Event\DeleteEvent;
class MessageController extends Controller {
	public function index(){
		$blog = new BlogModel();
		$data = $blog->read();

		$date = date("Y-m-d");
		$this->assign('date',$date);

		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function search(){
		$blog = new BlogModel();
		if(isset($_POST["search_1"])) $data = $blog->searchByUserID(I('post.userID'));
		else if(isset($_POST["search_2"])) $data = $blog->searchByDate(I('post.date'));
		else $data = $blog->searchByContent(I('post.content'));		

		if(!$data) echo "<script>alert('没有查找到任何内容!');</script>";

		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function delete(){
		$blog = new BlogModel();
		if(isset($_POST["delete"])) $flag = $blog->delete(I('post.id'));
		else if(isset($_POST["back"])) $flag = $blog->back(I('post.id'));		
		else{
			if(!I('session.level')){
				echo "<script>alert('权限不够!');</script>";
				$this->redirect('Message/index', '', 1, '页面跳转中...');
			}
			$flag = $blog->deleteForever(I('post.id'),I('post.col'));
		}

		if(!$flag){
			echo "<script>alert('操作失败!');</script>";
			$this->redirect('Message/index', '', 1, '页面跳转中...');
		}
		else $this->redirect('Message/index', '', 0, '页面跳转中...');
	}

	public function post($col='',$topic='留言管理'){
		$post = new PostModel();
		$data = $post->read($col);
		$this->assign('data',$data);
		$this->assign('topic',$topic);
		$this->assign('col',$col);
		layout('Layout/layout');
		$this->display();
	}

	public function postSearch(){
		$post = new PostModel();
		if(isset($_POST["search_1"])) $data = $post->searchByUserID(I('post.col'),I('post.userID'));
		else if(isset($_POST["search_2"])) $data = $post->searchByDate(I('post.col'),I('post.date'));
		else $data = $post->searchByContent(I('post.col'),I('post.content'));		

		if(!$data) echo "<script>alert('没有查找到任何内容!');</script>";

		$this->assign('data',$data);
		$this->assign('topic',I('post.topic'));
		$this->assign('col',I('post.col'));
		layout('Layout/layout');
		$this->display();
	}

	public function postDelete(){
		$post = new PostModel();
		if(isset($_POST["delete"])){
			$flag = $post->delete(I('post.id'));
			if(!$flag){
				$this->error('删除失败');
			}
			else $this->redirect('Message/post', array('col'=>I('post.col'),'topic'=>I('post.topic')), 0, '页面跳转中...');
		}
	}

	public function nospeak(){
		$user = new UserModel();
		if(isset($_POST["nospeak"])){
			$flag = $user->noSpeak(I('post.id'));
			if(!$flag) echo "<script>alert('禁言失败!');</script>";
		}
		else if(isset($_POST["speak"])){
			$flag = $user->Speak(I('post.id'));
			if(!$flag) echo "<script>alert('解除禁言失败!');</script>";
		}
		else if(isset($_POST["delete"])){
			if(!I('session.level')){
				echo "<script>alert('权限不够!');</script>";
				$this->redirect('Message/nospeak', '', 1, '页面跳转中...');
			}
			$event = new DeleteEvent();
			$flag = $event->delUserBlogs(I('post.id'));
			if(!$flag) echo "<script>alert('操作失败!');</script>";
			else echo "<script>alert('该用户的留言已全部删除!');</script>";
		}
		$data = $user->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}
}