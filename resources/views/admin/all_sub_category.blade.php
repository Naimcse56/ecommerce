@extends('admin_layout')
@section('admin_content')

<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="#">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>
				<p class="alert-success">
				<?php
					$message=Session::get('message');
						if($message){
						echo $message;
						Session::put('message', null);
						}
					?>
				</p>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Sub Category ID</th>
								  <th>Sub Category Name</th>
								  <th>Category Id</th>
								  <th>Publication Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead> 
						  @foreach($all_sub_category_info as $v_subCat)  
						  <tbody>
							<tr>
								<td>{{ $v_subCat->id }}</td>
								<td class="center">{{ $v_subCat->sub_category_name }}</td>
								<td class="center">{{ $v_subCat->category_id }}</td>

								<td class="center">
								@if($v_subCat->publication_status ==1)
									<span class="label label-success">Active</span>
								@else
									<span class="label label-danger">Deactive</span>
								@endif
								</td>

								<td class="center">

									@if($v_subCat->publication_status ==1)
									<a class="btn btn-danger" href="{{URL::to('/unactive_subCat/'.$v_subCat->id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
									@else
									<a class="btn btn-success" href="{{URL::to('/active_subCat/'.$v_subCat->id)}}">
										<i class="halflings-icon white thumbs-up"></i>  
									</a>
									@endif
									
									<a class="btn btn-danger" href="{{URL::to('/delete_subCat/'.$v_subCat->id)}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						  </tbody>
						  @endforeach
					  </table>            
					</div>
				</div><!--/span-->
			
			</div>

@endsection