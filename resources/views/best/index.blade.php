@extends("main")
@section("content")

<br>
	<div class="alert mycolor1" role="alert">Best 제품</div>

	<script>
		function find_text()
		{
			form1.action="{{route('best.index')}}";
			form1.submit();
		}

		$(function() {
			$("#text1").datetimepicker({
				locale: 'ko',
				format: 'YYYY-MM-DD'
			});
			$("#text2").datetimepicker({
				locale: 'ko',
				format: 'YYYY-MM-DD'
			});
			$("#text1").on("change.datetimepicker", function(e) {
				find_text();
			});
			$("#text2").on("change.datetimepicker", function(e) {
				find_text();
			});
		});


	</script>

<form name="form1" action="">
    <div class="row">
        <div class="col-12" align="left">
            <div class="d-inline-flex">
                <div class="input-group input-group-sm date" id="text1">
                    <span class="input-group-text">시작</span>
                    <input type="text" name="text1" size="16" value="{{ $text1 }}" class="form-control"
                           onkeydown="if (event.keyCode == 13) { find_text(); }" />
                    <span class="input-group-text">
                        <div class="input-group-addon">
                            <i class="far fa-calendar-alt fa-lg"></i>
                        </div>
                    </span>
                </div>
            </div>
            <div class="d-inline-flex">
                <div class="input-group input-group-sm date" id="text2">
                    <span class="input-group-text">종료</span>
                    <input type="text" name="text2" size="16" value="{{ $text2 }}" class="form-control"
                           onkeydown="if (event.keyCode == 13) { find_text(); }" >
                    <span class="input-group-text">
                        <div class="input-group-addon">
                            <i class="far fa-calendar-alt fa-lg"></i>
                        </div>
                    </span>
                </div>
            </div>
            &nbsp;
           
        </div>
    </div>
</form>


	<table class="table table-sm table-bordered table-hover mymargin5">
		<tr class="mycolor2">
			<td width="50%">제품명</td>
			<td width="50%">매출건수</td>
		</tr>
		@foreach($list as $row)
	<tr>
		<td align = "left">{{$row->products_name}}</td>
		<td align = "right">{{number_format($row->cnumo)}}</td>
	</tr>
		@endforeach
	</table>

	<div class ="row">
		<div class ="col">
			{{$list->links('mypagination')}}
		</div>
	</div>

@endsection