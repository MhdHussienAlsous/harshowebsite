@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Add User</h3>
<div class="col-lg-12">
	<!-- start div message success -->
	@if(session()->has('message'))
		<div class="alert alert-success">
			{{ session()->get('message') }}
		</div>
	@endif 
	<!-- end div message success -->
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-plus"></i> Edit {{ $user->person->name }}</h4>
		<form class="form-horizontal style-form" enctype="multipart/form-data" method="post" action="update">
			{{ csrf_field() }}
			<div class="form-group x ">
				<label class="col-sm-2 col-sm-2 control-label">Full Name</label>
				<div class="col-sm-10">
					<input value="{{ $user->person->name }}" name="name" type="text" class="form-control">
					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif	                    
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input value="{{ $user->email }}" name="email" type="email" class="form-control">
					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif		                    
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Password</label>
				<div class="col-sm-10">
					<input name="password" type="password" class="form-control">
					@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
					@endif		                    
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Birthday</label>
				<div class="col-sm-3">
					<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="01-01-2014" class="input-append date dpYears">
						<input value="{{ $user->person->birthday }}" type="text" size="16" class="form-control" name="birthday">	                      
						<span class="input-group-btn add-on">
							<button class="btn btn-theme" type="button"><i class="fa fa-calendar"></i></button>
						</span>
						@if ($errors->has('birthday'))
						<span class="help-block">
							<strong>{{ $errors->first('birthday') }}</strong>
						</span>
						@endif		                        
					</div>			                        
				</div>
			</div>
			<div class="form-group last">
				<label class="control-label col-sm-2 col-sm-2 control-label">Image</label>
				<div class="col-md-10">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<img src="{{ url($user->person->image) }}" alt="" />
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						<div>
							<span class="btn btn-theme02 btn-file">
								<span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
								<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
								<input type="file" class="default" name="image" />
							</span>
						</div>
					</div>
					@if ($errors->has('image'))
					<span class="help-block">
						<strong>{{ $errors->first('image') }}</strong>
					</span>
					@endif	                    
				</div>		                  
			</div>	
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label"> Role</label>
				<div class="col-sm-3">
					<select id="roles" class="roles form-control" name="role">
						<option {{ $admin_selected }} value="0">Admin</option>
						<option {{ $moderator_selected }} value="1">Moderator</option>
					</select>
					<div id="permissions" 
					style="
					@if($admin_selected == "selected") 
					{{ "display:none;"}}
					@endif">
					@foreach($permissions as $permission)

					<div class="checkbox">
						<label>
							<input 
							@foreach($user_permissions as $perm)
							@if($perm == $permission->id)
							{{ "checked" }}
							@endif
							@endforeach
							type="checkbox" 
							value="{{$permission->id}}" 
							name="permissions[]">
							{{  $permission->display_name }}
						</label>
					</div>
					@endforeach			            	
				</div>
			</div>
		</div>   	                                    
		<div class="div-btn">
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label"></label>
				<div class="col-sm-10">
					<input type="submit" class="btn btn-success" value="Edit">
				</div>
			</div>		                	
		</div>
	</form>
</div>
</div>
<!-- col-lg-12-->
@stop