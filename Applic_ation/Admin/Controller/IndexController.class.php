<?php
namespace Admin\Controller;
use Common\Controller\AuthController;
class IndexController extends AuthController {
    public function index()
    {
		$data=D('AdminMenu')->getTreeData('tree','order_number,id');

		$assign=array(
			'data'=>$data
			);

		$this->assign($assign);
		//print_r($assign);exit;
		$this->display();
    }


}