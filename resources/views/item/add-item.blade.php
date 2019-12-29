@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Add Item</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif 
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-plus"></i> Add New Item</h4>
		<form class="form-horizontal style-form" method="post" action="/add-itemDB" enctype="multipart/form-data">
			<div class="shared-info">
				<div class="form-group">
					<label class="type col-sm-2 col-sm-2 control-label">Type</label>
					<div class="col-sm-10">
						<select id="type" class="form-control" name="type_id" onChange="setTypeItem(this)" required>
							<option value="">Choose Type</option>
							@foreach($types as $type)
							<option value="{{$type->id}}">{{$type->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Category</label>
					<div class="col-sm-10">
						<select id="category" class="category form-control" name="category_id" required>
							<option value="">Choose Category</option>
							@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="image">
					<div class="form-group last">
						<label class="control-label col-sm-2 col-sm-2 control-label">Image</label>
						<div class="col-md-10">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
									<img src="https://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
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
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 col-sm-2 control-label">Image Title</label>
						<div class="col-sm-10">
							<input name="image_title" type="text" class="form-control">
						</div>
					</div>
				</div>
<!-- multiple images
				<div class="image">
					<div class="form-group last">
						<label class="control-label col-sm-2 col-sm-2 control-label">Image</label>
						<div class="col-md-10">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
									<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
								<div>
									<span class="btn btn-theme02 btn-file">
										<span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
										<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
										<input type="file" class="default" name="images[]" multiple />
									</span>
								</div>
							</div>


						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 col-sm-2 control-label">Image Title</label>
						<div class="col-sm-10">
							<input name="image_title" type="text" class="form-control">
						</div>
					</div>
				</div>
-->
				<div class="form-group  url">
					<label class="col-sm-2 col-sm-2 control-label">URL</label>
					<div class="col-sm-10">
						<input name="url" type="text" class="form-control">
					</div>
				</div>		              		
			</div><!--  <div class="shared-info"> -->

				<div class="none-shared-info">
					<ul class="nav nav-tabs">
						@php 
						$i = 0;
						$len = count($languages);
						foreach($languages as $lang)
						{
							if ($i == 0) {
							echo '<li class="active"><a data-toggle="tab" href="#'.$lang->name.'">'. $lang->name.'</a></li>';  
						} else {
						echo '<li><a data-toggle="tab" href="#'.$lang->name.'">'. $lang->name .'</a></li>';    
					}
					$i++;
				}
				@endphp
			</ul>
			
			<div class="tab-content">
				@foreach($languages as $lang)
				<div id="{{$lang->name}}" class="tab-pane fade in 
					@if ($loop->first)	
					{{ 'active' }}
					@endif ">
					<div class="form-horizontal style-form">
						{{ csrf_field() }}

						<input type="hidden" name="person_id" value="{{ Auth::user()->person->id }}">

						<input type="hidden" name="lang" value="{{$lang->id}}">



						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Title</label>
							<div class="col-sm-10">
								<input name="title{{$lang->id}}" type="text" class="form-control" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Introduction</label>
							<div class="col-sm-10">
								<input name="introduction{{$lang->id}}" type="text" class="form-control" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Body</label>
							<div class="col-sm-10">                  
								<textarea class="ckeditor" name="body{{$lang->id}}" id="body{{$lang->id}}" required></textarea>
							</div>
						</div>

						<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
						<!-- script for ck editor -->
						<script>
							CKEDITOR.replace('body{{$lang->id}}');
							CKEDITOR.add      
						</script>                        
					</div>
				</div>
				@endforeach
			</div>
		</div> <!-- <div class="none-shared-info"> -->

			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label"> Tag</label>
				<div class="col-sm-3">
					<div id="tags">
						@foreach($tags as $tag)
						<div class="checkbox">
							<label>
								<input type="checkbox" value="{{$tag->id}}" name="tags[]">
								{{  $tag->name }}
							</label>
						</div>
						@endforeach			            	
					</div>
				</div>
			</div>


			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label"> Related Writer Posts</label>
				<div class="col-sm-3">
					<div id="tags">
						<div class="checkbox">
							<label>
								<input type="checkbox"  name="related">
								enable
							</label>
						</div>		            	
					</div>
				</div>
			</div>
			<div class="images">
				<div class="form-group last">
					<label class="control-label col-sm-2 col-sm-2 control-label">files</label>
					<div class="col-md-10">
						<div class="fileupload fileupload-new input-group" data-provides="fileupload">
							<div class="form-control" data-trigger="fileupload">
								<input type="file" name="files[]" multiple>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Notes</label>
				<div class="col-sm-10">
					<textarea name="private_notes{{$lang->id}}"  style="resize: vertical;" class="form-control"></textarea>
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
	</div> <!-- <div class="form-panel"> -->
	</div>  <!-- col-lg-12-->
	@stop