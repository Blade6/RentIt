<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AccidentModel;
class AccidentController extends Controller {
	public function index(){
		$accident = new AccidentModel();
		$data = $accident->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function add(){
		if(isset($_POST["add"])){
			$accident = new AccidentModel();
			$flag = $accident->add(I('post.rentID'),I('post.userID'),I('post.licenseID'),I('post.date'),I('post.place'));
			if(!$flag){
				echo "<script>alert('添加失败!');</script>";
				layout('Layout/layout');
				$this->display();
			}
			else $this->redirect('Accident/index', '', 0, '页面跳转中...');
		}
		else{
			layout('Layout/layout');
			$this->display();
		}
	}

	public function manage(){
		if(isset($_POST["edit_0"])){
			$this->redirect('Accident/edit', 
				array(
					'id'=>I('post.id'),
					'rentid'=>I('post.rentid'),
					'userid'=>I('post.userid'),
					'license_no'=>I('post.license_no'),
					'date'=>I('post.date'),
					'place'=>I('post.place')
				),0, '页面跳转中...');
		}
		else if(isset($_POST["delete"])){
			if(!I('session.level')){
				echo "<script>alert('权限不够!');</script>";
				$this->redirect('Accident/index', '', 1, '页面跳转中...');
			}
			$accident = D('Accident');
			$flag = $accident->delete(I('post.id'));
			if(!$flag) echo "<script>alert('删除失败!');</script>";				
		}
		$this->redirect('Accident/index', '', 1, '正在处理...');
	}

	public function edit($id=0,$rentid=0,$userid='',$license_no='',$date='',$place=''){
		if(isset($_POST["edit_1"])){
			$accident = D('Accident');
			echo 'can';
			$flag = $accident->edit(I('post.id'),I('post.rentid'),I('post.userid'),I('post.license_no'),I('post.date'),I('post.place'));
			if(!$flag){
				echo "<script>alert('修改失败!');</script>";
				layout('Layout/layout');
				$this->display();
			}
			else $this->redirect('Accident/index', '', 0, '页面跳转中...');
		}
		else{
			layout('Layout/layout');
			$this->assign('id',$id);
			$this->assign('rentid',$rentid);
			$this->assign('userid',$userid);
			$this->assign('license_no',$license_no);
			$this->assign('date',$date);
			$this->assign('place',$place);
			$this->display();
		}
	}

	public function search(){
		$accident = D('Accident');

		if(isset($_POST["search_1"])) $result = $accident->searchByUserId(I('post.user_ID'));
		else if(isset($_POST["search_2"])) $result = $accident->searchByLicense(I('post.license_no'));
		else if (isset($_POST["search_3"])) $result = $accident->searchByDate(I('post.date'));
		else $this->redirect('Accident/index', '', 1, '页面跳转中...');

		if(!$result){
			echo "<script>alert('没有搜索到任何内容!');</script>";
			$this->redirect('Accident/index', '', 1, '页面跳转中...');
		}
		else{
			$this->assign('data',$result);
			layout('Layout/layout');
			$this->display();
		}

	}
}