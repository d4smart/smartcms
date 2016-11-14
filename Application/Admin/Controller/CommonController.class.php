<?php
/**
 * 后台公共控制器
 */

namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class CommonController extends Controller
{
	public function __construct() {
		parent::__construct();
		$this->init(); // 合法性检查方法

        // 获取后台的公共数据
        $data['config'] = D("Basic")->select(); //网站配置
        $data['navs'] = D("Menu")->getAdminMenus(); //后台菜单
        $data['index'] = "index"; //后台菜单首页控制器名

        // 非用户d4smart后台不显示用户管理菜单栏（注销掉获取到的相关值）
        $username = getLoginUsername();
        foreach($data['navs'] as $k=>$v) {
            if ($v['c'] == 'admin' && $username != 'd4smart') {
                unset($data['navs'][$k]);
            }
        }

        $this->assign($data);
	}

    /**
     * 后台访问合法性检查
     * 检查用户是否登录，如果没有登陆就跳转到登陆页面
     */
	private function init() {
		// 如果已经登录
		$isLogin = $this->isLogin();
		if(!$isLogin) {
			// 跳转到登录页面
			$this->redirect('/index.php?m=admin&c=login');
		}
	}

	/**
	 * 获取登录用户信息
	 * @return array session中存储的用户登录信息
	 */
	public function getLoginUser() {
		return session("adminUser");
	}

	/**
	 * 判定用户是否登录
	 * @return boolean 是否登录
	 */
	public function isLogin() {
		$user = $this->getLoginUser();

		if($user && is_array($user)) {
			return true;
		}
		return false;
	}

    /**
     * 更改记录的排序的公共方法
     * 需要对应的模型实现updateListOrderById方法
     * @param string $model 需要排序的数据对应的模型
     */
    public function listorder($model='') {
        $listorder = $_POST['listorder'];
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $errors = array();

        try {
            if ($listorder) {
                foreach ($listorder as $id => $v) {
                    // 执行更新操作
                    $rid = D($model)->updateListOrderById(intval($id), $v);
                    if ($rid === false) {
                        $errors[] = $rid;
                    }
                }
                if ($errors) {
                    return show(0, "排序失败 - ".implode(',', $errors), array('jump_url'=>$jumpUrl));
                }
                return show(1, "排序成功！", array('jump_url'=>$jumpUrl));
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

}