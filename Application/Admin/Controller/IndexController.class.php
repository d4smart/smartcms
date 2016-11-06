<?php
/**
 * 后台首页控制器
 */

namespace Admin\Controller;

class IndexController extends CommonController
{
    
    public function index(){
        $news = D("News")->maxCount();
        $newsCount = D('News')->getNewsCount(array('status'=>1));
        $positionCount = D("Position")->getCount(array('status'=>1));
        $adminCount = D("Admin")->getLastLoginUsers();

        $this->assign('news', $news);
        $this->assign('newscount', $newsCount);
        $this->assign('positioncount', $positionCount);
        $this->assign('admincount', $adminCount);
    	$this->display();
    }

}