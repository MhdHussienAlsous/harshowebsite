@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Add new Offer</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-plus"></i> Add  Offer</h4>
		<form class="form-horizontal style-form" method="post" action="/addOfferDB" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Sub Of</label>
				<div class="col-sm-10">
					<select class="form-control" name="type" required>
						<option value="">choose type</option>
						<option value="h">horizontall offer image (أفقية)</option>
						<option value="v">vertical offer image (عمودية)</option>
					</select>
				</div>
			</div>	
            <div class="form-group last">
                <label class="control-label col-sm-2 col-sm-2 control-label">Offer image</label>
                <div class="col-md-10">
                    <div class="fileupload fileupload-new input-group" data-provides="fileupload"><input type="hidden">
                        <div class="form-control" data-trigger="fileupload">
                            <input type="file" name="file" >
                        </div>
                    </div>
                </div>
            </div>
			
			
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">website URL</label>
				<div class="col-sm-10">
					<input name="website" type="text" class="form-control" placeholder="enter website url">
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