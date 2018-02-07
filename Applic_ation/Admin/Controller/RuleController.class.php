<?php
namespace Admin\Controller;
use Common\Controller\AuthController;
class RuleController extends AuthController {
    public function index()
    {

        $this->display();
    }

    public function add()
    {
    	$model = D('AuthRule');
    	$tree=$model->getTreeRule();
    	$this->assign('tree',$tree);
    	$this->display();
    }

    public function insert()
    {
    	$model = D('AuthRule');
    	      
		if($model->create(I('POST.'),1))
		{
			$res = $model->add();
			if($res)
			{
				echo '添加成功';
			}
			else
			{
				echo '添加失败';
			}
		}
		else
		{
			$this->error($model->getError());
		}
    }

    public function _before_insert()
    {
    	$status=I('post.status');
        if($status=='on')
        {
            $_POST['status']=1;
        }
        else
        {
            $_POST['status']=0;
        }    
    }

    public function rule_list()
    {
    	$model = D('AuthRule');
    	$list=$model->getTreeRule();
    	$this->assign('list',$list);
    	$this->display();
    }
}