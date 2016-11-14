/**
 * 前端注册JS代码
 * Created by d4smart on 2016/10/25.
 */
var register = {
    check: function () {
        // 获取表单数据
        var data = $("#register-data").serializeArray();
        postData = {};
        $(data).each(function () {
            postData[this.name] = this.value;
        });

        // 前端验证
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

        var url = "/index.php?m=admin&c=register&a=register";
        // 执行异步请求（$.post）
        $.post(url, postData, function(result) {
            if (result.status == 0) {
                return dialog.error(result.message);
            }
            if (result.status == 1) {
                return dialog.success(result.message, 'index.php?m=admin&c=login')
            }
        }, 'JSON');
    }
};