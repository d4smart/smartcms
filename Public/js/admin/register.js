/**
 * 前端登陆业务类
 * Created by d4smart on 2016/10/25.
 */
var register = {
    check: function () {
        var data = $("#register-data").serializeArray();
        postData = {};
        $(data).each(function (i) {
            postData[this.name] = this.value;
        });

        // 获取登陆页面中的用户名和密码
        var username = $('input[name="username"]').val();
        var email = $('input[name="email"]').val();
        if (!username) {
            dialog.error('用户名不能为空！');
            return;
        }
        if (!email) {
            dialog.error('邮箱不能为空！');
            return;
        }

        // 执行异步请求（$.post）
        var url = "/admin.php?c=register&a=register";
        $.post(url, data, function(result) {
            if (result.status == 0) {
                return dialog.error(result.message);
            }
            if (result.status == 1) {
                return dialog.success(result.message, '/admin.php?c=login')
            }
        }, 'JSON');
    }
}