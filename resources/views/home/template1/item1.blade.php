@extends('home.template1.master')

@section('header')
<link rel="stylesheet" href="{{ asset('home/template1/css/item-style.css') }}">
@stop

@section('content')

<!-- start item details -->
<div class="container">
    <div class="item-details">
        <ul class="breadcrumb">
            <li><a href="/">الرئيسية</a></li>
            <li><a href="/{{ $item->category->id }}">{{ $item->category->name }}</a></li>
        </ul>
        <div class="item-title">
            <h1>{{ $item->title }}</h1>
        </div>
        <div class="item-cover text-center">
            <p style="text-align: right;">
                تم النشر: 
                {{ $item->created_at->diffForHumans() }}
            </p>
            @if($item->item_type_id == 2)
                <iframe src="https://www.youtube.com/embed/{{ $item->url }}" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture">
                </iframe>
            @else  
                <img src="{{ asset($item->image) }}" class="">
            @endif 
            
        </div>
        <div class="item-contents">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-7">
                    @php
                      echo html_entity_decode($item->body);
                    @endphp

                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
        <div class="item-tags">
            <h3>مقالات ذات صلة</h3>
            <ul class="tags">
                @foreach($item->tags as $tag)
                  <li>{{ $tag->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- end item details -->


@stop