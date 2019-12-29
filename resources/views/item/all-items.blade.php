@extends('content.dashboard')

@section('content')

<h3><i class="fa fa-angle-right"></i> All Items</h3>
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
          <h4><i class="fa fa-th-list"></i> Items Table</h4>
          <hr>
          <thead>
            <tr>
              <th><i class="fa fa-bookmark"></i> Title</th>
              <th class="hidden-phone"><i class="fa fa-question-circle"></i> Category</th>
              <th ><i class="fa fa-user"></i> User</th>
              <th><i class=" fa fa-eye"></i> Views</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
            <tr>
              <td>
                {{ $item->title }}
              </td>

              <td class="hidden-phone">
               {{ $item->category->name }}
             </td>
             
             <td>
               {{ $item->person->name }}
             </td>

             <td><span class="label label-success label-mini">
              {{ $item->views }}
            </span></td>
            <td>
              @permission('update-item')
              <a href="/item/{{ $item->id }}/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
              @endpermission
              @permission('delete-item')
              <a href="/item/{{ $item->id }}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
              @endpermission                        
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /content-panel -->
  </div>

  <div style="text-align: center">{{ $items->links() }}  </div> 
  <!-- /col-md-12 -->
</div>
<!-- /row -->
</div>
<!-- col-lg-12-->
@stop