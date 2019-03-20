<form action="/weixin/tag" method="post">
    {{csrf_field()}}
<table border="1">
        <tr>
            <td></td>
            <td>id</td>
            <td>微信名称</td>
            <td>添加时间</td>
            <td>关注时间</td>
            <td>操作</td>
        </tr>
        @foreach($list as $k=>$v)
            <tr>
                <td><input type="checkbox" class="num" name="openid" value="{{$v['openid']}}"></td>
                <td class="active">{{$v['id']}}</td>
                <td class="danger">{{$v['nickname']}}</td>
                <td class="warning">{{date('Y-m-d H:i:s',$v['add_time'])}}</td>
                <td class="danger">{{date('Y-m-d H:i:s',$v['subscribe_time'])}}</td>
                <td class="danger"><a href="/weixin/hei/{{$v['openid']}}"> 加入黑名单 </a></td>
            </tr>
        @endforeach
    <input type="submit" value="打标签">
    </table>
    {{$list->links()}}

</form>

