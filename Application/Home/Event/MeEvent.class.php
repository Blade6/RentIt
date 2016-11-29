<?php
namespace Home\Event;
use Home\Model\UserModel;
use Home\Model\RentModel;
use Home\Model\AccidentModel;
use Home\Model\AdviceModel;
use Think\Upload;
class MeEvent {
	public function readUser($userID){
		$user = new UserModel();
		$userInfo = $user->readInfo($userID);
		return $userInfo;
	}

	public function readRent($userID){
		$rent = new RentModel();
		$rentInfo = $rent->readUser($userID);
		return $rentInfo;
	}

	public function readAccident($userID){
		$accident = new AccidentModel();
		$accidentInfo = $accident->readUser($userID);
		return $accidentInfo;
	}

	/*计算当前用户发生的事故数量*/
	public function countAcci($userID){
		$accident = new AccidentModel();
		return $accident->countAcci();
	}

	/*计算当前用户正在租借的车辆数*/
	public function countOnRent($userID){
		$rent = new RentModel();
		return $rent->countOnRent($userID);
	}

	public function changeUsername($userID, $newUsername){
		$user = new UserModel();
		return $user->changeUsername($userID,$newUsername);
	}

	public function changePwd($userID, $pwd, $oldPwd, $newPwd){
		$password = md5($oldPwd);
		if($password!=$pwd){
			return -1;	
		}
		else{
			$user = new UserModel();
			return $user->changePwd($userID,$newPwd);
		}
	}

	public function uploadPic(){
		$upload  = new Upload();
		$upload->maxSize =  1048576;//设置上传文件大小为1M
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		$upload->rootPath = 'Public/user_pics/';
		$upload->savePath = '';
		//采用uniqid函数生成一个唯一的字符串序列
		$PicName = array('uniqid','');
		$upload->saveName = I('session.user').$PicName;
		//开启子目录保存
		$upload->autoSub =  true;
		$upload->subName = I('session.user');
		$info  = $upload->uploadOne($_FILES["user-head"]);
		if(!$info) return false;
		else{
			$user = new UserModel();
			return $user->changePic(I('session.user'),$info['savename']);
		}
	}

	public function readAdvice($userID){
		$advice = new AdviceModel();
		return $advice->readByUserId($userID);
	}

	public function deleteAdvice($id){
		$advice = new AdviceModel();
		return $advice->delete($id);
	}

	public function backAdvice($id){
		$advice = new AdviceModel();
		return $advice->back($id);
	}

	public function delAdviceEternally($id){
		$advice = new AdviceModel();
		return $advice->deleteForever($id);
	}
}