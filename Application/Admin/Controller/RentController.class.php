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

	public function superManage(){
		$rent = new RentModel();
		$data = $rent->read();
		$this->assign('data',$data);
		layout('Layout/layout');
		$this->display();
	}
}