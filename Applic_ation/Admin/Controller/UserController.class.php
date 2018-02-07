<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index()
    {
       $this->display();
    }

    public function add()
    {
        
    	$this->display();
    }

    public function insert()
    {	 
    	$User = D("User");

		if($User->create(I('POST.'),1))
		{		    
			$res = $User->add();
            if($res)
            {
                echo '成功';
            }
            else
            {
                echo '失败';
            }
		}
		else
		{
		   $this->error($User->getError());
		}
    }
}