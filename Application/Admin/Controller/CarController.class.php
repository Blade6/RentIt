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

	public function manage(){
		if(isset($_POST["delete"])){
			$car = new CarModel();
			$flag = $car->delete(I('post.license_no'));
			if(!$flag) echo "<script>alert('删除失败!');</script>";
			$this->redirect('Car/index', '', 1, '页面跳转中...');
		}
		else if(isset($_POST["edit_1"])){

		}
		else{
			echo "<script>alert('非法操作!');</script>";
			$this->redirect('Car/index', '', 1, '页面跳转中...');
		}
	}

	public function edit($license_no){
		$car = new CarModel();
		$data = $car->readOne($license_no);
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function superManage(){
		$car = new CarModel();
		$data = $car->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}

	public function superEdit(){

	}
}

