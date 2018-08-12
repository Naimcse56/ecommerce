@extends('layout')
@section('content')


<section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
			<?php
				$contents=Cart::content();
				//echo "<pre>";
				//print_r($contents);
				//echo "</pre>";
			?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>

						<?php foreach($contents as $v_content) { ?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to($v_content->options->image)}}" alt="" style="height: 80px; width: 80px;"></a>
							</td>
							<td class="cart_description">
								<h4><a href="#">Your Product</a></h4>
								<p>{{$v_content->name}}</p>
							</td>
							<td class="cart_price">
								<p>{{$v_content->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{url('/update-cart')}}" method="post">
									{{ csrf_field() }}
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->quantity}}" autocomplete="off" size="2">
									<input type="hidden" name="rowId" value="{{$v_content->rowId}}" autocomplete="off" size="2">
									<input type="submit" name="submit" value="Update" class="btn btn-xs btn-default">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$v_content->total}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" style="border-style: solid;" href="{{URL::to('/delete-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php } ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
<section id="do_action">
	<div class="container">
		<div class="heading">
			<h3>What would you like to do next?</h3>
			<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
		</div>
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Payment method</li>
			</ol>
		</div>
		<div class="paymentCont col-sm-9">
					<div class="headingWrap">
							<h3 class="headingTop text-center">Select Your Payment Method</h3>	
							<p class="text-center">Created with bootsrap button and using radio button</p>
					</div>
					<div class="paymentCont col-sm-4">
					<form action="{{url('/order_place')}}" method="post">
					{{csrf_field()}}
						<input type="radio" name="payment_method" value="handcash"><b> Hand Cash</b><hr>
				  		<input type="radio" name="payment_method" value="card"><b> Debit Card</b><hr>
				  		<input type="radio" name="payment_method" value="paypal"><b> Paypal</b><hr>
				  		<input type="submit" name="" value="Done">
					</form>
					</div>
		</div>
</section><!--/#do_action-->


@endsection