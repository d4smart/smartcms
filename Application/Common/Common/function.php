<?php
/**
 * Desp: 公用的方法和函数
 * User: d4smart
 * Date: 2016/10/25
 * Time: 18:13
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

function show($status, $message, $data=array()) {
    $result = array(
        'status'    =>  $status,
        'message'   =>  $message,
        'data'      =>  $data
    );

    exit(json_encode($result));
}

function getMd5Password($password) {
    return md5($password.C('MD5_SUF'));
}

function getMenuType($type) {
    return $type == 1 ? "后台菜单" : "前端导航";
}

function status($status) {
    if ($status == 0) {
        $str = "关闭";
    } elseif ($status == 1) {
        $str = "正常";
    } elseif ($status == -1) {
        $str = "删除";
    }
    return $str;
}
