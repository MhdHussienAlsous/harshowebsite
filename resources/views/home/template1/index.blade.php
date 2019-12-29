@extends('home.template1.master')

@section('content')

<!-- start file area  -->
<a href="item/{{ $sliderItem->id }}">
  <div class="file-area" style="background-image: url('home/template1/images/043-01.jpg')">
      <div class="file-area-in">
          <div class="container">
            <div class="title-block">
              <h1>
                  {{$sliderItem->title}}
              </h1>
              <p class="heading">
                @php
                    echo mb_substr(strip_tags(html_entity_decode($sliderItem->body)), 0 , 100) . '...' ;
                @endphp 
              </p>
            </div>
          </div>
      </div>
  </div>
</a>
<!-- end file area -->
<!-- start div borders -->
  <div class="container">
      <div class="row">
        <div class="borders">
           <div class="col-lg-9">
            <div class="border-right"></div>
          </div>
          <div class="col-lg-3">
            <div class="border-left"></div>
          </div>         
        </div>
      </div>
  </div>
<!-- end div borders -->
<!-- start body -->
<div class="container">
  <div class="body">
    <div class="row">
        <div class="col-md-2">      
          <div class="title-section" >
              {{ __('keywords.last-items') }} 
          </div>
        </div> 
        <div class="col-md-7">
          <div class="right">
            <div class="items"> 
              @for($i=0 ; $i< 5 ; $i++) 
              <div class="item">
                <div class="row">
                  <div class="col-sm-6">
                    <a href="item/{{ $lastItems[$i]->id }}">
                      <div class="item-content">
                        <h4>
                          <span class="category"> {{ $lastItems[$i]->category->name }} |</span>
                          <span class="title">
                            {{ $lastItems[$i]->title }}
                          </span>               
                        </h4>
                        <p class="lead">
                          @php
                              echo mb_substr(strip_tags(html_entity_decode($lastItems[$i]->body)), 0 , 50) . '...' ;
                          @endphp       
                        </p>
                      </div>
                    </a>
                    <div class="item-content-share">
                      <p class="share"> تم النشر  {{ $lastItems[$i]->created_at->diffForHumans() }}
                      <i class="fa fa-share-alt pull-right"></i>
                      </p>
                    </div>
                  </div>
                  <a href="item/{{ $lastItems[$i]->id }}">
                    <div class="col-sm-6">
                      <div class="item-thumbnail" style="background-image: url('{{ asset('uploads/'.$lastItems[$i]->image) }}')">
                        <div class="item-thumbnail-in">
                          
                        </div>
                      </div>
                    </div>
                  </a>              
                </div>          
              </div>
              <!-- end item -->
              @endfor
            </div>
          </div><!-- end right section -->
        </div>        
        <div class="col-md-3">
          <div class="left">
            <div class="items">

              @for($i=6 ; $i< 10 ; $i++) 
              <div class="item" style="background-image: url('{{ asset('uploads/'.$lastItems[$i]->image) }}');">
                <div class="item-contents">
                  <div class="item-content">
                    <a href="item/{{ $lastItems[$i]->id }}">
                      <h4 class="text-center">
                        @php
                        echo mb_substr($lastItems[$i]->title , 0 , 50 , 'utf-8') . '....';
                        @endphp              
                      </h4>
                    </a>
                  </div>
                  <div class="item-share">
                    <p class="share">تم النشر   {{ $lastItems[$i]->created_at->diffForHumans() }}
                      <i class="fa fa-share-alt pull-right"></i>
                    </p>
                  </div>
                </div>
                
              </div>
              @endfor
              
            </div>
          </div>
          <!-- end left -->
        </div>
    </div>
  </div>
</div>
<!-- end body -->

