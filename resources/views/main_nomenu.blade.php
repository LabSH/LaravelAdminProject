<!doctype html>
<html lang="kr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>판매관리</title>
	<link   href="{{asset('my/css/bootstrap.min.css')}}" rel="stylesheet">
	<link   href="{{asset('my/css/my.css')}}" rel="stylesheet">
	<script src="{{asset('my/js/jquery-3.7.1.min.js')}}"></script>
	<script src="{{asset('my/js/bootstrap.bundle.min.js')}}"></script>

<!-- 여기 수정-->
	<script src="{{asset('my/js/moment-with-locales.min.js')}}"></script>
	<script src="{{asset('my/js/bootstrap5-datetimepicker.min.js')}}"></script>
	<link   href="{{asset('my/css/bootstrap5-datetimepicker.min.css')}}" rel="stylesheet">
	<link   href="{{asset('my/css/all.min.css')}}" rel="stylesheet">
</head>
<body>

<div class="container">

<!-------------------------------------------------------------->
<!-- 시작 : Content                                                                  -->
<!-------------------------------------------------------------->
	@yield("content")
<!-------------------------------------------------------------->
<!-- 끝 : Content                                                                     -->
<!-------------------------------------------------------------->
</div>

</body>
</html>

