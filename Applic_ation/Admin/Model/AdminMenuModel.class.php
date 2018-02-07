<?php 

namespace Admin\Model;
use Think\Model;
/**
 * 规则模型
 */
class AdminMenuModel extends Model
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

    /**
	 * 获取全部菜单
	 * @param  string $type tree获取树形结构 level获取层级结构
	 * @return array       	结构数据
	 */
	public function getTreeData($type='tree',$order=''){
		// 判断是否需要排序
		if(empty($order)){
			$data=$this->select();
		}else{
			$data=$this->order('order_number is null,'.$order)->select();
		}
		// 获取树形或者结构数据
		if($type=='tree'){
			$data=\Org\Nx\Data::tree($data,'name','id','pid');
		}elseif($type="level"){
			$data=\Org\Nx\Data::channelLevel($data,0,'&nbsp;','id');
			// 显示有权限的菜单
			$auth=new \Think\Auth();
			foreach ($data as $k => $v) {
				if ($auth->check($v['mca'],$_SESSION['user']['id'])) {
					foreach ($v['_data'] as $m => $n) {
						if(!$auth->check($n['mca'],$_SESSION['user']['id'])){
							unset($data[$k]['_data'][$m]);
						}
					}
				}else{
					// 删除无权限的菜单
					unset($data[$k]);
				}
			}
		}
		// p($data);die;
		return $data;
	}

}




 ?>