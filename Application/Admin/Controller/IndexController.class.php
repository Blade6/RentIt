<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AdminModel;
class IndexController extends Controller {
    public function index(){
    	if(isset($_POST["submit"])){
    		$admin = new AdminModel();
    		$flag = $admin->login(I('post.adminname'),I('post.password'));
    		if(!$flag){
    			echo "<script>alert('用户名或密码错误!');</script>";
    			$this->display();
    		}
    		else $this->redirect('Index/manage', '', 0, '页面跳转中...');
    	}
        else $this->display();
    }

    public function manage(){
    	layout('Layout/layout');
    	$this->display();
    }

    public function logout(){
        session_start();

        session_destroy();

        $this->redirect('Index/index', '', 0, '页面跳转中...');
    }
}