<!-- start  hagtag-tv area -->
<div class="container">
  <div class="hagtag-tv">
    <div class="row">
      <div class="col-lg-2">
          <div class="title-section">
              {{ __('keywords.hashtag-tv') }} 
          </div>
      </div>
      <div class="col-lg-10">
          <div class="row">
            @for($i=0 ; $i<3 ; $i++)
            <div class="col-lg-4">
              <div class="item">
                  <div class="row">
                    <div class="col-xs-12 ">
                      <iframe src="https://www.youtube.com/embed/{{ $videoItems[$i]->url }}" 
                              frameborder="0" 
                              style="width: 100%;"
                              allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture">
                      </iframe>
                    </div>
                    <div class="col-xs-12 ">
                      <div class="item-botton-contents">
                        <div class="item-botton-content">
                          <a href="item/{{ $videoItems[$i]->id }}">
                            <h4>
                              {{ $videoItems[$i]->title }}
                            </h4>
                          </a>
                        </div>
                        <div class="item-botton-share">
                          <p class="share">تم النشر {{ $videoItems[$i]->created_at->diffForHumans() }}
                            
                            <i class="fa fa-share-alt pull-right"></i>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            @endfor
          </div>        
      </div>
    </div>
  </div>
</div>
<!-- end  hagtag-tv area -->

<!-- start most-reading -->
<!-- <div class="container">
  <div class="most-reading">
    <div class="title-section">
      <h2>بوستاتي</h2>
    </div>
    <div class="row">
      @for($i=0 ; $i<1 ; $i++)
      <div class="col-lg-4">
        <div class="item">
          <a href="#" class="item-link">
            <div class="item-content" style="background-image: url('images/item-popular3.jpg');">
              <div class="item-in">
                <h3>عصر الوجبات
                  الجاهزة ينشر
                  امراض القلب
                  والسكري
                والاكتئاب</h3>
                
                <div class="item-title text-center">
                  <p>طعام سريع الموت</p>
                </div>
              </div> 
            </div>
          </a>
          <div class="item-share">
            تم النشر  ساعتين
            <i class="fa fa-share-alt pull-right"></i>
          </div>
        </div>
      </div>
      @endfor
    </div>
  </div>
</div> -->
<!-- end more-reading -->


<!-- start mix section -->
<div class="container">
  <div class="mix">
    <div class="row">
      <div class="col-lg-2">
          <div class="title-section">
              محلي
          </div>        
      </div>
      <div class="col-lg-10">
        <div class="items-above-footer-top">
          <div class="row">
            <div class="col-lg-8">
              <div class="item">
                <div class="col-lg-6">
                  <div class="item-contents">
                    <a href="item/{{ $localItems[0]->id }}">
                      <div class="item-content">
                        <h3 style="margin: 0px;">
                          {{ $localItems[0]->title }}
                        </h3>
                      </div>
                    </a>
                    <div class="item-share">
                      <p class="share">تم النشر  
                        
                        <i class="fa fa-share-alt pull-right"></i>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="item-cover" style="background-image: url('{{ asset('uploads/'.$localItems[0]->image) }}');">
                    <div class="item-cover-in">

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="item2">
                <div class="item"  style="background-image: url('{{ asset('uploads/'.$localItems[1]->image) }}'); background-size: 100% 100%;">
                  <div class="item-in">
                    <div class="item-contents-2">
                      <a href="item/{{ $localItems[1]->id }}">
                        <div class="item-content">
                          <h3 style="margin: 0px;">
                            {{ $localItems[1]->title }}
                          </h3>
                          <p>  
                        
                          </p>
                        </div>
                      </a>
                      <div class="item-share">
                        <p class="share">تم النشر   
                          <i class="fa fa-share-alt pull-right"></i>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="items-above-footer-down">
          <div class="row">

            @for($i=2 ; $i< 5 ; $i++)  
            <div class="col-lg-4">
              <div class="item">
                <a href="item/{{ $localItems[$i]->id }}">
                  <div class="item-cover" style="background-image: url('{{ asset('uploads/'.$localItems[$i]->image) }}');">
                    <div class="item-cover-in">
                      
                    </div>
                  </div>
                </a>
                <div class="item-content">
                  <a href="item/{{ $localItems[$i]->id }}">
                    <h4>
                      {{ $localItems[$i]->title }}
                    </h4>
                  </a>
                </div>
                <div  class="share">
                  <p>تم النشر  
                    <i class="fa fa-share-alt pull-right"></i>
                  </p>
                </div>
              </div>  
            </div>
            @endfor  

          </div>
        </div>        
      </div>
    </div>
  </div>
</div>
<!-- end mix section -->

