@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Add Phone Notes</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-plus"></i> Add {{$phone->name}} Notes</h4>
		<form class="form-horizontal style-form" method="post" action="/phone/{{$phone->id}}/store-notes" enctype="multipart/form-data">
			{{ csrf_field() }}
            <input type="hidden" value="{{$phone->id}}" />
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">title</label>
				<div class="col-sm-10">
					<input name="title" type="text" class="form-control" placeholder="enter tilte">
				</div>
            </div>
            
            <div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Notes</label>
				<div class="col-sm-10">
					<textarea name="note" class="form-control" placeholder="enter notes about call"></textarea>
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