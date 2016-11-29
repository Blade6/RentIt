<?php
namespace Home\Controller;
use Think\Controller;
class HelpController extends Controller {
	public function QA(){
		$this->assign('title','FAQ');
    	$this->display();
    }

    public function principle(){
    	$this->assign('title','租车原则');
    	$this->display();
    }
}