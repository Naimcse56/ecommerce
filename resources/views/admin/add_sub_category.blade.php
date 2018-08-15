@extends('admin_layout')
@section('admin_content')

<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="#">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add Sub Category</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Sub Category</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<p class="alert-success">
					<?php
					$message=Session::get('message');
						if($message){
						echo $message;
						Session::put('message', null);
						}
					?>
					</p>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/save-Sub_Category')}}" method="post">
						{{ csrf_field() }}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="date01">Sub Category Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="sub_category_name" required>
							  </div>
							</div>  
							     
							<div class="control-group">
								<label class="control-label" for="selectError3">Parent Category</label>
								<div class="controls">
								<?php
                            	$all_published_category = DB::table('tbl_category')
                                ->where('publication_status', 1)
                                ->get(); ?>
								  <select id="selectError3" name="category_id" required>
								  	<option>Select one</option>
								  	@foreach($all_published_category as $v_category)
									<option value="{{$v_category->category_id}}">{{$v_category->category_name}}</option>@endforeach
								  </select>
								</div>
								
							  </div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Publication Status</label>
							  <div class="controls">
								<input type="checkbox" name="publication_status" value="1">
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Sub Category</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div>

@endsection