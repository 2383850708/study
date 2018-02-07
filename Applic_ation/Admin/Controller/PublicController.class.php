<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function index()
    {
       $this->display();
    }

    public function js()
    {
    	$this->display();
    }

    public function head()
    {
    	$this->display();
    }

    public function menu()
    {
        $user = session('user');
        
        $this->assign('user',$user);
        $this->display();
    }
}