<!-- start economy-news -->
<div class="container">
  <div class="economy-news">
    <div class="row">
          <div class="col-lg-2">      
            <div class="title-section" >
              سياسي
            </div>
          </div> 
          <div class="col-lg-7">
            <div class="right">
              <div class="items"> 
                @for($i=0 ; $i< 3 ; $i++) 
                <div class="item">
                  <div class="row">
                    <div class="col-sm-6">
                      <a href="item/{{ $politcal_items[$i]->id }}">
                        <div class="item-content">
                          <h4>
                            <span class="category"> {{ $politcal_items[$i]->category->name }} |</span>
                            <span class="title">
                              {{ $politcal_items[$i]->title }}
                            </span>               
                          </h4>
                          <p class="lead">
                            {{-- @php
                                echo mb_substr(strip_tags(html_entity_decode($politcal_items[$i]->body)), 0 , 50) . '...' ;
                            @endphp        --}}
                          </p>
                        </div>
                      </a>
                      <div class="item-content-share">
                        <p class="share"> تم النشر  
                          <i class="fa fa-share-alt pull-right"></i>
                        </p>
                      </div>
                    </div>
                    <a href="item/{{ $politcal_items[$i]->id }}">
                      <div class="col-sm-6">
                        <div class="item-thumbnail" style="background-image: url('{{ asset('uploads/'.$politcal_items[$i]->image) }}')">
                          <div class="item-thumbnail-in">
                            
                          </div>
                        </div>
                      </div>
                    </a>              
                  </div>          
                </div>
                <!-- end item -->
                @endfor
              </div><!-- end items -->   
            </div><!-- end right section -->
          </div>        
      <div class="col-lg-3">
        <div class="left">

        </div>
        <!-- end left -->
      </div>
    </div>
  </div>
</div>
<!-- end economy-news -->

<!-- start most-reading -->
<div class="container">
  <div class="most-reading">
      <div class="row">
        <div class="col-lg-2">
          <div class="title-section">
            اقتصادي
          </div>
        </div>
        <div class="col-lg-10">
            <div class="items">
                <ol class="list-counter">
                  @foreach($economy_items as $one)
                    <li class="list-counter__item">
                    <a href="/item/{{$one->id}}">
                       {{ $one->title  }}
                      </a>
                    </li>
                  @endforeach
                 
                </ol>
            </div>
        </div>
      </div>
  </div>
</div>
<!-- end most-reading -->

<!-- start technical-news -->
<div class="container">
  <div class="technical-news">
      <div class="row">
        <div class="col-lg-2">
          <div class="title-section">
            أخبار الفن 
          </div>
        </div>  
        <div class="col-lg-10">
          <div class="row">
            @for($i=0 ; $i<3 ; $i++)
            <div class="col-lg-4">
              <div class="item">
              <a href="/item/{{$artnews_items[$i]->id}}" class="item-link">
                  <div class="item-content" style="background-image: url('{{ asset('uploads/'.$artnews_items[$i]->image) }}');">
                    <div class="item-in">
                      <h3>
                        {{-- @php
                            echo mb_substr(strip_tags(html_entity_decode($artnews_items[$i]->body)), 0 , 50) . '...' ;
                        @endphp     --}}
                      </h3>
                      
                      <div class="item-title text-center">
                        <p>
                          @php
                           echo $artnews_items[$i]->title;
                          @endphp  
                        </p>
                      </div>
                    </div> 
                  </div>
                </a>
                <div class="item-share">
                  تم النشر   
                  <i class="fa fa-share-alt pull-right"></i>
                </div>
              </div>
            </div>
            @endfor             
          </div>         
        </div>      
      </div>
  </div>
</div>
<!-- end artist news -->


