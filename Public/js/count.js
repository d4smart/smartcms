/**
 * 异步获取文章阅读数JS文件
 * Created by d4smart on 2016/11/4.
 */

var newsIds = {};
$(".news_count").each(function (i) {
    newsIds[i] = $(this).attr("news-id");
});

url = "/index.php?c=index&a=getCount";

$.post(url, newsIds, function (result) {
    if (result.status == 1) {
        counts = result.data;
        $.each(counts, function (news_id, count) {
            $(".node-"+news_id).html(count);
        });
    }
}, "JSON");