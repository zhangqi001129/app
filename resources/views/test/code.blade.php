<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<input type="hidden" value="{{$token}}" id="token">
<div id="qrcode"></div>
</body>
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/qrcode.js"></script>
</html>
<script>
    var qrcode = new QRCode('qrcode', {
        text: '{{$token}}',
        width: 256,
        height: 256,
        colorDark: '#000000',
        colorLight: '#ffffff',
        correctLevel: QRCode.CorrectLevel.H
    });
$(function(){
    token=$('#token').val();
})
    setInterval(function(){
        $.ajax({
            url:"http://zq.tactshan.com/loginredis",
            type:'post',
            data:{
                token:token,
            },
            success:function(data){
                alert(data.msg);
            },
        })
    },1000)
</script>