<?php 
namespace Admin\Controller;
use Common\Controller\AuthController;

class AdminController extends AuthController
{
	public function index()
	{ 
        $lists = M('auth_group_access')->query('select a.uid,c.username,GROUP_CONCAT(b.title) as zu from '.C('DB_PREFIX').'auth_group_access a join '.C('DB_PREFIX').'auth_group b on a.group_id = b.id join '.C('DB_PREFIX').'user c on a.uid=c.id group by a.uid');

        $group = M('auth_group')->field('id,title')->where(array('status'=>1))->select();

        $user = M('user')->field('id,username')->where(array('status'=>1))->select();



        $this->assign('group',$group);
        $this->assign("lists", $lists);
        $this->assign('user',$user);
       	
        $this->display();
	}

	/**
	 * 删除管理员
	 * @Author   wyk
	 * @DateTime 2018-02-13
	 */
	public function delete()
	{
		$id = I('post.id');
		$data = array();
		$loginInfo = parent::getLoginInfo();

		$res = M('auth_group_access')->where(array('uid'=>$id))->delete();
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
			$content = $loginInfo['user_name'].'删除一个管理员权限id为'.$id;
			parent::add_log($content,2);
		}

		$this->ajaxReturn($data);
	}

	/**
	 * 给用户分配权限
	 * @Author   wyk
	 * @DateTime 2018-02-13
	 */
	public function insert()
	{
		
		$data = array();
		$userid = I('post.userid','');
		$rules = I('post.rules',array());

		if(empty($userid))
		{
			$data['status'] = 0;
			$data['msg'] = '请选择用户';
			$this->ajaxReturn($data);
		}

		if(empty($rules))
		{
			$data['status'] = 0;
			$data['msg'] = '请选择管理组';
			$this->ajaxReturn($data);
		}

		$res = M('auth_group_access')->where(array('uid'=>$userid))->find();
		
		if($res)
		{
			$data['status'] = 0;
			$data['msg'] = '该用户已分配';
			$this->ajaxReturn($data);
		}

		$data = array();
		foreach ($rules as $key => $value) 
		{
			$data['uid'] = $userid;
			$data['group_id'] = $value;
			$res = M('auth_group_access')->add($data);
		}

		if($res)
		{
			$data['status'] = 1;
			$data['msg'] = '添加成功';
		}
		else
		{
			$data['status'] = 0;
			$data['msg'] = '添加失败';
		}

		$this->ajaxReturn($data);
	}

	/**
	 * 获取修改数据
	 * @param  uid  用户id
	 * @Author   wyk
	 * @DateTime 2018-02-22
	 */
	public function edit()
	{

		$uid = I('post.id');
		$group = M('auth_group')->field('id,title')->where(array('status'=>1))->select();
		
		$lists = M('auth_group_access')->query('select GROUP_CONCAT(group_id) as group_id FROM `think_auth_group_access` where uid='.$uid.' group by uid ');
		$lists_arr = explode(',',$lists[0]['group_id']) ;
		foreach ($group as $key => $value) 
		{
			if(in_array_case($value['id'],$lists_arr))
			{
				$group[$key]['is_check'] = 1;
			}
			else
			{
				$group[$key]['is_check'] = 0;
			}
		}
		$this->ajaxReturn($group);
	}

	public function update()
	{
		$data = array();
		$userid = I('post.userid','');
		$rules = I('post.rules',array());

		if(empty($userid))
		{
			$data['status'] = 0;
			$data['msg'] = '请选择用户';
			$this->ajaxReturn($data);
		}

		if(empty($rules))
		{
			$data['status'] = 0;
			$data['msg'] = '请选择管理组';
			$this->ajaxReturn($data);
		}

		$res = M('auth_group_access')->where(array('uid'=>$userid))->delete();
		
		if(!$res)
		{
			$data['status'] = 0;
			$data['msg'] = '修改失败';
			$this->ajaxReturn($data);
		}

		$data = array();
		foreach ($rules as $key => $value) 
		{
			$data['uid'] = $userid;
			$data['group_id'] = $value;
			$res = M('auth_group_access')->add($data);
		}

		if($res)
		{
			$data['status'] = 1;
			$data['msg'] = '修改成功';
		}
		else
		{
			$data['status'] = 0;
			$data['msg'] = '修改失败';
		}

		$this->ajaxReturn($data);
	}



}



 ?>