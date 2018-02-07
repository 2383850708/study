<?php 
namespace Admin\Model;
use Think\Model;
class UserModel extends Model{
   protected $_validate = array(
     array('title','require','管理员账号不能为空！'), 
   	 array('username','','管理员账号已存在！',1,'unique',1),
     array('password','require','管理员密码不能为空！',1), 
     array('status',array(1,2),'账户状态值的范围不正确！',1,'in'),
   );

   protected $_auto = array ( 
         array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理
         array('ip','getIp',1,'callback'), 
         array('create_time','time',1,'function'),
     );

   protected function getIp()
   {	
	return $ip = get_client_ip();
   }



}
