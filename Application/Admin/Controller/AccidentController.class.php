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

	}

	public function edit(){

	}

	public function delete(){
		
	}

	public function search(){
		
	}
}