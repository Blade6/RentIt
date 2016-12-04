<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\RentModel;
class RentController extends Controller {
	public function index(){
		$rent = new RentModel();
		$data = $rent->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function manage(){
		if(isset($_POST["delete"])){
			if(!I('session.level')){
				echo "<script>alert('权限不够!');</script>";
				$this->redirect('Rent/index', '', 1, '页面跳转中...');
			}
			$rent = D('rent');
			$flag = $rent->deleteOne(I('post.id'));
			if(!$flag) echo "<script>alert('删除失败!');</script>";
			$this->redirect('Rent/index', '', 0, '页面跳转中...');
		}
		else $this->redirect('Rent/edit', array('id'=>I('post.id')), 0, '页面跳转中...');
	}

	public function edit($id=0){
		if(isset($_POST["submit"])){
			$rent = D('rent');
			$flag = $rent->editRentInfo(I('post.id'),I('post.license_no'),I('post.flag'),I('post.g_flag'),I('post.draw_date'));
			if(!$flag){
				echo "<script>alert('修改失败!');</script>";
				$this->redirect('Rent/index', '', 1, '页面跳转中...');
			}
			else $this->redirect('Rent/index', '', 0, '页面跳转中...');
		}else{
			$rent = new RentModel();
			$data = $rent->readOne($id);
			$this->assign('data',$data);
			layout('Layout/layout');
			$this->display();
		}		
	}

	public function superManage(){
		if(isset($_POST["edit_2"])){
			$this->redirect('Rent/superEdit', array('id'=>I('post.id')), 0, '页面跳转中...');
		}else{
			$rent = new RentModel();
			$data = $rent->read();
			$this->assign('data',$data);
			layout('Layout/layout');
			$this->display();
		}	
	}

	public function superEdit($id=0){
		if(isset($_POST["submit"])){
			$rent = D('rent');
			$flag = $rent->editRentInfoDone(I('post.id'),I('return_date'),I('post.penalty'),I('post.p_flag'),I('post.fare'),I('post.fare_flag'));
			if(!$flag){
				echo "<script>alert('修改失败!');</script>";
				$this->redirect('Rent/superManage', '', 1, '页面跳转中...');
			}
			else $this->redirect('Rent/superManage', '', 0, '页面跳转中...');
		}else{
			$rent = new RentModel();
			$data = $rent->readOne($id);
			$this->assign('data',$data);
			layout('Layout/layout');
			$this->display();
		}
	}

	public function search(){
		$rent = D('rent');
		if(isset($_POST["search_1"])) $data = $rent->searchByUserId(I('post.userId'));
		else if(isset($_POST["search_2"])) $data = $rent->searchByLicense(I('post.license_no'));
		else $data = $rent->searchByDate(I('post.date'));
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}
}