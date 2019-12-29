@extends('content.dashboard')

@section('content')

<h3><i class="fa fa-angle-right"></i> Edit Item</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
	<div class="alert {{ $errors->first('class') }}">
		{{ $errors->first('message') }}
	</div>
	@endif
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-plus"></i> Edit Item</h4>
		<form class="form-horizontal style-form" method="post" action="update">
			<div class="shared-info">
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Category</label>
					<div class="col-sm-10">
						<select class="form-control" name="category_id">
							@foreach($categories as $one)
							<option value="{{$one->id}}"
								@if($one->id == $item->category_id)
								{{"selected"}}
								@endif
								>{{$one->name}}</option>
								@endforeach	
							</select>
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
							<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
							<input type="hidden" name="lang" value="{{$lang->id}}">
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Introduction</label>
								<div class="col-sm-10">
									<input value="@if($item->getTranslation($lang->id) != null){{$item->getTranslation($lang->id)->introduction}}@else{{ ' ' }}@endif" name="introduction{{$lang->id}}" type="text" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Title</label>
								<div class="col-sm-10">
									<input value="@if($item->getTranslation($lang->id) != null){{$item->getTranslation($lang->id)->title}}@else{{ ' ' }}@endif" name="title{{$lang->id}}" type="text" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Body</label>
								<div class="col-sm-10">                  
									<textarea class="ckeditor" name="body{{$lang->id}}" id="body{{$lang->id}}">
										@if($item->getTranslation($lang->id) != null){{$item->getTranslation($lang->id)->body}}@else{{ ' ' }}@endif
									</textarea>
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
									<input 
									@foreach($item->tags as $tagg)
										@if($tagg->id == $tag->id)
											{{ "checked" }}
										@endif
									@endforeach									
									type="checkbox" 
									value="{{$tag->id}}" 
									name="tags[]">
									{{  $tag->name }}
								</label>
							</div>
							@endforeach			            	
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Notes</label>
					<div class="col-sm-10">
						<textarea name="private_notes{{$lang->id}}"  style="resize: vertical;" class="form-control">@if($item->getTranslation($lang->id) != null){{$item->getTranslation($lang->id)->private_notes}}@else{{ ' ' }}@endif</textarea>
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
		</div> <!-- <div class="form-panel"> -->
	</div>  <!-- col-lg-12-->

	<div class="col-md-12">
		<div class="content-panel">
			<table class="table table-striped table-advance table-hover">
				<h4><i class="fa fa-th-list"></i> Files Attached</h4>
				<hr/>
				<thead>
					<tr>
					<th><i class="fa fa-bookmark"></i> # </th>
					<th><i class="fa fa-question-circle"></i> File Name</th>
					<th ><i class="fa fa-eye"></i> Download</th>
					</tr>
				</thead>
				<tbody>
				@php $i=1; @endphp
					@foreach($files as $files)
					<tr>
					<td>{{$i}}</td>
					<td>
						{{ $files->name }}
					</td>      
					<td>
						<a href="/files/{{ $files->name }}" class="btn btn-primary btn-xs"><i class="fa fa-download"></i> download</a>
					</td>
					@php $i++; @endphp
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
    	<!-- /content-panel -->
  	</div>



	
		@stop




