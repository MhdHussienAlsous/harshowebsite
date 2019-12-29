@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> All Phones</h3>
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
        <h4><i class="fa fa-th-list"></i> Menus Table</h4>
        <hr>
        <thead>
          <tr>
            <th><i class="fa fa-bookmark"></i> Name</th>
            <th><i class="fa fa-bars"></i> Company</th>
            <th><i class="fa fa-address-card"></i> Employee Type</th>
            <th><i class="fa fa-mobile"></i> Mobile Number</th>
            <th><i class="fa fa-phone"></i> Phone Number</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($phones as $phone)
        <tr>
            <td>{{ $phone->name }}</td>
            <td>{{ $phone->company }}</td>
            <td>{{ $phone->employee_type }}</td>
            <td>{{ $phone->mobile }}</td>
            <td>{{ $phone->phone }}</td>
            <td>
                <a href="phone/{{$phone->id}}/show" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                @permission('update-menu')
                <a href="phone/{{$phone->id}}/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                @endpermission
                @permission('delete-menu')
                <a href="phone/{{$phone->id}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
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