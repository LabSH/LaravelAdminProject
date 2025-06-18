
<!-------------------------------------------------------------->
<!-- 시작 : Content                                                                  -->
<!-------------------------------------------------------------->
@extends('main')
@section('content')
<link href="{{ asset('my/css/sub.css') }}" rel="stylesheet">

	<br>
	<div class="alert mycolor1" role="alert">Worker</div>

	<form name="form1" method="post" action="{{route('worker.store')}}{{$tmp}}">
    @csrf
	<table class="table table-sm table-bordered mymargin5">
		<tr>
			<td width="20%" class="mycolor2">번호</td>
			<td width="80%" align="left"></td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font> 이름</td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="text" name="name" size="20" maxlength="20" value="{{old('name')}}" class="form-control form-control-sm">
				</div>
				<br>@error('name') {{$message}} @enderror</br>
			</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font>전화</div></td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="text" name="phone1" size="3" maxlength="3" value="" class="form-control form-control-sm">-
					<input type="text" name="phone2" size="4" maxlength="4" value="" class="form-control form-control-sm">-
					<input type="text" name="phone3" size="4" maxlength="4" value="" class="form-control form-control-sm">
				</div>
			</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font>성별</td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="radio" name="gender" value="0" checked>&nbsp;남자&nbsp;&nbsp;
					<input type="radio" name="gender" value="1">&nbsp;여자
				</div>
			</td>
		</tr>
	</table>

	<div align="center">
		<input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
		<input type="button" value="이전화면" class="btn btn-sm mycolor1" onClick="history.back();">
	</div>

	</form>
<!-------------------------------------------------------------->
<!-- 끝 : Content                                                                     -->
<!-------------------------------------------------------------->

@endsection