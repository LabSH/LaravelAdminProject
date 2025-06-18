
<!-------------------------------------------------------------->
<!-- 시작 : Content                                                                  -->
<!-------------------------------------------------------------->
@extends("main")
@section("content")
<link href="{{ asset('my/css/sub.css') }}" rel="stylesheet">

    <?php
		$cotel1 = trim(substr($row->cotel,0,3));
		$cotel2 = trim(substr($row->cotel,3,4));
		$cotel3 = trim(substr($row->cotel,7,4));
		$cotel = $cotel1."-".$cotel2."-".$cotel3;
	
	?>

	<br>
	<div class="alert mycolor1" role="alert">Worker</div>

	<form name="form1" method="post" action="">
    
	
	<table class="table table-sm table-bordered mymargin5">
		<tr>
			<td width="20%" class="mycolor2">번호</td>
			<td width="80%" align="left">{{$row->id}}</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font>회사명</td>
			<td width="80%" align="left">{{$row->coname}}</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font>회사전화</div></td>
			<td width="80%" align="left">{{$cotel}}</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font>회사종류</td>
			<td width="80%" align="left">{{$row->cokind}}</td>
		</tr>
	</table>

	<div align="center">
        <a href="{{route('co.edit',$row->id)}}{{$tmp}}" class="btn btn-sm mycolor1" >수정</a>

        <form action="{{route('co.destroy',$row->id)}}{{$tmp}}" style="display:inline;">
        @csrf
        @method('DELETE')
		<button type="submit" class="btn btn-sm mycolor1" onClick="return confirm('삭제할까요 ?');">삭제</button> 
        </form>

        <input type="button" value="이전화면" class="btn btn-sm mycolor1" onClick="history.back();" style="margin-left: 20px;">

	</div>
     

	</form>
<!-------------------------------------------------------------->
<!-- 끝 : Content                                                                     -->
<!-------------------------------------------------------------->
@endsection
