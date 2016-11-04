<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/11/4
 * Time: 9:29
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Controller;

class CronController
{
    public function dumpmysql() {
        $result = D("Basic")->select();
        if (!$result['dumpmysql']) {
            die("系统没有设置开启自动备份数据库");
        }

        $shell = 'mysqldump -u'.C("DB_USER")." ".C("DB_NAME")."> /root/backup".date("Ymd").'.sql';
        exec($shell);
    }
}