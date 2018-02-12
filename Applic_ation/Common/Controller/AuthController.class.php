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
			$this->error('请先登陆！',U('Login/index'), C('LONG_JUMP_TIME'));			
		}
		//$auth = new Auth();
		
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
}


 ?>