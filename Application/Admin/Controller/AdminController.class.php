<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AdminModel;
class AdminController extends Controller{
	public function index(){
		$admin = new AdminModel();
		$data = $admin->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function add(){
		if(isset($_POST["add"])){
			$admin = new AdminModel();

			//禁止使用root保留字，也就是说，新添加的管理员的名字不能是root.
			if(I('post.adminName')=='root'){
				$this->error('不能和默认管理员同名！');
			} 

			$flag = $admin->add(I('post.adminName'),I('post.password'));
			if(!$flag){
				echo "<script>alert('添加失败!');</script>";
				layout('Layout/layout');
				$this->display();
			}
			else $this->redirect('Admin/index', '', 0, '页面跳转中...');
		}
		else{
			layout('Layout/layout');
			$this->display();
		}
	}

	public function manage(){
		if(isset($_POST["edit_0"])){
			$this->redirect('Admin/edit', 
				array(
					'id'=>I('post.id'),
					'adminName'=>I('post.adminName'),
					'password'=>I('post.password')
				),0, '页面跳转中...');
		}
		else if(isset($_POST["delete"])){
			if(!I('session.level')){
				echo "<script>alert('权限不够!');</script>";
				$this->redirect('Admin/index', '', 1, '页面跳转中...');
			}
			$admin = D('admin');
			$flag = $admin->delete(I('post.id'));
			if(!$flag) echo "<script>alert('删除失败!');</script>";	
		}
		$this->redirect('Admin/index', '', 1, '页面跳转中...');
	}

	public function edit($id=0, $adminName='', $password=''){
		if(isset($_POST["edit_1"])){
			if(!I('session.level')&&(I('post.id')==1)){
				echo "<script>alert('权限不够!');</script>";
				$this->redirect('Admin/index', '', 1, '页面跳转中...');
			}

			$admin = new AdminModel();
			//默认管理员的名字不允许修改！
			if(I('post.id')==1&&I('post.adminName')!='root'){
				$this->error('默认管理员的名字不能被修改!');
			}

			//禁止使用root保留字
			if(I('post.id')!=1&&I('post.adminName')=='root'){
				$this->error('不能和默认管理员同名！');
			} 
			$flag = $admin->edit(I('post.id'),I('post.adminName'),I('post.password'));
			if(!$flag){
				$this->error('修改失败！');
			}
			else $this->redirect('Admin/index', '', 0, '页面跳转中...');
		}
		else{
			layout('Layout/layout');
			$this->assign('id',$id);
			$this->assign('adminName',$adminName);
			$this->display();
		}
	}

	public function search(){
		if(isset($_POST["search"])){
			$admin = new AdminModel();
			$result = $admin->search(I('post.adminName'));
			if(!$result){
				echo "<script>alert('没有搜索到任何内容!');</script>";
				$this->redirect('Admin/index', '', 1, '页面跳转中...');
			}
			else{
				$this->assign('data',$result);
				layout('Layout/layout');
				$this->display();
			}
		}
		else{
			echo "<script>alert('非法操作!');</script>";
			$this->redirect('Admin/index', '', 1, '页面跳转中...');
		}
	}
}