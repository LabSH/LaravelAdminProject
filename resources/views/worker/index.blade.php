@extends("main")
@section("content")
<link href="{{ asset('my/css/sub.css') }}" rel="stylesheet">

<br>
	<div class="alert mycolor1" role="alert">Worker</div>

	<script>
		function find_text()
		{
			form1.action="{{route('worker.index')}}";
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
			<a href="{{route('worker.create')}}{{$tmp}}" class="btn btn-sm mycolor1">추가</a>
		</div>
	</div>
	</form>

	<table class="table table-sm table-bordered table-hover mymargin5">
		<tr class="mycolor2">
			<td width="10%">번호</td>
			<td width="20%">이름</td>
			<td width="20%">전화</td>
			<td width="10%">성별</td>
		</tr>

	@foreach($list as $row)

	<?php
		$phone1 = trim(substr($row->phone,0,3));
		$phone2 = trim(substr($row->phone,3,4));
		$phone3 = trim(substr($row->phone,7,4));
		$phone = $phone1."-".$phone2."-".$phone3;
		

		// 이름 a태그 있는 주소는 memeber클래스의 show 함수를의미함
	?>
	<tr>
		<td>{{$row->id}}</td>
		<td><a href="{{ route('worker.show', $row->id) }}{{$tmp}}">{{$row->name}}</a></td>
		<td>{{$phone}}</td>
		<td>{{$row->gender}}</td>
	</tr>
	@endforeach
	</table>

	<div class ="row">
		<div class ="col">
			{{$list->links('mypagination')}}
		</div>
	</div>

@endsection