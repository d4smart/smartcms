/**
 * 前端登陆JS代码
 * Created by d4smart on 2016/10/25.
 */
var login = {
    check: function () {
        // 获取登陆页面中的用户名，密码，验证码
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();
        var verify = $('input[name="verify"]').val();

        // 前端验证
        if (!username) {
            dialog.error('用户名不能为空！');
            return;
        }
        if (!verify) {
            dialog.error('验证码不能为空！');
            return;
        }

        // 执行异步请求（$.post）
        var url = "/admin.php?c=login&a=check";
        var data = {'username': username, 'password': password, 'verify': verify};
        $.post(url, data, function(result) {
            if (result.status == 0) {
                return dialog.error(result.message);
            }
            if (result.status == 1) {
                return dialog.success(result.message, '/admin.php?c=index')
            }
        }, 'JSON');
    }
};