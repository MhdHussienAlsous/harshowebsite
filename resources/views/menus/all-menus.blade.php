@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> All Menus</h3>
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
            <th class="hidden-phone"><i class="fa fa-tag"></i> Category</th>
            <th><i class=" fa fa-edit"></i> Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($menuss as $menu)
          <tr>
            <td>
              {{ $menu->name }}
            </td>
            <td>
              @php
                $cat = App\Category::whereId($menu->category_id)->first();
              @endphp
              
              @if(!empty($cat))
               {{ $cat->name }}
              @else
               {{ " " }}
              @endif
            </td>

            @php
              $class_color = '';
              $name   = '';
              if($menu->is_root())
              {
                $class_color = 'label-danger';
                $name   = 'Root';
              } else {
                $class_color = 'label-success';
                $name   = 'Leaf';
              }
            @endphp

          <td><span class="label {{$class_color}} label-mini">{{$name}}</span></td>
          <td>
            @permission('update-menu')
            <a href="menu/{{$menu->id}}/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
            @endpermission
            @permission('delete-menu')
            <a href="all-menus/{{$menu->id}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
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