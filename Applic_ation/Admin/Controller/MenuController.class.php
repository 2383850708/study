<?php
namespace Admin\Controller;
use Common\Controller\AuthController;
class MenuController extends AuthController {
    public function index()
    {
		$user = session('user');
		$this->assign('user',$user);
        $this->display();
    }

    public function add()
    {
    	
    }

}