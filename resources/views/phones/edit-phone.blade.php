@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Edit Phone Number</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif
	<div class="form-panel">
    <h4 class="mb"><i class="fa fa-plus"></i> Edit {{$phone->name}} Information</h4>
    <form class="form-horizontal style-form" method="post" action="/phone/{{$phone->id}}/update">
			{{ csrf_field() }}

			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">name</label>
				<div class="col-sm-10">
                <input name="name" type="text" class="form-control" value="{{$phone->name}}" placeholder="enter name">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Employee Type</label>
				<div class="col-sm-10">
					<input name="employee_type" type="text" class="form-control" value="{{$phone->employee_type}}" placeholder="enter employee type">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Company</label>
				<div class="col-sm-10">
					<input name="company" type="text" class="form-control" value="{{$phone->company}}" placeholder="enter company name">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Fax</label>
				<div class="col-sm-10">
					<input name="fax" type="text" class="form-control" value="{{$phone->fax}}" placeholder="enter fax number">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input name="email" type="email" class="form-control" value="{{$phone->email}}" placeholder="enter email address">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Mobile Number</label>
				<div class="col-sm-10">
					<input name="mobile" type="text" class="form-control" value="{{$phone->mobile}}" placeholder="enter mobile number">
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
				<div class="col-sm-10">
					<input name="phone" type="text" class="form-control" value="{{$phone->phone}}" placeholder="enter phone number">
				</div>
            </div>

            <div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Notes</label>
				<div class="col-sm-10">
					<input name="notes" type="text" class="form-control" value="{{$phone->notes}}" placeholder="enter extra infromation">
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
	</div>
</div>
<!-- col-lg-12-->

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
                    <a target="_blank" href="/phones/{{ $files->name }}" class="btn btn-primary btn-xs"><i class="fa fa-download"></i></a>
                    <a href="/phones/{{ $files->name }}" class="btn btn-danger btn-xs"><i class="fa fa-close"></i></a>
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