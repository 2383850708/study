<?php 
namespace Admin\Model;
use Think\Model;
/**
 * 规则模型
 */
class AuthGroupModel extends Model
{
    protected $_validate = array(
        array('title','require','用户组名不能为空！'), 
        array('title','','用户组名已存在！',0,'unique',3),
    );

    protected $_auto = array ( 
        array('status','1'),
    );
 
}


 ?>