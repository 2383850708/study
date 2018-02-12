<?php 
namespace Admin\Controller;
use Common\Controller\AuthController;
class GroupController extends AuthController
{
	public function index()
	{
		//$loginInfo = parent::getLoginInfo();
		
		$this->display();
	}

	/**
	 * ajax加载数据
	 * @Author   wyk
	 * @DateTime 2018-02-12
	 */
	public function ajax_load_data()
	{
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


	public function insert()
	{

		$model = D('AuthGroup');
    	$data = array();
    	$loginInfo = parent::getLoginInfo();
		if($model->create(I('POST.'),1))
		{
			$res = $model->add();
			if($res)
			{
				$content = $loginInfo['user_name'].'添加一个用户组id为'.$res;
				parent::add_log($content,2);
				$data['status'] = 1;
                $data['msg'] = '添加成功';
			}
			else
			{
				$data['status'] = 0;
                $data['msg'] ='添加失败';
			}
		}
		else
		{          
			$data['status'] = 0;
            $data['msg'] = $model->getError();
		}
        
        $this->ajaxReturn($data);
	}

	
}



 ?>