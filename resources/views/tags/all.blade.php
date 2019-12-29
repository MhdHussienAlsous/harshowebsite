@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> All Tags</h3>
<div class="col-lg-12">
@if ($errors->has('message'))
    <div class="alert {{ $errors->first('class') }}">
         {{ $errors->first('message') }}
    </div>
@endif
 <!-- row -->
 <div class="row mt">
  <div class="col-md-12">
    <div class="content-panel">
      <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-th-list"></i> Tag Table</h4>
        <hr>
        <thead>
          <tr>
            <th><i class="fa fa-bookmark"></i> Name</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($tags as $tag)
          <tr>
            <td>{{ $tag->name }}</td>
          <td>
            @permission('update-tag')
            <a href="tag/{{$tag->id}}/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
            @endpermission
            @permission('delete-tag')
            <a href="all-tags/{{$tag->id}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
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