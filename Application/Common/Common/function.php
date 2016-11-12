<?php
/**
 * Desp: 应用一些公用的方法和函数
 * User: d4smart
 * Date: 2016/10/25
 * Time: 18:13
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

/**
 * 将服务器的数据封装成json格式返回给客户端
 * @param $status int 状态码（1：成功；0：失败）
 * @param $message string 状态信息
 * @param array $data 返回的数据，数组格式
 */
function show($status, $message, $data=array()) {
    $result = array(
        'status'    =>  $status,
        'message'   =>  $message,
        'data'      =>  $data
    );
    echo json_encode($result);
}

/**
 * 对输入的字符串进行md5加密（添加自定义后缀）
 * @param $password string 要加密的密码字符串
 * @return string 加密后的字符串
 */
function getMd5Password($password) {
    return md5($password.C('MD5_SUF'));
}

/**
 * 根据传入的菜单type（int）值返回菜单的类型
 * @param $type int 菜单type值
 * @return string 菜单类型
 */
function getMenuType($type) {
    return $type == 1 ? "后台菜单" : "前端导航";
}

/**
 * 根据状态值显示状态信息
 * @param $status int 状态值（-1，0，1）
 * @return string 状态信息
 */
function status($status) {
    if ($status == 0) {
        return "关闭";
    } elseif ($status == 1) {
        return "正常";
    } elseif ($status == -1) {
        return "删除";
    }
}

/**
 * 根据菜单信息，返回其对应的url
 * @param $nav array 菜单数据
 * @return string url地址
 */
function getAdminMenuUrl($nav) {
    $url = '/admin.php?c='.$nav['c'].'&a='.$nav['f'];
    if ($nav['f'] == 'index') {
        $url = '/admin.php?c='.$nav['c'];
    }
    return $url;
}

/**
 * 判断后台菜单是否被选中（当前菜单）
 * @param $nav string 菜单名
 * @return string 样式代码
 */
function getActive($nav) {
    $c = strtolower(CONTROLLER_NAME);
    if (strtolower($nav == $c)) {
        return 'class="active"';
    }
    return '';
}

/**
 * 将上传文件的数据/结果封装成json格式返回给客户端
 * @param $status int 状态
 * @param $data array 上传文件的数据
 */
function showKind($status, $data) {
    header('Content-type:application/json;charset=UTF-8');
    if ($status == 0) {
        exit(json_encode(array('error'=>1,'message'=>"上传失败！")));
    } else {
        exit(json_encode(array('error'=>0,'url'=>$data)));
    }
}

/**
 * 返回目前登陆的用户的用户名
 * @return string 用户名
 */
function getLoginUsername() {
    return $_SESSION['adminUser']['username'] ? $_SESSION['adminUser']['username'] : '';
}

/**
 * 根据文章的catid获取所属的栏目名
 * @param $navs array 栏目信息（所有栏目）
 * @param $id int 文章所属栏目id
 * @return string 栏目名
 */
function getCateName($navs, $id) {
    foreach ($navs as $nav) {
        $navList[$nav['menu_id']] = $nav['name'];
    }
    return isset($navList[$id]) ? $navList[$id] : '';
}

/**
 * 根据copyfrom的值返回文章的来源信息
 * @param $id int copyfrom值
 * @return string 文章来源
 */
function getCopyFromById($id) {
    $copyFrom = C("COPY_FROM");
    return $copyFrom[$id] ? $copyFrom[$id] : '';
}
