<html>
<head>
    <title>Lening-@yield('title')</title>
</head>
<body>
@section('header')
    <p style="color: blue"></p>
@show

<div class="container">
    @yield('content')

</div>

@section('footer')
    <p style="color: blue"></p>
@show
</body>
</html>