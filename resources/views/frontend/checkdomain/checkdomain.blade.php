@extends('frontend.layout.layout')
@section('title') Tìm kiếm @stop
@section('content')
<style type="text/css">
	.item{
		overflow: hidden;
	}
</style>
<div class="container" id="check-domain">
	<div class="col-md-8 col-md-offset-2">
		<form action="{{url('check-domain')}}" method="get">
			<div class="form-group item">
				<label class="col-md-3">Nhập tên miền</label>
				<div class="col-md-9">
					<input type="text" name="search_domain" class="form-control" required>
				</div>
			</div>
			<div class="form-group item">
				<div class="col-md-1 text-right">
					<input type="checkbox" name="end[]" value=".com" checked>
				</div>
				<label class="col-md-2 text-left">.com</label>
				<div class="col-md-1 text-right">
					<input type="checkbox" name="end[]" value=".com.vn" checked>
				</div>
				<label class="col-md-2 text-left">.com.vn</label>
				<div class="col-md-1 text-right">
					<input type="checkbox" name="end[]" value=".vn" checked>
				</div>
				<label class="col-md-2 text-left">.vn</label>
				<div class="col-md-1 text-right">
					<input type="checkbox" name="end[]" value=".net" checked>
				</div>
				<label class="col-md-2 text-left">.net</label>
				<div class="col-md-1 text-right">
					<input type="checkbox" name="end[]" value=".org.vn">
				</div>
				<label class="col-md-2 text-left">.org.vn</label>
				<div class="col-md-1 text-right">
					<input type="checkbox" name="end[]" value=".edu.vn">
				</div>
				<label class="col-md-2 text-left">.edu.vn</label>
				<div class="col-md-1 text-right">
					<input type="checkbox" name="end[]" value=".net.vn">
				</div>
				<label class="col-md-2 text-left">.net.vn</label>
				<div class="col-md-1 text-right">
					<input type="checkbox" name="end[]" value=".info">
				</div>
				<label class="col-md-2 text-left">.info</label>
			</div>
			<div class="clearfix"></div>
			<div class="form-group text-center item">
				<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
			</div>
		</form>
	</div>
</div>

@stop