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
                done: function (res) {
                    console.log(res);
                    if(res.status===10001){
                        layui.layer.msg(res.message);
                        document.location = '/admin';
                    }
                    resolve(res.img_url);
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