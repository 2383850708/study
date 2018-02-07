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
}


 ?>