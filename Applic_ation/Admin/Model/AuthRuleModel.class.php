<?php 
namespace Admin\Model;
use Think\Model;
/**
 * 规则模型
 */
class AuthRuleModel extends Model
{
    protected $_validate = array(
        array('title','require','权限名不能为空！'), 
        array('title','','权限名已存在！',0,'unique',3),
        array('name','require','权限不能为空',3),   
        array('name','','权限已存在！',0,'unique',3),  
    );

    protected $_auto = array ( 

    );

    public function sel_all(){  
        $arr = $this->select();
        return $this->list_level($arr,$pid=0,$level=0);  
    }  
    //递归遍历数据  
    public function list_level($arr,$pid=0,$level=0){  
        //定义一个静态数组  
        static $data = array();  
        foreach($arr as $k => $v){  
            if($v['pid'] == $pid){  
                $v['level'] = $level;  
                if($level==0)
                {
                    $v['fuhao'] = '└─';
                }
                else
                {
                    $str = '| &nbsp;&nbsp;&nbsp;';
                    $title = $str.str_repeat('|——', $level);
                    $v['fuhao'] = $title;
                }
                
                $data[] = $v;  
                $this->list_level($arr,$v['id'],$level+1);  
            }  
        }  
        return $data;  
    }  

    
  
}


 ?>