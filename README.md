## 项目简介

使用ThinkPHP开发的一个CMS内容管理网站

## 功能
1. 前台首页，栏目，文章详情页的展示
2. 后台管理（文章，菜单，用户，推荐位，网站配置）
3. 文章使用kindeditor富文本编辑器编辑
4. AJAX方法发送数据，JS交互
5. 图片异步上传
6. JS弹层
7. 数据库定时备份与命令行手动备份
8. 登陆和注册功能
9. 自定义的错误提示页面

## 使用方法
1. 将代码clone到web根目录下
3. 导入目录下的smartcms.sql到数据库中
4. 在Application/Common/Conf下新建db_config.php文件，填入数据库连接信息，连接刚才导入的数据库
5. 如果服务器不支持pathinfo和rewrite模式则需要进行配置

## 部署网址
http://cms.d4smarter.com/

## 联系我
d4smart@foxmail.com