<?php 
namespace Admin\Controller;
use Common\Controller\AuthController;
class AjaxController extends AuthController
{
		public function quanxian() {//成员详情
        $table_name = I('param.table_name','');
        $showLength = I('param.showLength');
        $sql = "1=1";
        //print_r($_REQUEST);
        //print_r($_REQUEST);exit;
        /*$keyword = trim(strip_tags(htmlspecialchars(strtolower(urldecode(iconv("gb2312","UTF-8",$_GET['keyword']))))));
        if (!empty($keyword)) {
            $sql .= " AND name like '%" . $keyword . "%'";
        }*/
        
        $count = M($table_name)->where($sql)->count();    //计算总数
        $Page = new \Think\PageAjax($count,$showLength);
          
        $lists = M($table_name)->where($sql)->limit($Page->firstRow . ',' . $Page->listRows)->order('id DESC')->select();
        
        $this->assign("page", $Page->show());
        $this->assign("lists", $lists);
       
        $this->assign("keyword", $keyword);
        $this->display();
        
	}
}

 ?>