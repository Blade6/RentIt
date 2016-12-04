<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\CarModel;
class CarController extends Controller {
	public function index(){
		$car = new CarModel();
		$data = $car->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function add(){
		if(isset($_POST["add"])){
			$car = new CarModel();
			$flag = $car->add(I('post.license_no'),I('post.type'),I('post.brand'),I('post.seat_number'),I('post.color'),I('rent_fare'),I('post.value'));
			if(!$flag){
				echo "<script>alert('添加失败!');</script>";
				layout('Layout/layout');
				$this->display();
			}
			else $this->redirect('Car/index', '', 0 ,'页面跳转中...');
		}
		else{
			layout('Layout/layout');
			$this->display();
		}
	}

	public function manage(){
		if(isset($_POST["delete"])){
			if(!I('session.level')){
				echo "<script>alert('权限不够!');</script>";
				$this->redirect('Car/index', '', 1, '页面跳转中...');
			}
			$car = new CarModel();
			$flag = $car->delete(I('post.license_no'));
			if(!$flag) echo "<script>alert('删除失败!');</script>";
			$this->redirect('Car/index', '', 1, '页面跳转中...');
		}
		else if(isset($_POST["edit_1"])) $this->redirect('Car/edit', array('license_no'=>I('post.license_no')), 0, '页面跳转中...');
		else{
			echo "<script>alert('非法操作!');</script>";
			$this->redirect('Car/index', '', 1, '页面跳转中...');
		}
	}

	public function edit($license_no=''){
		$car = D('car');
		if(isset($_POST["edit_11"])) $flag = $car->editBaseInfo(I('post.license_no'),I('post.type'),I('post.brand'),I('post.seat_number'),I('post.color'));
		else if(isset($_POST["changePic"])) $flag = $car->editCarPic(I('post.license_no'),$_FILES["car-img"]);
		else{
			$data = $car->readOne($license_no);
			$this->assign('data',$data);
			layout('Layout/layout');
			$this->display();
			exit();//不执行下面的语句
		}
		if(!$flag){
			echo "<script>alert('修改失败!');</script>";
			$this->redirect('Car/index', '', 1, '页面跳转中...');
		}
		else $this->redirect('Car/index', '', 0, '页面跳转中...');
	}

	public function superManage(){
		if(isset($_POST["edit_2"])) $this->redirect('Car/superEdit', array('license_no'=>I('post.license_no')), 0, '页面跳转中...');
		$car = new CarModel();
		$data = $car->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function superEdit($license_no=''){
		if(isset($_POST["edit_22"])){
			$car = new CarModel();
			$flag = $car->editRentInfo(I('post.license_no'),I('post.rent_fare'),I('post.value'),I('post.flag'),I('post.num'));
			if(!$flag){
				echo "<script>alert('修改失败!');</script>";
				$this->redirect('Car/superManage', '', 1, '页面跳转中...');
			}
			else $this->redirect('Car/superManage', '', 0, '页面跳转中...');
		}
		$car = new CarModel();
		$data = $car->readOne($license_no);
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function search(){
		$car = D('car');
		if(isset($_POST["search_1"])) $data = $car->searchByLicense(I('post.license_no'));
		else if(isset($_POST["search_2"])) $data = $car->searchByType(I('post.type'));
		else $data = $car->searchByBrand(I('post.brand'));
		if(!$data){
			echo "<script>alert('没有搜索到任何内容!');</script>";
			$this->redirect('Car/index', '', 1, '页面跳转中...');
		}
		else{
			$this->assign('data',$data);
			layout('Layout/layout');
			$this->display();
		}
	}
}

