<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\AdviceModel;
class AdviceController extends Controller {
	public function index() {
		if(isset($_POST["submit"])){
			if(!empty($_SESSION["user"])){
				if(!I('session.shutup')){
					$ad = new AdviceModel();
					$flag = $ad->advise();
					if(!flag) echo "<script>alert('发表失败!');</script>";
				}
				else echo "<script>alert('您被禁言!');</script>";
			}
			else echo "<script>alert('您尚未登录,不能发言!');</script>";
		}
		$adv = new AdviceModel();
		$advices = $adv->read();
		$this->assign('advices',$advices);
		$this->assign('floor',1);
		$this->assign('title','意见反馈');
		$this->display();
	}

}