{{-- 购物车 --}}
@extends('layouts.mama')
@section('content')
<table class="table table-hover" border="1">
    <tr>
        <td>id</td>
        <td>名字</td>
        <td>证件号</td>
        <td>用途</td>
        <td>是否审核</td>
        <td>操作</td>
    </tr> @foreach($data as $k=>$v)
    <tr>

        <td class="active">{{$v['id']}}</td>
        <td class="active">{{$v['name']}}</td>
        <td class="success">{{$v['num']}}</td>
        <td class="danger">{{$v['tu']}}</td>
        @if($v['is_shen']==0)
        <td class="danger">
            {{'否'}}
        </td>
        @else
            <td class="danger">
                {{'通过'}}
            </td>
        @endif
        <td class="danger"><a href="/shen/{{$v['id']}}">审核</a></td>


    </tr> @endforeach
</table>

@endsection

@section('footer')
@parent
@endsection
