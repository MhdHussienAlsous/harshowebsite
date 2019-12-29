@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Add Tag</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-plus"></i> Add New Tag</h4>
		<form class="form-horizontal style-form" method="post" action="/add-tagDB">
			{{ csrf_field() }}

	
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label" >Name</label>
				<div class="col-sm-10">
					<input name="name" type="text" required class="form-control">
				</div>
			</div>	                	                
	
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