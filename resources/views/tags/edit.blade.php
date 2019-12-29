@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Edit Tag</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-plus"></i> Edit {{ $tag->name }}</h4>
		<form class="form-horizontal style-form" method="post" action="update">
			{{ csrf_field() }}

	
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
					<input name="name" value="{{ $tag->name }}" required type="text" class="form-control">
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