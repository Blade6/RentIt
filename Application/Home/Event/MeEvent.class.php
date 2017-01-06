<?php
namespace Home\Event;
use Home\Model\UserModel;
use Home\Model\RentModel;
use Home\Model\AccidentModel;
use Home\Model\BlogModel;
use Home\Model\PostModel;
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

	public function uploadPic($userId, $photo){
		$upload  = new Upload();
		$upload->maxSize =  1048576;//设置上传文件大小为1M
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		$upload->rootPath = 'Public/user_pics/';
		$upload->savePath = '';
		//采用uniqid函数生成一个唯一的字符串序列
		$upload->saveName = array('uniqid','');
		//开启子目录保存
		$upload->autoSub =  true;
		$upload->subName = $userId;
		$info  = $upload->uploadOne($photo);
		if(!$info) return false;
		else{
			$user = new UserModel();
			return $user->changePic($userId,$info['savename']);
		}
	}

	public function readBlog($userID){
		$blog = new BlogModel();
		return $blog->readByUserId($userID);
	}

	public function readPost($userID){
		$post = new PostModel();
		return $post->readByUserId($userID);
	}

	public function deletePost($id){
		$post = new PostModel();
		return $post->delete($id);
	}

}