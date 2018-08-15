@extends('frontend.layout.layout')
@section('title') {!!$news->title_seo!!} @stop
@section('url') {{url($news->alias)}}.html @stop
@section('description') {!!$news->description_seo!!} @stop
@section('keywords') {!!$news->keyword_seo!!} @stop
@section('content')
<div class="textimage-background-fullheight component normal vertically-top white left"><img alt="" src="{{url($news->image)}}" class="background"/>
  <div class="text-shade"></div>
  <div class="text-container left white ">
    <h3 class="title">{{$news->title}}</h3>
    <div class="description">{{$news->description}}</div>
  </div>
</div>

{!!$news->content!!}

@stop