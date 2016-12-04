<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    public function login(){
        //暂时没有找到I方法中能替代isset的方案
        //因为控制器中的login方法对应视图的login页面，而login页面回调方法判断登录，所以要用isset判断submit是否配置
        if(isset($_POST["submit"])){
            $user = new UserModel();
        	//flag的值记录用户是否成功登录
        	$flag = $user->login();
        	if(!$flag){
                echo "<script>alert('身份证号或密码错误！');</script>"; 
                $this->display();
            }
        	else $this->redirect('Index/index', '', 0, '页面跳转中...');
        }
        else $this->display();
    }

    public function register(){
        if(isset($_POST["submit"])){
            $user = new UserModel();
            //flag的值记录用户是否成功注册
            $flag = $user->register();
            if(!$flag){
                echo "<script>alert('注册失败!请重新注册');</script>";
                $this->display();
            }
            else $this->redirect('Index/login', '', 0, '页面跳转中...');
        }
        else $this->display();
    }

    public function logout(){
        session('[destroy]');

        $this->redirect('Index/index', '', 0, '页面跳转中...');
    }
}