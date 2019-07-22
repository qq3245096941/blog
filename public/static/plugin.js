/**
 * 图片上传
 * @param element 识别标签的字符串，例如id就为#id
 * @returns {Promise<any>}
 */
function upload_img(element) {
    return new Promise((resolve, reject) => {
        layui.use('upload', function () {
             layui.upload.render({
                elem: element,
                url: '/upload/img',
                /*只显示图片文件*/
                acceptMime: 'image/*',
                data: {
                    name: "img"
                },
                done: function (res) {
                    resolve(res);
                },
                error: function (res) {
                    console.log(res);
                }
            });
        });
    })
}

export default {
    upload_img
}