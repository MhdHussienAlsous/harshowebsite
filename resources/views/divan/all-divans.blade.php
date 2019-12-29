@extends('content.dashboard')

@section('content')

<h3><i class="fa fa-angle-right"></i> All Divans</h3>
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
          <h4><i class="fa fa-th-list"></i> Divans Table</h4>
          <hr>
          <thead>
            <tr>
              <th><i class="fa fa-bookmark"></i> Title</th>
              <th><i class="fa fa-question-circle"></i> Description</th>
              <th><i class="fa fa-question-circle"></i> Type</th>
              <th><i class="fa fa-question-circle"></i> Code</th>
              <th><i class="fa fa-calendar"></i> Date</th>
              <th ><i class="fa fa-user"></i> User</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($divans as $divan)
            <tr>
                <td>{{ $divan->title }}</td>
                <td>{{ strip_tags(html_entity_decode($divan->description)) }}</td>
                <td>{{ $divan->type->name }}</td>
                <td>{{ $divan->code }}</td>
                <td>{{ $divan->created_at }}</td>
                <td>{{ $divan->person->name }}</td>
            <td>
              @permission('update-item')
                <a href="/divan/{{ $divan->id }}/show" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
              @endpermission
              @permission('delete-item')
                <a href="/divan/{{ $divan->id }}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
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