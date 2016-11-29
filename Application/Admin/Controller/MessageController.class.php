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

		if(isset($_POST["search_1"])){
			$data = $message->searchByUserID(I('post.userID'));
			if(!$data) echo "<script>alert('没有查找到任何内容!');</script>";
		}
		else if(isset($_POST["search_2"])){
			$data = $message->searchByDate(I('post.date'));
			if(!$data) echo "<script>alert('没有查找到任何内容!');</script>";
		}
		else if(isset($_POST["order"])){
			$data = $message->orderByDateDesc();			
		}
		else $this->redirect('Message/index', '', 0, '页面跳转中...');

		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();

	}

	public function delete(){
		if(isset($_POST["delete"])){
			$message = new MessageModel();
			$flag = $message->delete(I('post.id'));
			if(!$flag){
				echo "<script>alert('删除失败!');</script>";
				$this->redirect('Message/index', '', 1, '页面跳转中...');
			}
			else $this->redirect('Message/index', '', 0, '页面跳转中...');
		}
		else if(isset($_POST["back"])){
			$message = new MessageModel();
			$flag = $message->back(I('post.id'));
			if(!$flag){
				echo "<script>alert('恢复失败!');</script>";
				$this->redirect('Message/index', '', 1, '页面跳转中...');
			}
			else $this->redirect('Message/index', '', 0, '页面跳转中...');
		}
		else if(isset($_POST["serious"])){
			$message = new MessageModel();
			$flag = $message->deleteForever(I('post.id'));
			if(!$flag){
				echo "<script>alert('删除失败!');</script>";
				$this->redirect('Message/index', '', 1, '页面跳转中...');
			}
			else $this->redirect('Message/index', '', 0, '页面跳转中...');
		}
		else $this->redirect('Message/index', '', 0, '页面跳转中...');
	}

	public function nospeak(){
		$user = new UserModel();
		if(isset($_POST["nospeak"])){
			$flag = $user->noSpeak(I('post.id'));
			if(!$flag){
				echo "<script>alert('禁言失败!');</script>";
				$this->redirect('Message/index', '', 1, '页面跳转中...');
			}
			else $this->redirect('Message/index', '', 0, '页面跳转中...');
		}
		else if(isset($_POST["speak"])){
			$flag = $user->Speak(I('post.id'));
			if(!$flag){
				echo "<script>alert('解除禁言失败!');</script>";
				$this->redirect('Message/index', '', 1, '页面跳转中...');
			}
			else $this->redirect('Message/index', '', 0, '页面跳转中...');
		}
		$data = $user->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}
}