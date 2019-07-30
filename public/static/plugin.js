/**
 * 图片选择器，
 * element 按钮标识，表示点击哪个按钮会出现图片选择器
 * success function 表示成功返回url
 */
function picture_selector(element, success) {
    $(element).click(function () {
        new Promise(resolve => {
            $.ajax({
                url: "/upload/all",
                success(res) {
                    resolve(res.data.img_list);
                }
            });
        }).then(img_list => {
            layui.layer.open({
                title: "选择图片",
                area: ["50%", "80%"],
                btn: ["上传图片","取消"],
                yes(){},
                /*上传图片*/
                content: `<div class="picture_selector">
                            <div class="body">
                                
                            </div>
                         </div>
                         <style>
                            .picture_selector .content{
                                display: flex;
                                flex-direction: row;
                                flex-wrap: wrap;
                            }
                            
                            .picture_selector .img_div{
                                display:inline-block;
                                width:24%;
                                background:#eee;
                                height:150px;
                                position:relative;
                                margin:5px 0 0 5px;
                            }
                            
                            .picture_selector .img_div:hover{
                                border:1px solid #000
                            }
                            
                            .picture_selector .img_div img{
                                width: auto;
                                height: auto;
                                max-width: 100%;
                                max-height: 100%;
                                position: absolute;
                                top:50%;
                                left:50%;
                                transform: translate(-50%,-50%);
                            }
                            
                            .picture_selector .delete_img:hover{
                                padding: 5px;
                                border: 1px solid #000;
                            }
                         </style>`,
                /*弹出后回调*/
                success: () => {
                    img_list.forEach(item => {
                        $(".picture_selector .body").append(set_img_element(item));
                    });

                    /*图片上传*/
                    layui.upload.render({
                        elem: ".layui-layer-btn0",
                        url: '/upload/img',
                        /*只显示图片文件*/
                        acceptMime: 'image/*',
                        done: function (res) {
                            console.log(res);
                            if (res.status === 10001) {
                                layer.msg(res.message);
                                document.location = '/admin';
                            }
                            $(".picture_selector .body").prepend(set_img_element(res.data.img));
                            /*图片点击*/
                            click_img();
                        },
                        error: function (res) {
                            console.log(res);
                        }
                    });
                    click_img();
                }
            });
        })
    });

    /*设置图片元素*/
    function set_img_element(img) {
        return `
            <div class="img_div">
                <img data-id="${img.id}" class="upload_img" src="${img.url}">
                <span class="ti-trash delete_img"></span>
            </div>`;
    }

    /*点击图片*/
    function click_img() {
        /*点击图片出现对勾图片*/
        $(".upload_img").each((index, element) => {
            $(element).click(function () {
                success($(this).attr("src"));
                /*关闭所有弹框*/
                layer.closeAll();
            })
        });

        $(".delete_img").click(function () {
            if(confirm("确定要删除吗?")){
                $.ajax({
                    url:"/upload/delete/"+$(this).prev().attr("data-id"),
                    success:(res)=>{
                        $(this).parent().remove();
                    }
                })
            }
        })
    }
}

export default {
    picture_selector
}