@extends('content.dashboard')

@section('content')

     <h3><i class="fa fa-angle-right"></i> Switsh Template</h3>

            <div class="col-lg-12">
	            <div class="form-panel">
	              <h4 class="mb"><i class="fa fa-plus"></i> Add New Field</h4>
	              <form class="form-horizontal style-form" method="post" action="/template">
	              	 {{ csrf_field() }}

			        <div class="form-group">
				         <label class="col-sm-2 col-sm-2 control-label">Template</label> 
				         <div class="col-sm-10">
				         	@foreach($templates as $template)       
					          <div class="radio">
				                <label>
				                  <input type="radio" name="template" id="optionsRadios1" value="{{ $template->id }}" 
			  						@if($template->active == 1)
				                  		{{ "checked" }}
				                  	@endif
				                  >
				                  <img style="height: 250px; border:1px solid #eee; width: 200px;" class="img-responsive" src="{{ asset('upload/'.$template->name.'.png') }}">
				                  </label>
				              </div>
				              <br>
				            @endforeach  
			             </div>
		            </div>


	                <div class="div-btn">
		                <div class="form-group">
		                  <label class="col-sm-2 col-sm-2 control-label"></label>
		                  <div class="col-sm-10">
		                     <input type="submit" class="btn btn-success" value="Switch">
		                  </div>
		                </div>		                	
	                </div>
	                                	                
	              </form>
	            </div>
          </div>
          <!-- col-lg-12-->

@stop