@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Add Divan</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-plus"></i> Add New Divan</h4>
		<form class="form-horizontal style-form" method="post" action="/add-divanDB" enctype="multipart/form-data">
			{{ csrf_field() }}

			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">title</label>
				<div class="col-sm-10">
					<input name="title" type="text" class="form-control" required placeholder="enter title">
				</div>
            </div>
			<div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Divan Type</label>
                <div class="col-sm-10">
                    <select class="form-control" name="divan_type_id" onChange="setTypeDivin(this)">
                        <option value="">Choose Onece</option>
                        @foreach($types as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>	
			<div class="form-group" id="code" style="display:none">
				<label class="col-sm-2 col-sm-2 control-label">Code</label>
				<div class="col-sm-10">
					<input name="code"  type="text" class="form-control" value="15485-A">
				</div>
            </div>

            <div class="form-group" id="note" style="display:none">
                <label class="col-sm-2 col-sm-2 control-label">description</label>
                <div class="col-sm-10">
                    <textarea name="description"  type="text" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group" id="description" style="display:none">
                <label class="col-sm-2 col-sm-2 control-label">Body</label>
                <div class="col-sm-10">                  
                    <textarea class="ckeditor" name="body" id="body" required></textarea>
                </div>
            </div>
            <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
            <!-- script for ck editor -->
            <script>
                CKEDITOR.replace('body');
                CKEDITOR.add      
            </script>  
            
            <div class="form-group last">
                <label class="control-label col-sm-2 col-sm-2 control-label">Files</label>
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