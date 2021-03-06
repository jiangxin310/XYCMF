@extends('admin.alert')

@section('content')
<!-- 选出栏目 -->
<div class="clearfix">
	<form action="" class="form form-inline" method="get">
		<input type="text" name="q" value="{{ $key }}" class="form-control input-sm" placeholder="请输入标题关键字..">
		<button class="btn btn-xs btn-info">搜索</button>
	</form>
</div>
{{ csrf_field() }}
<table class="table table-striped table-hover mt10">
	<tr class="active">
		<th>名称</th>
	</tr>
	@foreach($list as $a)
	<tr>
		<td><label class="radio-inline art_checkbox_title"><input type="checkbox" name="art_id" class="input-radio" value="{{ $a->id }}" data-title="{{ $a->title }}"> {{ $a->title }}</label></td>
	</tr>
	@endforeach
</table>
<!-- 分页，appends是给分页添加参数 -->
{!! $list->appends(['q'=>$key])->links() !!}
@endsection