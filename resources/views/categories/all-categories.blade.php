@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> All Categories</h3>
<div class="col-lg-12">
 <!-- row -->
 <div class="row mt">
  <div class="col-md-12">
    @if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif
    <div class="content-panel">
      <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-th-list"></i> Categories Table</h4>
        <hr>
        <thead>
          <tr>
            <th><i class="fa fa-bookmark"></i> Name</th>
            <th class="hidden-phone"><i class="fa fa-question-circle"></i> Descrition</th>
            <th><i class=" fa fa-edit"></i> Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>{{$category->name}}</td>
            <td class="hidden-phone">{{$category->description}}</td>
            @php
            $class_color = '';
            $name   = '';
            if($category->is_root()){
            $class_color = 'label-danger';
            $name   = 'Root';
          } else {
          $class_color = 'label-success';
          $name   = 'Leaf';
        }
        @endphp
        <td>
          <span class="label {{ $class_color }} label-mini">
            {{ $name }}
          </span>
        </td>
        <td>
          @permission('update-category')
          <a href="category/{{$category->id}}/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
          @endpermission
          @permission('delete-category')
          <a href="all-categories/{{$category->id}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
          @endpermission
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- /content-panel -->
</div>
<!-- /col-md-12 -->
</div>
<!-- /row -->
</div>
<!-- col-lg-12-->

@stop