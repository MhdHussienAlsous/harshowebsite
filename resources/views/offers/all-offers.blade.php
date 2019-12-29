@extends('content.dashboard')
@section('content')

<h3><i class="fa fa-angle-right"></i> All Offers</h3>
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
        <h4><i class="fa fa-th-list"></i> Offers Table</h4>
        <hr>
        <thead>
          <tr>
            <th><i class="fa fa-bookmark"></i> offer image </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
        <tr>
        <td>
            
            @if($offer->type == "v")
            <img src="/offers/{{$offer->name}}" style="width:60%; height:200px" />
            @endif
            @if($offer->type == 'h')
            <img src="/offers/{{$offer->name}}" style="width:60%; height:70px" />
            @endif
        </td>
            <td>
       

                @if($offer->state == 0)
                <a class="btn btn-success waves-effect waves-light btn-xs" href="/change-offer/{{$offer->id}}">
                    <i class="ico ico-left fa fa-toggle-on fa-lg" style="margin-left:0px"></i> تفعيل
                </a>
                @endif

                @if($offer->state == 1)
                <a class="btn btn-warning waves-effect waves-light btn-xs" href="/change-offer/{{$offer->id}}">
                    <i class="ico ico-left fa fa-toggle-off fa-lg" style="margin-left:0px"></i> الغاء تفعيل
                </a>
                @endif

                <a class="btn btn-danger waves-effect waves-light btn-xs" href="/delete-offer/{{$offer->id}}">
                    <i class="ico ico-left fa fa-close" style="margin-left:0px"></i> حذف 
                </a>
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