@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Add Phone Number</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-plus"></i> Add New Phone Number</h4>
		<form class="form-horizontal style-form" method="post" action="/add-phoneDB" enctype="multipart/form-data">
			{{ csrf_field() }}

			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">name</label>
				<div class="col-sm-10">
					<input name="name" type="text" class="form-control" required placeholder="enter name">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Employee Type</label>
				<div class="col-sm-10">
					<input name="employee_type" type="text" class="form-control" required placeholder="enter employee type">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Company</label>
				<div class="col-sm-10">
					<input name="company" type="text" class="form-control" required placeholder="enter company name">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Fax</label>
				<div class="col-sm-10">
					<input name="fax" type="text" class="form-control"  placeholder="enter fax number">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input name="email" type="text" class="form-control" placeholder="enter email address">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Mobile Number</label>
				<div class="col-sm-10">
					<input name="mobile" type="text" class="form-control" required placeholder="enter mobile number">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
				<div class="col-sm-10">
					<input name="phone" type="text" class="form-control" required placeholder="enter phone number">
				</div>
            </div>

            <div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Notes</label>
				<div class="col-sm-10">
					<textarea name="notes" class="form-control" placeholder="enter extra infromation"></textarea>
				</div>
            </div>
            
            
            <div class="form-group last">
                <label class="control-label col-sm-2 col-sm-2 control-label">Images</label>
                <div class="col-md-10">
                    <div class="fileupload fileupload-new input-group" data-provides="fileupload"><input type="hidden">
                        <div class="form-control" data-trigger="fileupload">
                            <input type="file" name="files[]" multiple="">
                        </div>
                    </div>
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