<!doctype html>
<html lang="kr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

	 <!-- Bootstrap Icons CDN 추가 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
	
<!--로딩애니매이션css-->
	<link href="{{ asset('my/css/ball_loading.css') }}" rel="stylesheet">

<!--일반색상css-->
  <link href="{{ asset('my/css/main_in.css') }}" rel="stylesheet">
	


</head>
<body>

  
<div id="loading">
  <img src="{{ asset('/storage/product_img/ball.png') }}" alt="로딩중">
</div>

<div class="container">

	<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
		<div class="container-fluid">
		<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('/storage/product_img/top.png') }}" alt="라라몬" style="height: 50px;"></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
				aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item"><a class="nav-link" href="{{route('jangbui.index')}}"><i class="bi bi-bag-fill"></i>매입</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('jangbuo.index')}}"> <i class="bi bi-cash"></i></i>매출</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('gigan.index')}}"> <i class="bi bi-calendar-check"></i>기간조회</a></li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" 
							role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="bi bi-bar-chart-fill"></i>통계</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="{{route('best.index')}}">BEST제품</a></li>
							<li><a class="dropdown-item" href="{{route('crosstab.index')}}">월별제품별현황</a></li>
							<li><a class="dropdown-item" href="{{route('chart.index')}}">종류별 분포도</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" 
							role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-info-square"></i>기초정보</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="{{route('gubun.index')}}">구분</a></li>
							<li><a class="dropdown-item" href="{{route('product.index')}}">제품</a></li>
							<li><hr class="dropdown-divider"></li>
						@if(session()->get('rank')==1)
							<li><a class="dropdown-item" href="{{route('member.index')}}">사용자</a></li>
						@endif
						</ul>
					</li>
					<li class="nav-item"><a class="nav-link" href="{{route('picture.index')}}"><i class="bi bi-image"></i>사진</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('ajax.index')}}"><i class="bi bi-arrow-clockwise"></i>Ajax</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('worker.index')}}"><i class="bi bi-bell"></i>Worker</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('co.index')}}"><i class="bi bi-star-fill"></i>Test</a></li>


				
				</ul>
				@if(!session()->exists("uid"))
				<a href='#' class='btn btn-lg d-flex flex-column align-items-center nav-link' style="border: none; background: transparent;" data-bs-toggle='modal' data-bs-target='#exampleModal'>
					<i class="bi bi-person" style="font-size: 24px;"></i> <!-- 아이콘 크기 조정 -->
					로그인
				</a>
				@else
				<a href="{{url('login/logout')}}" class='btn btn-lg d-flex flex-column align-items-center nav-link' style="border: none; background: transparent;">
					<i class="bi bi-box-arrow-right" style="font-size: 24px;"></i> <!-- 아이콘 크기 조정 -->
					로그아웃
				</a>
				@endif

			</div>
		</div>
    
	</nav>
<!-------------------------------------------------------------->
<!-- 시작 : Content                                                                  -->
<!-------------------------------------------------------------->

<br>
<style>
  .carousel-inner img {
    border-radius: 30px;
  }
</style>

<!-- Slide Images -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" aria-label="Slide 1" class="active" aria-current="true"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('/my/img/batang2.jpeg') }}" height="300" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('/my/img/batang1.png') }}" height="300" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('/my/img/po44.jpeg') }}" height="300" class="d-block w-100">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


	@yield("content")
<!-------------------------------------------------------------->
<!-- 끝 : Content                                                                     -->
<!-------------------------------------------------------------->

<!--여기 아래 div가 끝나는 div-->
</div> 
<script>
window.addEventListener("load", function() {
  // 현재 URL을 가져옵니다.
  var currentUrl = window.location.href;

  // 로딩 애니메이션을 실행하지 않을 URL에 포함될 키워드 목록
  var excludeKeywords = [
    "create",
    "text1",
	  "page"
  ];

  // excludeKeywords 배열에 현재 URL이 포함되어 있는지 확인합니다.
  var shouldExclude = excludeKeywords.some(keyword => currentUrl.includes(keyword));

  // 키워드가 포함되어 있으면 로딩 애니메이션을 숨깁니다.
  if (shouldExclude) {
    document.getElementById("loading").style.display = "none";
  } else {
    // 그렇지 않으면 2초 후에 로딩 애니메이션을 숨깁니다.
    setTimeout(function() {
      document.getElementById("loading").style.display = "none";
    }, 2000);
  }
});
</script>


</script>

</body>
</html>


<!-- Login Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

           <div class="modal-header" style="background-color: #F5F6CE;">
               <h5 class="modal-title" id="exampleModalLabel">로그인</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>

           <div class="modal-body bg-light">
              <form name="form_login" method="post" action="{{ url('login/check') }}">
				@csrf

				<table class="table table-borderless mymargin5">
                  <tr>
                      <td width="30%"><h6>아이디</h6></td>
                      <td width="70%"><input type="text" name="uid" class="form-control"></td>
                  </tr>
                  <tr>
                      <td><h6>암&nbsp;호</h6></td>
                      <td><input type="password" name="pwd" class="form-control"></td>
                  </tr>
              </table>
              </form>
          </div>

          <div class="modal-footer alert-secondary">
              <button type="button" class="btn btn-sm btn-secondary" onclick="javascript:form_login.submit();">확인</button>
              <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">닫기</button>
          </div>
       </div>
   </div>
</div>
