<?php
namespace Admin\Controller;
use Common\Controller\AuthController;
class IndexController extends AuthController {
    public function index()
    {
    	$condition = array();
    	$condition['level'] = array('in','0,1');
    	$condition['status'] = 1;
		$menu_list = M('auth_rule')->where($condition)->select();

		$menu = parent::get_attr($menu_list);
		$rule = $this->get_auth_name();
		$menu_arr = $this->get_auth_menu($menu,$rule);
		$this->assign('menu_arr',$menu_arr);
		//print_r($assign);exit;
		$this->display();
    }



    /**
     * 将没有的权限菜单删掉
     * @param    $arr 1-2级菜单 
     * @param    $rule 所有的权限
     * @Author   wyk
     * @DateTime 2018-02-26
     */
    function get_auth_menu($arr,$rule)
    {
    	
    	foreach ($arr as $key => $value) 
    	{
    		if(!in_array($value['id'], $rule))
    		{
    			unset($arr[$key]);
    			continue;
    		}
    		foreach ($value['children'] as $k => $v) 
    		{
    			if(!in_array($v['id'], $rule))
	    		{
	    			unset($arr[$key]['children'][$k]);
	    			continue;
	    		}
    		}
    	}
    	return $arr;

    }

    /**
     * 获取用户所有权限名称
     * @Author   wyk
     * @DateTime 2018-02-26
     */
    function get_auth_name()
    {
    	$loginInfo = parent::getLoginInfo();
    
    	$group_access = M('auth_group_access')->query('select GROUP_CONCAT(group_id) as  group_id from  '.C('DB_PREFIX').'auth_group_access where uid='.$loginInfo['user_id'].' group by uid');
    	$group_access = $group_access[0]['group_id'];

    	$condition = array();
    	$condition['id'] = array('in',$group_access);
    	$auth_group = M('auth_group')->where($condition)->select();
    	$rule = '';

    	if($auth_group)
    	{
    		foreach ($auth_group as $key => $value) {
    			$rule .= $value['rules'].',';
    		}

    		$rule = array_unique(explode(',',rtrim($rule,',')));
    	}

    	return $rule;

    }


}