@extends('layout')
@section('content')

<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to($product_by_details->product_image)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$product_by_details->product_name}}</h2>
								<p>Color: {{$product_by_details->product_color}}</p>
								<img src="{{URL::to('frontend/images/product-details/rating.png')}}" alt="" />
								<span>
									<span>{{$product_by_details->product_price}} Tk</span>
								<form action="{{url('/add-to-cart')}}" method="post">
								{{ csrf_field() }}
									<label>Quantity:</label>
									<input name="quantity" type="text" value="1" />
									<input type="hidden" name="product_id" value="{{$product_by_details->product_id}}">
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</form>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b>  {{$product_by_details->manufacture_name}}</p>
								<p><b>Category:</b>  {{$product_by_details->category_name}}</p>
								<p><b>Size:</b>  {{$product_by_details->product_size}}</p>
								
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->


					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Details</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
								<li><a href="#tag" data-toggle="tab">Tag</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details">
								<p>{{$product_by_details->product_long_description}}</p>
							</div>
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{URL::to('frontend/images/home/gallery1.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="tag" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{URL::to('frontend/images/home/gallery1.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php			
							$product_comment = DB::table('tbl_products')
                            ->join('tbl_comment','tbl_products.product_id','=','tbl_comment.product_id')
                            ->select('tbl_products.*','tbl_comment.product_comment','tbl_comment.com_name','tbl_comment.created_at')
                            ->where('tbl_products.product_id', $product_by_details->product_id)
                            ->paginate(7);
                            ?>
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
								@foreach($product_comment as $product_details)
									<ul>
										<li><a href=""><i class="fa fa-user"></i>{{$product_details->com_name}}</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>{{$product_details->created_at}}</a></li>
										<p><i class="fa fa-fighter-jet"></i> {{$product_details->product_comment}}</p>
									</ul>
								@endforeach	
								{{$product_comment->links()}}


									<p><b>Write Your Review Here</b></p>
									
									<form action="{{url('/addcomment')}}" method="post">
									{{ csrf_field() }}
										<span>
											<input type="text" name="com_name" placeholder="Your Name" required />
											<input type="hidden" name="product_id" value="{{$product_by_details->product_id}}" required /> 
											<textarea name="product_comment" placeholder="Your Comment" required=""></textarea>
										</span>
											
										<b>Rating: </b> <img src="{{URL::to('frontend/images/product-details/rating.png')}}" alt="" />
										<button type="submit" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->






					<div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">Similar items</h2>
                        
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">


                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{URL::to('frontend/images/home/recommend3.jpg')}}" alt=""/>
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{URL::to('frontend/images/home/recommend2.jpg')}}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{URL::to('frontend/images/home/recommend3.jpg')}}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">  
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{URL::to('frontend/images/home/recommend1.jpg')}}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{URL::to('frontend/images/home/recommend2.jpg')}}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{URL::to('frontend/images/home/recommend3.jpg')}}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>          
                        </div>
                    </div><!--/recommended_items-->



@endsection