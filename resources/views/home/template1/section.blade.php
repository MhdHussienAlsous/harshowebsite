@extends('home.template1.master')
@section('content')
<div class="new-content section-page">
  <div class="box-title">
    <h2 class="title text-center"> {{ $menu->name }} </h2>
  </div>
  <div class="container">
    <div class="row">
      @if(count($articles)!=0 )
      @foreach($articles as $article)
      <div class="col-lg-4">
        <div class="item">
          <a href="/item/{{ $article->id }}" class="item-link">
            <div class="item-content" style="background-image: url('{{ asset('uploads/'.$article->image) }}');">
              <div class="item-in">
                <h3></h3>
                <div class="item-title text-center">
                  <p> 
                  @php
                   echo mb_substr($article->title, 0 , 80) . '...' ;
                  @endphp  
                 </p>
               </div>
             </div> 
           </div>
         </a>
         <div class="item-share">
          تم النشر  {{ $article->created_at->diffForHumans() }} 
          <i class="fa fa-share-alt pull-right"></i>
        </div>
      </div>
    </div>                        
    @endforeach
    @else

    <div class="description-category">
      <h3>{{ $menu->category->description }}</h3>
    </div>

    @endif

    
  </div>  
  <div style="text-align: center">{{ $articles->links() }}  </div> 
</div>
</div> <!-- End new-content-->

@stop