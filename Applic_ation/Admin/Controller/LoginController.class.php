<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

    public function index()
    {

    	if(!empty(session('user')))
    	{    		
    		redirect(U("Index/index"));
    	}
    	if(cookie('check'))
    	{
    		$this->assign('username',cookie('check'));
    		$this->assign('type',1);
    	}
    	else
    	{
    		$this->assign('type',0);
    	}
    	$this->display();
    }
    /**
     * 登陆验证
     * @return [type] [description]
     */
	public function login()
    {
    	if(IS_POST)
    	{   		
			$code= I('post.verify');
			$verify = new \Think\Verify();

	        /*if(!$verify->check($code,2))
	        {
	            $this->error('验证码错误');
	        }*/
	        $condition = array();
        	$condition['username'] = I('post.username');
        	$list = M('User')->where($condition)->find();
        	
        	if(!$list)
        	{
        		$this->error('用户名不存在!');
        	}

        	if(md5(I('post.password'))!=$list['password'])
        	{
        		$this->error('密码不正确!');
        	}

        	if($list['status']==0)
        	{
        		$this->error('账号已被禁用！');
        	}
        	$ip = get_client_ip();
        	$data = array();
        	$data['ip'] = $ip;
        	$data['login_time'] = time();
        	$data['login_count'] = $list['login_count']+1;
        	$res = M('User')->where($condition)->save($data);
        	if($res)
        	{
				session('user.user_id',$list['id']);
	        	session('user.user_name',$list['username']);
	        	session('user.ip',$list['ip']);
	        	session('user.login_time',$list['login_time']);
	        	session('user.login_count',$list['login_count']); 
	        	if(I('post.check'))
				{
					cookie('check',I('post.username'));  //设置cookie
				}
				else
				{
					cookie('check',null);
				}
	        	$this->success('登陆成功',U('Index/index'),C('LONG_JUMP_TIME'));
        	}
        	else
        	{
        		$this->error('登陆失败',C('LONG_JUMP_TIME'));
        	}        	
    	}
    	else
    	{
    		$this->error('非法操作');
    	}
    }

    /**
     * 退出登陆
     * @return [type] [description]
     */
    public function login_out()
    {
    	if(!cookie('check'))
    	{
    		cookie('[destroy]');
    	}

    	session('[destroy]');
    	
    	$this->success('成功退出登陆！',U('Login/index'),C('LONG_JUMP_TIME'));
    }

    public function verifyImg()
    {
    	$config =    array(
	    'fontSize'    =>    15,    // 验证码字体大小
	    'length'      =>    4,     // 验证码位数
	    'useNoise'    =>    false, // 关闭验证码杂点
		);
		$Verify =     new \Think\Verify($config);
		echo $Verify->entry(2);
    }

 
}