<!-- start public-caluture -->
<div class="container">
  <div class="public-caluture">
    <div class="row">
          <div class="col-lg-2">      
            <div class="title-section" >
              خاص
            </div>
          </div> 
          <div class="col-lg-10">
            <div class="row">
              <div class="col-lg-8">
                <div class="right">
                  <div class="items"> 
                    @for($i=0 ; $i< 3 ; $i++) 
                    <div class="item">
                      <div class="row">
                        <div class="col-sm-8">
                          <a href="item/{{ $speial_items[$i]->id }}">
                            <div class="item-content">
                              <h5>
                                <span class="category"> {{ $speial_items[$i]->category->name }} |</span>
                                <span class="title">
                                  {{ $speial_items[$i]->title }}
                                </span>               
                              </h5>
                            </div>
                          </a>
                          <div class="item-content-share">
                            <p class="share"> تم النشر   
                              <i class="fa fa-share-alt pull-right"></i>
                            </p>
                          </div>
                        </div>
                        <a href="item/{{ $speial_items[$i]->id }}">
                          <div class="col-sm-4">
                            <div class="item-thumbnail" style="background-image: url('{{ asset('uploads/'.$speial_items[$i]->image) }}')">
                              <div class="item-thumbnail-in">
                                
                              </div>
                            </div>
                          </div>
                        </a>              
                      </div>          
                    </div>
                    <!-- end item -->
                    @endfor
                  </div><!-- end items -->   
                </div><!-- end right section -->
              </div>        
              <div class="col-lg-4">
                <div class="left">

                </div>
                <!-- end left -->
              </div>                
            </div>          
          </div>
    </div>
  </div>
</div>
<!-- end  public-caluture -->



<!-- start medicine-news -->
<div class="container">
    <div class="medicine-news">
        <div class="row">
          <div class="col-lg-2">      
            <div class="title-section" >
               منوع
            </div>
          </div>
          <div class="col-lg-10">
            <div class="items">
                <ol class="list-counter">
                  @foreach($general_items as $one)
                     <li class="list-counter__item">
                      <a href="/item/{{$one->id}}">
                        {{ $one->title }}
                      </a>
                    </li>
                  @endforeach
                 
                </ol>
            </div>            
          </div>
        </div>
    </div>
</div>
<!-- end medicine-news -->


<!-- start cooking -->
<div class="container">
  <div class="cooking">
      <div class="row">
            <div class="col-lg-2">      
              <div class="title-section" >
                 رياضة
              </div>
            </div>
            <div class="col-lg-10">
              <div class="row">
                <div class="col-lg-8">
                  <div class="right">
                    <div class="items">
                    <div class="item-botton">
                        <div class="row">
                          <div class="col-xs-12 ">
                            <a href="item/{{ $sport_items[3]->id }}"><img src="{{ asset('uploads/'.$sport_items[3]->image) }}" style="width: 100%;"></a>
                          </div>
                          <div class="col-xs-12 ">
                            <div class="item-botton-contents">
                              <div class="item-botton-content">
                                <a href="item/{{ $sport_items[3]->id }}">
                                  <h3>
                                    {{ $sport_items[3]->title }}
                                  </h3>
                                </a>
                              </div>
                              <div class="item-botton-share">
                                <p class="share">تم النشر  {{ $sport_items[3]->created_at->diffForHumans() }}
                                  
                                  <i class="fa fa-share-alt pull-right"></i>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>                   
                      @for($i=0 ; $i< 3 ; $i++) 
                      <div class="item">
                        <div class="row">
                          <div class="col-sm-8">
                            <a href="item/{{ $sport_items[$i]->id }}">
                              <div class="item-content">
                                <h5>
                                  <span class="category"> {{ $sport_items[$i]->category->name }} |</span>
                                  <span class="title">
                                    {{ $sport_items[$i]->title }}
                                  </span>               
                                </h5>
                              </div>
                            </a>
                            <div class="item-content-share">
                              <p class="share"> تم النشر   {{ $sport_items[$i]->created_at->diffForHumans() }}
                                <i class="fa fa-share-alt pull-right"></i>
                              </p>
                            </div>
                          </div>
                          <a href="item/{{ $sport_items[$i]->id }}">
                            <div class="col-sm-4">
                              <div class="item-thumbnail" style="background-image: url('{{ asset('uploads/'.$sport_items[$i]->image) }}')">
                                <div class="item-thumbnail-in">
                                  
                                </div>
                              </div>
                            </div>
                          </a>              
                        </div>          
                      </div>
                      <!-- end item -->
                      @endfor                    
                    </div><!-- end items -->   
                  </div><!-- end right section -->
                </div>        
                <div class="col-lg-4">
                  <div class="left">

                  </div>
                  <!-- end left -->
                </div>                
              </div>                
            </div>
          </div>        
      </div>
  </div> 
</div>
<!-- end cooking -->
@stop

