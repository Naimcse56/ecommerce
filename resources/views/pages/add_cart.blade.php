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
			<div class="row">
				
				<div class="col-sm-8">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>{{Cart::subtotal()}}</span></li>
							<li>Tax <span>{{Cart::tax()}}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>{{Cart::total()}}</span></li>
						</ul>
						<?php 
                            $customer_id = Session::get('customer_id');
                        ?>
                         @if($customer_id != NULL)
                            <li><a class="btn btn-default check_out" href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                         @else
                            <li><a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                         @endif

					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->




@endsection