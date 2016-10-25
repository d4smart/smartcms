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