<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        .degue {
            width:400px;
            height:20px;
            background-color: green;
        }
        .show {
            height: 20px;
            background-color: red;
            width:0px;
        }
    </style>
</head>
<script src="/js/jquery-3.2.1.min.js"></script>
<body>
<input type="file" id="img">
<input type="button" id="btn" value="点击">

<div class="degue">
    <div class="show"></div>
    <span class="text"></span>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        var index = 1;
        var size = 1024;
        var pag='';
        $("#btn").click(function(){
           upload();
        })
        function upload(){
            var img=document.getElementById("img").files[0];//图片信息
            var imgsize=img.size;//图片大小
            var imgname=img.name;//图片姓名
            var pag=Math.ceil(imgsize/size);//页数
            per =((start/imgsize)*100).toFixed(2);
            var start=(index-1)*size;// 开始位置
            var end = start+size; //结束位置
            var pagdata=img.slice(start,end);//每页数据
            var form = new FormData();
            form.append('file',pagdata,imgname);
            $.ajax({
                type:"post",
                data: form,
                url : "test1",
                processData: false,
                contentType: false,//mima类型
                cache:false,
                dataType : "json",
                async:true,//同步
                success:function(msg){
                    if(index < totalPage){
                        index++;
                        per = per+"%";
                        $(".show").css({width:per});
                        $(".text").text(per);
                        upload(index);
                    }else{
                        $(".show").css({width:"100%"});
                        $(".text").text("100%");
                    }
                }
            });

        }
    })

</script>