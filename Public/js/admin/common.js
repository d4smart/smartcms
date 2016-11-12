/**
 * 应用公共JS文件，对特定id的button的点击操作执行相应处理
 * Created by d4smart on 2016/10/26.
 */

/**
 * 添加操作（button-add）
 * 点击添加按钮后，跳转到添加页面
 */
$("#button-add").click(function () {
    var url = SCOPE.add_url;
    window.location.href = url;
});

/**
 * 提交操作（smartcms-button-submit）
 * 点击提交按钮后，将数据处理并post给服务器，并根据返回的数据做出提示
 */
$("#smartcms-button-submit").click(function () {
    // 处理数据
    var data = $("#smartcms-form").serializeArray();
    postData = {};
    $(data).each(function () {
        postData[this.name] = this.value;
    });

    save_url = SCOPE.save_url;
    jump_url = SCOPE.jump_url;

    // 将获取到的数据post给服务器，并根据返回值提示
    $.post(save_url, postData, function (result) {
        if (result.status == 1) {
            return dialog.success(result.message, jump_url);
        } else if (result.status == 0) {
            return dialog.error(result.message);
        }
    }, "JSON");
});

/**
 * 编辑操作（smartcms-edit）
 * 点击编辑按钮后，跳转到编辑页面，同时传入id值
 */
$('.smartcms-table #smartcms-edit').on('click', function () {
    var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url + '&id=' + id;
    window.location.href = url;
});

/**
 * 删除操作（smartcms-delete）
 * 点击删除按钮后，获取对应的id值，询问是否确定进行删除操作，确定就执行删除操作
 */
$('.smartcms-table #smartcms-delete').on('click', function () {
    var id = $(this).attr('attr-id');
    var a = $(this).attr('attr-a');
    var message = $(this).attr('attr-message');
    var url = SCOPE.set_status_url;

    data = {};
    data['id'] = id;
    data['status'] = -1;

    layer.open({
        type: 0,
        title: "是否提交？",
        btn: ['Yes', 'No'],
        icon: 3,
        closeBtn: 2,
        content: "是否确定"+message,
        scrollbar: true,
        yes: function () {
            // 执行删除操作
            todelete(url, data);
        },
    });
});

/**
 * 删除和修改状态函数
 * @param url 后台地址
 * @param data 的数据
 */
function todelete(url, data) {
    $.post(url, data, function (s) {
        if (s.status == 1) {
            return dialog.success(s.message, '');
        } else {
            return dialog.error(s.message);
        }
    }, "JSON");
}

/**
 * 排序操作（button-listorder）
 * 点击排序按钮后，将数据处理并post给服务器，并根据返回值做出相应提示
 */
$('#button-listorder').click(function () {
    // 获取表单内容
    var data = $("#smartcms-listorder").serializeArray();
    postData = {};
    $(data).each(function () {
        postData[this.name] = this.value;
    });

    var url = SCOPE.listorder_url;
    // 将获取到的数据post给服务器，并根据返回值提示
    $.post(url, postData, function (result) {
        if (result.status == 1) {
            return dialog.success(result.message, result['data']['jump_url']);
        } else if (result.status == 0) {
            return dialog.error(result.error, result['data']['jump_url']);
        }
    }, "JSON");
});

/**
 * 修改状态操作（smartcms-on-off）
 * 点击修改状态按钮后，获取对应的id值，询问是否确定进行修改状态操作，确定就执行操作
 */
$('.smartcms-table #smartcms-on-off').on('click', function () {
    var id = $(this).attr('attr-id');
    var status = $(this).attr('attr-status');
    var url = SCOPE.set_status_url;

    data = {};
    data['id'] = id;
    data['status'] = status;

    layer.open({
        type: 0,
        title: "是否提交？",
        btn: ['Yes', 'No'],
        icon: 3,
        closeBtn: 2,
        content: "是否确定更改状态？",
        scrollbar: true,
        yes: function () {
            // 执行修改状态操作
            todelete(url, data);
        },
    });
});

/**
 * 推送（smartcms-push）
 * 将文章内容推送到选择的推荐位
 */
$('#smartcms-push').click(function () {
    var id = $('#select-push').val();
    if (id == 0) {
        return dialog.error("请选择推荐位");
    }

    push = {};
    postData = {};
    $("input[name='pushcheck']:checked").each(function (i) {
        push[i] = $(this).val();
    });

    postData['push'] = push;
    postData['position'] = id;
    var url = SCOPE.push_url;
    // 将获取到的数据post给服务器，并根据返回值提示
    $.post(url, postData, function (result) {
        if (result.status == 1) {
            return dialog.success(result.message, result['data']['jump_url']);
        } else if (result.status == 0) {
            return dialog.error(result.message);
        }
    }, "JSON");
});
