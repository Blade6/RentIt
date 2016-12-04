<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\MessageModel;
use Admin\Model\UserModel;
class MessageController extends Controller {
	public function index(){
		$message = new MessageModel();		
		$data = $message->read();

		$date = date("Y-m-d");
		$this->assign('date',$date);

		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function search(){
		$message = new MessageModel();

		if(isset($_POST["search_1"])) $data = $message->searchByUserID(I('post.userID'));
		else if(isset($_POST["search_2"])) $data = $message->searchByDate(I('post.date'));
		else if(isset($_POST["search_3"])) $data = $message->searchByContent(I('post.content'));
		else $data = $message->orderByDateDesc();			

		if(!$data) echo "<script>alert('没有查找到任何内容!');</script>";

		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function delete(){
		$message = new MessageModel();
		//此处不能写成$message = D('board');
		//会产生一些诡异的错误，原因可能是Model类名字与数据表名字不一致
		if(isset($_POST["delete"])) $flag = $message->delete(I('post.id'));
		else if(isset($_POST["back"])) $flag = $message->back(I('post.id'));		
		else{
			if(!I('session.level')){
				echo "<script>alert('权限不够!');</script>";
				$this->redirect('Message/index', '', 1, '页面跳转中...');
			}
			$flag = $message->deleteForever(I('post.id'));
		}

		if(!$flag){
			echo "<script>alert('操作失败!');</script>";
			$this->redirect('Message/index', '', 1, '页面跳转中...');
		}
		else $this->redirect('Message/index', '', 0, '页面跳转中...');
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
			$message = new MessageModel();
			$flag = $message->deleteUser(I('post.id'));
			if($flag===false) echo "<script>alert('操作失败!');</script>";
			else if($flag===0) echo "<script>alert('该用户的留言已全部删除!');</script>";
		}
		$data = $user->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}
}