@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> Add Divan</h3>
<div class="col-lg-12">
	@if ($errors->has('message'))
        <div class="alert {{ $errors->first('class') }}">
             {{ $errors->first('message') }}
        </div>
    @endif
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-plus"></i> Add New Divan</h4>
		<form class="form-horizontal style-form" method="post" action="/add-divanDB" enctype="multipart/form-data">
			{{ csrf_field() }}

			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">title</label>
				<div class="col-sm-10">
                    <input name="title" type="text" disabled class="form-control" required value="{{$divan->title}}">
				</div>
            </div>

            
			<div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">type</label>
                <div class="col-sm-10">
                    <input name="title" type="text"  disabled class="form-control" required value="{{$divan->type->name}}">
                </div>
            </div>
            <div class="form-group" id="code" >
				<label class="col-sm-2 col-sm-2 control-label">Code</label>
				<div class="col-sm-10">
                <input name="code"  type="text" disabled class="form-control" value="{{$divan->code}}">
				</div>
            </div>
            @if($divan->divan_type_id == 1)	

            <div class="form-group" id="description" >
                <label class="col-sm-2 col-sm-2 control-label">Body</label>
                <div class="col-sm-10">                  
                    <textarea class="ckeditor" disabled name="body" id="body" required>{{$divan->description}}</textarea>
                </div>
            </div>
            <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
            <!-- script for ck editor -->
            <script>
                CKEDITOR.replace('body');
                CKEDITOR.add      
            </script>  
            @endif

            @if($divan->divan_type_id == 2)
            <div class="form-group" id="description" >
                <label class="col-sm-2 col-sm-2 control-label">Body</label>
                <div class="col-sm-10">                  
                    <textarea class="form-control" disabled  id="body" required>{{$divan->description}}</textarea>
                </div>
            </div>
            @endif
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
                @foreach($divan->divanFile as $files)
                <tr>
                <td>{{$i}}</td>
                <td>
                    {{ $files->name }}
                </td>      
                <td>
                    <a target="_blank" href="/divan/{{ $files->name }}" class="btn btn-primary btn-xs"><i class="fa fa-download"></i></a>
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