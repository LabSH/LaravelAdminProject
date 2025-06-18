
<!-------------------------------------------------------------->
<!-- 시작 : Content                                                                  -->
<!-------------------------------------------------------------->
@extends('main')
@section('content')
<link href="{{ asset('my/css/sub.css') }}" rel="stylesheet">

	<br>
	<div class="alert mycolor1" role="alert">Co</div>

	<form name="form1" method="post" action="{{route('co.store')}}{{$tmp}}">
    @csrf
	<table class="table table-sm table-bordered mymargin5">
		<tr>
			<td width="20%" class="mycolor2">번호</td>
			<td width="80%" align="left"></td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font>회사명</td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="text" name="coname" size="20" maxlength="20" value="{{old('name')}}" class="form-control form-control-sm">
				</div>
				<br>@error('coname') {{$message}} @enderror</br>
			</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font>회사전화</div></td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="text" name="cotel1" size="3" maxlength="3" value="" class="form-control form-control-sm">-
					<input type="text" name="cotel2" size="4" maxlength="4" value="" class="form-control form-control-sm">-
					<input type="text" name="cotel3" size="4" maxlength="4" value="" class="form-control form-control-sm">
				</div>
			</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font>회사종류</td>
			<td width="80%" align="left">
            <div class="d-inline-flex">
                <?php
                    $a_cokind = array("대기업", "중소기업", "벤처기업", "개인회사");
                    $n_cokind = count($a_cokind);
                ?>
                <select name='cokind' class="form-select form-select-sm">
                    <option value="" selected>선택하세요</option>
                    <?php for($i = 0; $i < $n_cokind; $i++) { ?>
                        <option value="<?= $i ?>"><?= $a_cokind[$i] ?></option>
                    <?php } ?>  
                </select>
            </div>
            <br>@error('cokind') {{$message}} @enderror</br>
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