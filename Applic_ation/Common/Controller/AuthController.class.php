<?php 
namespace Common\Controller;
use Think\Controller;
use Think\Auth;
class AuthController extends Controller
{
	protected function _initialize()
	{
		if(empty(session('user')))
		{
			//$this->error('请先登陆！',U('Login/index'), C('LONG_JUMP_TIME'));	
            redirect(U('Login/index'));	
		}
		$auth = new Auth();
		$rule_name=MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
        //echo $rule_name ;
        $result=$auth->check($rule_name,session('user.user_id'));
        /*if(!$result){
            $this->error('您没有权限访问');
        }*/
	}

	/**
	 * 获取登录信息
	 * @Author   wyk
	 * @DateTime 2018-02-12
	 */
	public function getLoginInfo()
	{
		return session('user');
	}

	/**
     * 添加日志
     * @param    content 日志内容
     * @param    type 日志分类
     * @return   return_type
     * @Author   wyk
     * @DateTime 2018-02-12
     */
    public function add_log($content,$type)
    {
        $loginInfo=$this->getLoginInfo();
        $_data = array();
        $_data['adminid'] = $loginInfo['user_id'];
        $_data['content'] = $content;
        $_data['type'] = $type;
        $_data['createtime'] = time();
        $_data['ip'] = $loginInfo['ip'];
        M('admin_log')->add($_data);
    }

    /**
     * 返回分类名称
     * @param    description
     * @param    description
     * @return   return_type
     * @Author   wyk
     * @DateTime 2018-02-12
     */
    public function type_name($type)
    {
        switch ($type) {
            case 1:
                $text = '权限管理';
                break;
            case 2:
                $text = '用户组管理';
                break;
            default:
                $text = '未知';
                break;
        }
        return $type;
    }

    /**
     * 递归无限级分类
     * @return   Array
     * @Author   wyk
     * @DateTime 2018-02-13 
     */
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
}


 ?>