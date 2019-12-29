@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Edit Category</h3>
<div class="col-lg-12">
  @if ($errors->has('message'))
      <div class="alert {{ $errors->first('class') }}">
           {{ $errors->first('message') }}
      </div>
  @endif
  <div class="form-panel">
    <h4 class="mb"><i class="fa fa-pencil"></i> Edit {{$category->name}}</h4>
    <form class="form-horizontal style-form" method="post" action="update">
     {{ csrf_field() }}
     <div class="form-group">
      <label class="col-sm-2 col-sm-2 control-label">Sub Of</label>
      <div class="col-sm-10">
        <select class="form-control" name="parent">
          <option value="0">Root</option>
          @foreach($categories as $one)
          <option value="{{$one->id}}"
            @if($one->id == $category->parent)
            {{"selected"}}
            @endif
            >{{$one->name}}</option>
            @endforeach 
          </select>
        </div>
      </div>  
      <br>
      @foreach($languages as $lang)
      <div class="form-group x">
        <label class="col-sm-2 col-sm-2 control-label">{{ $lang->name }} Name</label>
        <div class="col-sm-10">
          <input value="@if($category->getTranslation($lang->id) != null){{$category->getTranslation($lang->id)->name}}@else{{ ' ' }}@endif" name="name{{$lang->id}}" type="text" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">{{ $lang->name }} Description</label>
        <div class="col-sm-10">
          <input value="@if($category->getTranslation($lang->id) != null){{$category->getTranslation($lang->id)->description}}@else{{ ' ' }}@endif" name="description{{$lang->id}}" type="text" class="form-control">
        </div>
      </div>
      <br>
      @endforeach

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