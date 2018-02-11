<?php
namespace Admin\Controller;
use Common\Controller\AuthController;
class RuleController extends AuthController 
{
    static public $treeList = array();
    public function index()
    {
        $cats = D('AuthRule')->sel_all();
        $this->assign('cats',$cats);
        $this->display();
    }

    public function insert()
    {

    	$model = D('AuthRule');
    	$data = array();
		if($model->create(I('POST.'),1))
		{
			$res = $model->add();
			if($res)
			{
				$data['status'] = 1;
                $data['msg'] = '添加成功';
			}
			else
			{
				$data['status'] = 0;
                $data['msg'] ='添加失败';
			}
		}
		else
		{          
			$data['status'] = 0;
            $data['msg'] = $model->getError();
		}
        
        $this->ajaxReturn($data);
    }

    /**
     * 权限修改
     */
    public function update()
    {
        $model = D('AuthRule');
        $data = array();
        $result = array();
        $condition = array();
        if($model->create(I('POST.'),2))
        {
            $condition['id'] = I('post.id');
            $result['name'] = I('post.name');
            $result['title'] = I('post.title');
            $res = $model->where($condition)->save($result);
            if($res!== false)
            {
                $data['status'] = 1;
                $data['msg'] = '修改成功';
            }
            else
            {
                $data['status'] = 0;
                $data['msg'] ='修改失败';
            }
        }
        else
        {          
            $data['status'] = 0;
            $data['msg'] = $model->getError();
        }
        
        $this->ajaxReturn($data);
    }

    public function delete()
    {
        print_r($_POST);exit;
    }

    public function rule_list()
    {
    	$model = D('AuthRule');
    	$list=$model->getTreeRule();
    	$this->assign('list',$list);
    	$this->display();
    }
}