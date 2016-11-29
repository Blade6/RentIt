<?php
namespace Home\Controller;
use Think\Controller;
use Home\Event\RentEvent;
use Home\Model\RentModel;
class RentController extends Controller {
	public function _before_index(){
		$newPage = new RentEvent();
		$cars = $newPage->GetCarList();
		$time = $newPage->GetTime();
		$this->assign('cars',$cars);
		$this->assign('today',$time["today"]);
		$this->assign('twoWeeksLater',$time["twoWeeksLater"]);
		$this->assign('title','短期租赁');
	}

	public function index(){
		if(isset($_POST["submit"])){
			$check = new RentEvent();
			$login = $check->checkLogin(I('session.user'));
			if(!$login) $this->redirect('Index/login', '', 1, '页面跳转中...');

			$car = $check->checkCar(I('post.submit'),I('post.draw_date'),I('post.days'));
			if($car) $this->redirect('Rent/index', '', 1, '');

			$handle = $check->checkUser($_SESSION["user"]);
			switch($handle){
				case 0:
					$this->redirect('Rent/rent', '', 1, '页面跳转中...');
					break;
				case 1:
					echo "<script>alert('您已租车!');</script>";
					$this->redirect('Me/index', '', 1, '页面跳转中...');
					break;
				case 2:
					echo "<script>alert('您尚未通过核验!');</script>";
					$this->redirect('Me/index', '', 1, '页面跳转中...');
					break;
				case 3:
					echo "<script>alert('您的租车权限被强制取消,请前往本公司办理重置手续。');</script>";
					$this->redirect('Me/index', '', 1, '页面跳转中...');
					break;
				default:
					$this->display();
					break;
			}
			
		}	
		else $this->display();
	}

	public function rent(){
		if(empty($_SESSION["user"])){
			echo "<script>alert('您尚未登录!');</script>";
			$this->redirect('Index/login', '', 1, '页面跳转中...');
		}
		if(empty($_SESSION["license_no"])){
			echo "<script>alert('您尚未选择车辆!');</script>";
			$this->redirect('Rent/index', '', 1, '页面跳转中...');
		}
		if(isset($_POST["submit"])){
			$rent = new RentModel();
			$result = $rent->rent();
			if(!$result){
				echo "<script>alert('订单操作失败，请重新操作！');</script>";
				$this->redirect('Rent/rent', '', 1, '页面跳转中...');
			}
			else{
				echo "<script>alert('请尽快前往本公司交付相关费!');</script>";
				$this->redirect('Me/index', '', 1, '页面跳转中...');
			}
		}
		else{
			$rentInfo = new RentEvent();
			$info = $rentInfo->read();
			$this->assign('info',$info);
			$this->assign('title','订单页');
			$this->display();
		}
	}
}