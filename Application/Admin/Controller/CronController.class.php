<?php
/**
 * Desp: CronTab定时任务控制器
 * User: d4smart
 * Date: 2016/11/4
 * Time: 9:29
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;

class CronController
{
    /**
     * 数据库自动备份方法，可以设置crontab在后台定时触发
     */
    public function dumpmysql() {
        $result = D("Basic")->select();
        if (!$result['dumpmysql']) {
            die("系统没有设置自动备份数据库");
        }

        $shell = 'mysqldump -u'.C("DB_USER")." ".C("DB_NAME")."> /root/backup".date("Ymd").'.sql';
        exec($shell);
    }
}