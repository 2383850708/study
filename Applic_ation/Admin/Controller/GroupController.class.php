<?php 
namespace Admin\Controller;
use Common\Controller\AuthController;
class GroupController extends AuthController
{
	public function index()
	{
		//$loginInfo = parent::getLoginInfo();
		
		$this->display();
	}

	/**
	 * ajax加载数据
	 * @Author   wyk
	 * @DateTime 2018-02-12
	 */
	public function ajax_load_data()
	{
        $table_name = I('param.table_name','');
        $showLength = I('param.showLength',20);
        $sql = "1=1";
        //print_r($_REQUEST);
        //print_r($_REQUEST);exit;
        /*$keyword = trim(strip_tags(htmlspecialchars(strtolower(urldecode(iconv("gb2312","UTF-8",$_GET['keyword']))))));
        if (!empty($keyword)) {
            $sql .= " AND name like '%" . $keyword . "%'";
        }*/
        
        $count = M($table_name)->where($sql)->count();    //计算总数
        $Page = new \Think\PageAjax($count,$showLength);
          
        $lists = M($table_name)->where($sql)->limit($Page->firstRow . ',' . $Page->listRows)->order('id asc')->select();
        
        $this->assign("page", $Page->show());
        $this->assign("lists", $lists);
       
        $this->assign("keyword", $keyword);
        $this->display();
	}

	/**
	 * 用户组添加
	 * @Author   wyk
	 * @DateTime 2018-02-12
	 */
	public function insert()
	{
		$model = D('AuthGroup');
    	$data = array();
    	$loginInfo = parent::getLoginInfo();
		if($model->create(I('POST.'),1))
		{
			$res = $model->add();
			if($res)
			{
				$content = $loginInfo['user_name'].'添加一个用户组id为'.$res;
				parent::add_log($content,2);
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
	 * 用户组修改
	 * @Author   wyk
	 * @DateTime 2018-02-12
	 */
	public function update()
    {
    	

        $model = D('AuthGroup');
        $data = array();
        $result = array();
        $condition = array();
        if($model->create(I('POST.'),2))
        {
            $condition['id'] = I('post.id');
            $result['title'] = I('post.title');
            $res = $model->where($condition)->save($result);
            if($res!== false)
            {
            	//添加日志
	            $title = M('auth_group')->getField('title');
				$loginInfo = parent::getLoginInfo();
				$content = $loginInfo['user_name'].'将用户组名\''.$title.'\'改为->'.I('post.title');
				parent::add_log($content,2);

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

    /**
     * 用户组删除
     * @Author   wyk
     * @DateTime 2018-02-12
     */
	public function delete()
	{
		$id = I('post.id');
		$data = array();
		$loginInfo = parent::getLoginInfo();
		$res = M('auth_group')->delete($id);
		if($res)
		{			
			$data['status'] = 1;
			$data['msg'] = '删除成功';
		}
		else
		{
			$data['status'] = 0;
			$data['msg'] = '删除失败';
		}
		if($res)
		{
			$loginInfo = parent::getLoginInfo();
			$content = $loginInfo['user_name'].'删除一个用户组id为'.$id;
			parent::add_log($content,2);
		}
		$this->ajaxReturn($data);
	}

	/**
	 * 分配权限
	 * @Author   wyk
	 * @DateTime 2018-02-12
	 */
	public function rule_group()
	{
		if(IS_POST)
		{			
			print_r(I('post.'));exit;
			$map = array();
			$map['id'] = I('post.id');
			$data = array();
			$data['rules'] = implode(',', I('post.rule_ids'));
			$result = M('auth_group')->where($map)->save($data);
			if($result)
			{
				$this->success('操作成功',U('Group/index'),C('LONG_JUMP_TIME'));
			}
			else
			{
				$this->error('操作失败',U('Group/index'),C('LONG_JUMP_TIME'));
			}
		}
		else
		{
			$id = I('get.id');
			$group_data=M('auth_group')->where(array('id'=>$id))->find();

			$group_data['rules']=explode(',', $group_data['rules']);
			$condition = array();
			$condition['status'] = 1;
			$auth_rule = M('auth_rule')->where($condition)->select();
			$result = parent::get_attr($auth_rule);
			
			$this->assign('group_data',$group_data);
			$this->assign('result',$result);
			$this->display();
		}
	}

	

	
}



 ?>