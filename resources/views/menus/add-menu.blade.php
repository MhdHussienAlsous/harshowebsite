@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Add Menu</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-plus"></i> Add New Menu</h4>
		<form class="form-horizontal style-form" method="post" action="/add-menuDB">
			{{ csrf_field() }}
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Sub Of</label>
				<div class="col-sm-10">
					<select class="form-control" name="parent" required>
						<option value="0">Root</option>
						@foreach($menus as $menu)
						<option value="{{$menu->id}}">{{$menu->name}}</option>
						@endforeach
					</select>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Category</label>
				<div class="col-sm-10">
					<select class="form-control" name="category_id" required>
						<option value="">Choose one</option>
						@foreach($categories as $category)
						<option value="{{$category->id}}">{{$category->name}}</option>
						@endforeach
					</select>
				</div>
			</div>	

			@foreach($languages as $lang)
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label"> Name</label>
				<div class="col-sm-10">
					<input name="name{{ $lang->id }}" type="text" required class="form-control">
				</div>
			</div>	                	                
			@endforeach
			<div class="div-btn">
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</div>		                	
			</div>

		</form>
	</div>
</div>
<!-- col-lg-12-->

@stop