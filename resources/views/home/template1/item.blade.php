@extends('home.template1.master')

@section('header')
<link rel="stylesheet" href="{{ asset('home/template1/css/item-style.css') }}">

<meta property="og:url"           content="http://hashtagsyria.com/item/{{ $item->id }}"/>
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{ $item->title }}" />
<meta property="og:description"   content="<?php echo mb_substr(strip_tags(html_entity_decode($item->body)), 0 , 100) . '...' ; ?>" />
<meta property="og:image"         content="{{ asset('uploads/'.$item->image) }}"/>


<meta name="twitter:description"  content="<?php echo mb_substr(strip_tags(html_entity_decode($item->body)), 0 , 100) . '...' ; ?>"/>
<meta name="twitter:title"        content="{{ $item->title }}" />
<meta name="twitter:image"        content="{{ asset('uploads/'.$item->image) }}"/>

@stop

@section('content')

<!-- start item details -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ul class="breadcrumb">
                <li><a href="/">الرئيسية</a></li>
                <li><a href="/section/{{ $section_id }}">{{ $item->category->name }}</a></li>
            </ul>            
        </div>
        <div class="col-lg-2">
            <div class="AD" style="text-align: right;">
                <?php if(!$v_offer)  $v_offer_name ="de_v.png"; else $v_offer_name =  $v_offer->name;?>
                <img src="/offers/{{$v_offer_name}}" style="width: 120px;
                height: 500px;">
            </div>
        </div>
        <div class="col-lg-8">
            <div class="item-details">
                <div class="item-title">
                    <h1>{{ $item->title }}</h1>
                </div>
                <div class="item-cover text-center">
                    <p style="text-align: right;">
                        تم النشر في:
                        <span style=" font-family: 'Arial';">
                            {{ $item->created_at }}
                        </span>
                    </p>
                    <p style="font-size:19px">
                        <i>{{ $item->introduction }}</i>
                    </p>
                    @if($item->item_type_id == 2)
                        <iframe src="https://www.youtube.com/embed/{{ $item->url }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture">
                        </iframe>
                    @else 
                        <div class="image-item">
                            <img src="{{ asset('uploads/'.$item->image) }}" class="">
                            <p> 
                                {{ $item->image_title }} 
                            </p>
                        </div>
                        
                    @endif 
                    
                </div>
                <div class="item-contents">
                    <div class="row">
                        <div class="col-lg-12">
                            @php
                              echo html_entity_decode($item->body);
                            @endphp
                        </div>
                    </div>
                </div>
                <div class="item-tags">
                    <ul class="tags">
                        @foreach($item->tags as $tag)
                          <li>{{ $tag->name }}</li>
                        @endforeach
                    </ul>
                </div>             
            </div>            
        </div>
        <div class="col-lg-2">
            <div class="AD" style="text-align: right;">
                <?php if(!$v_offer)  $v_offer_name ="de_v.png"; else $v_offer_name =  $v_offer->name;?>
                <img src="/offers/{{$v_offer_name}}" style="width: 120px;
                height: 500px;">
            </div>
        </div>
    </div>
</div>
<!-- end item details -->

<!-- start related items -->
<div class="container">
    <div class="related-items">
        <div class="row">
            <h3 style="text-align: right;
            margin: 20px 25px;">مقالات ذات صلة</h3>
            @foreach($items as $one)
            <a href="/item/{{ $one->id }}">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="item">
                    <img src="{{ asset('uploads/'.$one->image) }}" class="img-responsive">
                    <div class="item-title">
                        <a href="/item/{{$one->id}}">
                            <h4>
                                {{ $one->title }}
                            </h4>
                        </a>
                    </div>
 
                </div>
            </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
<!-- end related items -->  


<!-- start related items -->
<div class="container">
    <div class="related-items">
        <div class="row">
            <h3 style="text-align: right;
            margin: 20px 25px;">يتصفح زوارنا الآن</h3>
            @foreach($mostViewes as $m)
            <a href="/item/{{ $m->id }}">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="item">
                    <img src="{{ asset('uploads/'.$m->image) }}" class="img-responsive">
                    <div class="item-title">
                        <a href="/item/{{$m->id}}">
                            <h4>
                                {{ $m->title }}
                            </h4>
                        </a>
                    </div>
                </div>
            </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
<!-- end related items -->  



<script>
  $("body").floatingSocialShare({
    buttons: [
      "facebook", "linkedin", "pinterest", "reddit", 
      "telegram", "tumblr", "twitter", "viber", "vk", "whatsapp"
    ],
    text: "share with: ",
    url: "https://hashtagsyria.com/item/{{ $item->id }}"
  });
</script>

@stop