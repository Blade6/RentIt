<?php
namespace Admin\Event;
use Admin\Model\MessageModel;
use Admin\Model\AccidentModel;
use Admin\Model\RentModel;
class DeleteEvent {
	/*
	 * 删除某用户的所有违章记录
	 */
	public function delUserAccidents($userId){
		$accident = new AccidentModel();
		return $accident->deleteUser($userId);
	}

	/*
	 * 删除某用户的所有留言
	 */
	public function delUserMessages($userId){
		$message = new MessageModel();
		return $message->deleteUser($userId);
	}

	/*
	 * 删除某用户的所有租车记录，必须在delAccidents方法被执行后才能调用
	 * 因为accident表也外键引用了rent表的记录
	 */
	public function delUserRent($userId){
		if(!$this->delUserAccidents($userId)) return false;
		$rent = new RentModel();
		return $rent->deleteUser($userId);
	}

	public function delCarAccidents($license_no){
		$accident = new AccidentModel();
		return $accident->deleteCar($license_no);
	}

	public function delCarRent($license_no){
		if(!$this->delCarAccidents($license_no)) return false;
		$rent = new RentModel();
		return $rent->deleteCar($license_no);
	}
}