@extends('frontend.layout.layout')
@section('title') Giỏ hàng @stop
@section('content')
	<main>
		<div class="product">
			<div class="container">
				<div class="col-md-12 col-xs-12">
					<h2>Giỏ hàng</h2>
				</div>
			</div>
		</div>
		<div id="list-cart">
			<div class="container">
				<div class="col-md-12 col-xs-12" id="table-cart">
					<table class="table table-hover table-bordered">
						<form id="frm-cart">
							<tr>
								<th>Stt</th>
								<th>Ảnh</th>
								<th>Tên sản phẩm</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Tổng</th>
								<th></th>
							</tr>
							@if(!empty($cart))
							<?php $i =0; ?>
							@foreach($cart as $items)
							<?php $i++; ?>
							<tr>
								<td>{{$i}}</td>
								<td><img src="{{url($items->options->image)}}" class="img-thumbnail"></td>
								<td><strong>{{$items->name}}</strong></td>
								<td>{{number_format($items->price,0,",",".")}} <sup>đ</sup></td>
								<td><input type="text" name="qty" data-rowid="{{$items->rowid}}" value="{{$items->qty}}"></td>
								<td class="price"><span id="price{{$items->rowid}}">{{number_format($items->price*$items->qty,0,",",".")}}</span> <sup>đ</sup></td>
								<td><a href="{{domain}}/cart-remove/{{$items->rowid}}" class="remove_cart btn btn-danger btn-xs" data-rowid="{{$items->rowid}}"><i class="fa fa-remove"></i></a></td>
							</tr>
							@endforeach
							@endif
							<tr>
								<td colspan="7"><strong>Tổng tiền:</strong> <span id="total_price" style="color:#ff0000">{{Helper::adddotstring(Cart::total())}}</span> <sup>đ</sup></td>
							</tr>
							<tr>
								<td colspan="7">
									<div class="form-group">
										<a href="javascript:void(0)" target="#payment" class="btn btn-success">Thanh toán</a>
										<a href="{{domain}}" class="btn btn-warning">Tiếp tục mua hàng</a>
										<a href="{{url('cart-destroy')}}" class="btn btn-danger">Hủy toàn bộ giỏ hàng</a>
									</div>
								</td>
							</tr>
						{{csrf_field()}}
						</form>
					</table>
				</div>
			</div>
		</div>
		<div id="payment">
			<div class="container">
				<div class="product col-md-12 col-xs-12 text-center">
					<h2>Thông tin giao hàng</h2>
					<div class="line" style="margin-bottom: 30px;"></div>
				</div>
				<form method="post">
					<div class="col-md-8 col-md-offset-2">
						<div class="form-group item">
							<label class="col-md-3 col-xs-3">Họ và tên: (*)</label>
							<div class="col-md-9">
								<input type="text" name="name" class="form-control" required>
							</div>
						</div>
						<div class="form-group item">
							<label class="col-md-3 col-xs-3">Email: (*)</label>
							<div class="col-md-9">
								<input type="text" name="email" class="form-control" required>
							</div>
						</div>
						<div class="form-group item">
							<label class="col-md-3 col-xs-3">Điện thoại: (*)</label>
							<div class="col-md-9">
								<input type="text" name="phone" class="form-control" required>
							</div>
						</div>
						<div class="form-group item">
							<label class="col-md-3 col-xs-3">Địa chỉ nhận hàng (*):</label>
							<div class="col-md-9">
								<input type="text" name="address" class="form-control" required>
							</div>
						</div>
						<div class="form-group item">
							<label class="col-md-3 col-xs-3">Ghi chú:</label>
							<div class="col-md-9">
								<textarea name="note" class="form-control" style="height: 300px"></textarea>
							</div>
						</div>
						<div class="clear"></div>
						<div class="form-group item text-center">
							<input type="submit" name="submit" class="btn btn-primary" value="Thanh toán">
						</div>
					</div>
					{{csrf_field()}}
				</form>
			</div>
		</div>
	</main>
	<script type="text/javascript">
		$(document).ready(function(){
			$('a[target="#payment"]').click(function(){
				var posClick = $(this).attr('target');//lấy giá trị trong thuộc tính href,gắn vào posClick. posClick sẽ có dạng #xxxxx
				var pos = $(posClick).position().top;//lấy khoảng cách từ id #xxxxx tới đầu trang gắn vào pos
				$("[href='"+posClick+"']").addClass("current");//thêm class current vào thẻ có href bằng giá trị trong posClick
				$('html, body').animate({
					scrollTop:pos+20//lăn tới vị trí cách đầu trang 1 khoảng pos + 20 so với đầu trang
				},1000);
			})
			$('input[name="qty"]').change(function(){
				rowId = $(this).attr('data-rowid');
				_token = $('input[name="_token"]').val();
				num = $(this).val();
				url = "{{url('ajax/update-cart')}}/"+rowId+'/'+num;
				select = '#price'+rowId;
				$.ajax({
					url:url,
					cache:false,
					type:'get',
					data:{'rowId':rowId,'num':num},
					success:function(result){
						// obj = JSON.parse(result);
						// $(select).text(obj.items_price);
						// $('#total_price').text(obj.total_price);
						window.location.href = "{{url('shopping-cart')}}";
					}
				});
			})
		})
		$(document).ready(function(){
			$('.remove_cart').click(function(){
				rowId = $(this).attr('data-rowid');
				_token = $('input[name=_token]').val();
				url = "{{url('ajax/remove-cart')}}/"+rowId;
				$.ajax({
					url:url,
					cache:false,
					type:'get',
					data:{'rowId':rowId,'_token':_token},
					success:function(result){
						$('#table-cart').html(result);
					}
				});
			})
		})
	</script>
@stop