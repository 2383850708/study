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

		$menu = $this->get_attr($menu_list);
		$rule = $this->get_auth_name();
		//$menu = $this->get_auth_menu($menu,$rule);

		parent::pre($menu);

		$this->assign($assign);
		//print_r($assign);exit;
		$this->display();
    }

    function get_attr($a,$pid=0){  
        $tree = array();                                //每次都声明一个新数组用来放子元素  
        foreach($a as $v){  
            if($v['pid'] == $pid){                      //匹配子记录  
                $v['children'] = $this->get_attr($a,$v['id']); //递归获取子记录  
                if($v['children'] == null){  
                    unset($v['children']);             //如果子元素为空则unset()进行删除，说明已经到该分支的最后一个元素了（可选）  
                }  
                $tree[] = $v;                           //将记录存入新数组  
            }  
        }  
        return $tree;                                 //返回新数组  
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
    		if(!in_array($value['name'], $rule))
    		{
    			unset($arr[$key]);
    			continue;
    		}
    		foreach ($value['children'] as $k => $v) 
    		{
    			if(!in_array($v['name'], $rule))
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
    	$rule = array();
    	$loginInfo = parent::getLoginInfo();
    
    	$group_access = M('auth_group_access')->query('select GROUP_CONCAT(group_id) as  group_id from  '.C('DB_PREFIX').'auth_group_access where uid='.$loginInfo['user_id'].' group by uid');
    	$group_access = $group_access[0]['group_id'];

    	$condition = array();
    	$condition['id'] = array('in',$group_access);
    	$auth_group = M('auth_group')->where($condition)->select();
    	$quanxina = '';
    	if($auth_group)
    	{
    		foreach ($auth_group as $key => $value) {
    			$quanxina .= $value['rules'].',';
    		}
    		$quanxina = explode(',',rtrim($quanxina,','));
    	}



    	parent::pre($quanxina);

    }


}