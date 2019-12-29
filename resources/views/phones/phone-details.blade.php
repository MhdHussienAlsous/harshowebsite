@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Show Phone Number</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif
	<div class="form-panel">
    <h4 class="mb"><i class="fa fa-plus"></i> Show {{$phone->name}} All Information</h4>
		<form class="form-horizontal style-form" method="post" action="/add-phoneDB">
			{{ csrf_field() }}
			<div class="div-btn">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                    <a href="/phone/{{$phone->id}}/add-notes" class="btn btn-warning">Add Note About Person +</a>
                    </div>
                </div>		                	
            </div>

			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">name</label>
				<div class="col-sm-10">
                <input disabled type="text" class="form-control" value="{{$phone->name}}" />
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Employee Type</label>
				<div class="col-sm-10">
					<input  disabled type="text" class="form-control" value="{{$phone->employee_type}}" />
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Company</label>
				<div class="col-sm-10">
					<input disabled type="text" class="form-control" value="{{$phone->company}}" />
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Fax</label>
				<div class="col-sm-10">
					<input  disabled type="text" class="form-control" value="{{$phone->fax}}" />
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input disabled type="email" class="form-control" value="{{$phone->email}}" />
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Mobile Number</label>
				<div class="col-sm-10">
					<input  disabled type="text" class="form-control" value="{{$phone->mobile}}" />
				</div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
				<div class="col-sm-10">
					<input  disabled type="text" class="form-control" value="{{$phone->phone}}" />
				</div>
            </div>

            <div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Notes</label>
				<div class="col-sm-10">
					<textarea style="resize: vertical;"  disabled class="form-control">{{$phone->notes}}</textarea>
				</div>
            </div>
            
		</form>
	</div>
</div>
<!-- col-lg-12-->


<div class="col-md-12">
    <div class="form-panel">
        <table class="table table-striped table-advance table-hover">
            <h4 style="color: brown"><i class="fa fa-file"></i> Files Attached</h4>
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
                </td>
                @php $i++; @endphp
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /content-panel -->
</div>
<br/><br/><br/>

<div class="col-lg-12">
    <div class="form-panel">
        <table class="table table-striped table-advance table-hover">
            <h4 style="color:green"><i class="fa fa-sticky-note"></i> Notes About This Phone</h4>
            <hr/>
            <thead>
                <tr>
                <th><i class="fa fa-bookmark"></i> # </th>
                <th><i class="fa fa-question-circle"></i> title</th>
                <th ><i class="fa fa-eye"></i> note</th>
                <th ><i class="fa fa-eye"></i> Person Name</th>
                <th ><i class="fa fa-eye"></i> Date </th>


                </tr>
            </thead>
            <tbody>
            @php $i=1; @endphp
                @foreach($phone->phoneLog as $log)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{ $log->title }}</td>      
                    <td>{{ $log->note }}</td>      
                    <td>{{ $log->person->name }}</td>      
                    <td>{{ $log->created_at }}</td>      
                    @php $i++; @endphp
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- col-lg-12-->

@stop