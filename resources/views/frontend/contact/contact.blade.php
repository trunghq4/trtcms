@extends('frontend.layout.layout')
@section('title') Liên Hệ @stop
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('public/frontend/css/contact.css')}}">
<main>
	<section id="contact">
		<div class="container">
			<div class="col-md-12 col-xs-12">
			<div class="text-center title">
				<h2>Liên hệ</h2>
			</div>
			<div class="clear"></div>
			<form method="post">
				<div class="form-group frm-item">
					<label class="control-label col-md-3 text-right col-xs-12" for="name" >Họ và tên (*)</label>
					<div class="col-md-6 col-xs-12">
						<input type="text" name="name" id="name" required class="form-control">
					</div>
				</div>
				<div class="clear"></div>
				<div class="form-group frm-item">
					<label class="col-md-3 text-right col-xs-12 control-label" for="email" >Email (*)</label>
					<div class="col-md-6 col-xs-12">
						<input type="text" name="email" id="email" required class="form-control">
					</div>
				</div>
				<div class="clear"></div>
				<div class="form-group frm-item">
					<label class="col-md-3 text-right col-xs-12 control-label" for="phone" >Điện thoại (*)</label>
					<div class="col-md-6 col-xs-12">
						<input type="text" name="phone" id="phone" required class="form-control">
					</div>
				</div>
				<div class="clear"></div>
				<div class="form-group frm-item">
					<label class="col-md-3 text-right col-xs-12 control-label" for="address" >Địa chỉ</label>
					<div class="col-md-6 col-xs-12">
						<input type="text" name="address" id="address" class="form-control">
					</div>
				</div>
				<div class="clear"></div>
				<div class="form-group frm-item">
					<label class="col-md-3 text-right col-xs-12 control-label" for="note" >Ghi chú</label>
					<div class="col-md-6 col-xs-12">
						<textarea name="note" id="note" class="form-control" style="height: 200px;"></textarea>
					</div>
				</div>
				<div class="clear"></div>
				<div class="form-group frm-item">
					<div class="text-center">
						<input type="submit" name="submit" class="btn btn-primary" value="Liên hệ">
					</div>
				</div>
				{{csrf_field()}}
			</form>
			</div>
		</div>
	</section>
</main>
@stop