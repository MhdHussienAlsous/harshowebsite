@extends('content.dashboard')
@section('content')
<h3><i class="fa fa-angle-right"></i> All Users</h3>
<div class="col-lg-12">
  <!-- start div message success -->
  @if(session()->has('message'))
    <div class="alert alert-success">
      {{ session()->get('message') }}
    </div>
  @endif 
  <!-- end div message success -->
<div class="row mt">
  <div class="col-md-12">
    <div class="content-panel">
      <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-users"></i> Users Table</h4>
        <hr>
        <thead>
          <tr>
            <th><i class="fa fa-bookmark"></i> Name</th>
            <th class="hidden-phone"><i class="fa fa-envelope"></i> Email</th>
            <th><i class="fa fa-calendar"></i> Join</th>

            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)    		
          <tr>
            <td>
              {{ $user->person->name }}
            </td>
            <td class="hidden-phone">{{ $user->email }}</td>
            <td> {{ $user->created_at }} </td>

            <td>
             <div class="form-inline">
              @permission('update-user')
              <a href="/user/{{ $user->id }}/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
              @endpermission
              @permission('delete-user')
              <a href="all-users/{{ $user->id}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
              @endpermission
            </div>
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
@stop