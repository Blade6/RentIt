<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\UserModel;
class UserController extends Controller {
	public function index(){
		$user = new UserModel();
		$data = $user->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function delete(){
		if(isset($_POST["delete"])){
			if(!I('session.level')){
				echo "<script>alert('权限不够!');</script>";
				$this->redirect('User/index', '', 1, '页面跳转中...');
			}
			$user = new UserModel();
			$flag = $user->delete(I('post.identity'));
			if(!$flag) echo "<script>alert('删除失败!');</script>";
			$this->redirect('User/index', '', 1, '页面跳转中...');
		}
		else{
			echo "<script>alert('非法操作!');</script>";
			$this->redirect('User/index', '', 1, '页面跳转中...');
		}
	}

	public function generalManage(){
		if(isset($_POST["edit_1"])){
			$identity = I('post.identity');
			$this->redirect('User/edit', array('identity'=>$identity), 0, '页面跳转中...');
		}
		$user = new UserModel();
		$data = $user->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function superManage(){
		if(isset($_POST["edit_2"])){
			$identity = I('post.identity');
			$this->redirect('User/superEdit', array('identity'=>$identity), 0, '页面跳转中...');
		}
		$user = new UserModel();
		$data = $user->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function edit($identity=0){	
		if(isset($_POST["edit_11"])){
			$user = new UserModel();
			$flag = $user->editPersonality(I('post.identity'),I('post.name'),I('post.gender'),I('post.age'),I('post.phone_num'));
			if(!$flag){
				echo "<script>alert('修改失败!请稍后重试');</script>";
				$this->redirect('User/index', '', 3, '页面跳转中...');
			}
			else $this->redirect('User/generalManage', '', 0, '页面跳转中...');
		}
		else{
			$user = new UserModel();			
			$data = $user->readOne($identity);
			$this->assign('data',$data);		
			layout('Layout/layout');
			$this->display();
		}		
	}

	public function superEdit($identity=0){
		if(isset($_POST["edit_22"])){
			$user = new UserModel();
			$flag = $user->editRentInfo(I('post.identity'),I('post.flag'),I('post.checked'),I('post.accident_num'));
			if(!$flag){
				echo "<script>alert('修改失败!请稍后重试');</script>";
				$this->redirect('User/index', '', 3, '页面跳转中...');
			}
			else $this->redirect('User/superManage', '', 0, '页面跳转中...');
		}
		else{
			$user = new UserModel();			
			$data = $user->readOne($identity);
			$this->assign('data',$data);		
			layout('Layout/layout');
			$this->display();
		}
	}

	public function search(){
		$user = new UserModel();
		if(isset($_POST["search_1"])) $result = $user->searchByUserId(I('post.userID'));
		else if(isset($_POST["search_2"])) $result = $user->searchByUserName(I('post.userName'));
		else $result = $user->searchByName(I('post.name'));
		if(!$result){
			echo "<script>alert('没有搜索到任何内容!');</script>";
			$this->redirect('User/index', '', 1, '页面跳转中...');
		}
		else{
			$this->assign('data',$result);
			layout('Layout/layout');
			$this->display();
		}
	}
}