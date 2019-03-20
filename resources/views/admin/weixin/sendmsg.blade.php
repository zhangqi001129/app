<form action="/admin/weixin/action" method="post">
    {{csrf_field()}}
    <textarea name="msg" id="" cols="100" rows="10"></textarea>
    <input type="submit" value="send">
</form>