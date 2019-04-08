{{-- 用户注册--}}

@extends('layouts.mama')

@section('content')
    <form action="/reg" method="post">
        {{csrf_field()}}
        <h2>用户申请</h2>
        <table>
                <tr>
                    <td>
                        <label for="inputPassword" >身份证号</label>
                        <input placeholder="证件号" name="num">
                    </td>

                </tr><tr>
                <td>
                    <label for="inputPassword" >用途</label>
                    <input placeholder="证件号"name="tu">
                </td>
            </tr>
            <tr>
                <label for="inputEmail">姓名</label>
                <input placeholder="姓名"name="name">
            </tr>
        </table>
        <input type="file"name="img"><br>

        <button class="btn btn-lg btn-primary btn-block" type="submit">注册</button>
    </form>
@endsection