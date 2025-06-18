@extends("main")
@section("content")
<link href="{{ asset('my/css/sub.css') }}" rel="stylesheet">

<br>
	<div class="alert mycolor1" role="alert">Co</div>

	<script>
		function find_text()
		{
			form1.action="{{route('co.index')}}";
			form1.submit();
		}
	</script>

	<form name="form1" action="">

	<div class="row">
		<div class="col-3" align="left">
			<div class="input-group input-group-sm">
				<span class="input-group-text">이름</span>
				<input type="text" name="text1" value="{{$text1}}" class="form-control" 
					onKeydown="if (event.keyCode == 13) { find_text(); }"> 
				<button class="btn mycolor1" type="button" onClick="find_text();">검색</button>
			</div>
		</div>
		<div class="col-9" align="right">
			<a href="{{route('co.create')}}{{$tmp}}" class="btn btn-sm mycolor1">추가</a>
		</div>
	</div>
	</form>

	<table class="table table-sm table-bordered table-hover mymargin5">
		<tr class="mycolor2">
			<td width="10%">번호</td>
			<td width="20%">회사명</td>
			<td width="20%">회사전화</td>
			<td width="10%">회사종류</td>
		</tr>

	@foreach($list as $row)

	<?php
		$cotel1 = trim(substr($row->cotel,0,3));
		$cotel2 = trim(substr($row->cotel,3,4));
		$cotel3 = trim(substr($row->cotel,7,4));
		$cotel = $cotel1."-".$cotel2."-".$cotel3;
		

		// 이름 a태그 있는 주소는 memeber클래스의 show 함수를의미함
	?>
	<tr>
		<td>{{$row->id}}</td>
		<td><a href="{{ route('co.show', $row->id) }}{{$tmp}}">{{$row->coname}}</a></td>
		<td>{{$cotel}}</td>
		<td>{{$row->cokind}}</td>
	</tr>
	@endforeach
	</table>

	<div class ="row">
		<div class ="col">
			{{$list->links('mypagination')}}
		</div>
	</div>

@endsection