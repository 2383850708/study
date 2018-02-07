<?php 
namespace Admin\Model;
use Think\Model;
/**
 * 规则模型
 */
class AuthRuleModel extends Model
{
	protected $_validate = array(
     array('title','require','标题不能为空！'), 
     array('name','require','名称不能为空！'),
   	 array('name','','名称已存在！',1,'unique',3),
     array('status',array(1,2),'账户状态值的范围不正确！',3,'in'),
   );
	//获取树状结构的规则数据
    public function getTreeRule(){
        $data=  $this->select();
        return $this->_getTree($data);
    }
    //将获取出来的所有规则用递归的方式进行树状排序
    private function _getTree($data,$pid=0,$level=0){
        static $arr=array();
        foreach ($data as $key => $value) {
            if($value['pid']==$pid){
                $value['level']=$level;
                $arr[]=$value;
                $this->_getTree($data,$value['id'],$level+1);
            }
        }
        return $arr;
    }

}


 ?>