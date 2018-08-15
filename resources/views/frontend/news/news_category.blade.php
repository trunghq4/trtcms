@extends('frontend.layout.layout')
@section('title') {!!$cate_current->title_seo!!} @stop
@section('url') {{url($cate_current->alias)}}.html @stop
@section('description') {!!$cate_current->description_seo!!} @stop
@section('keywords') {!!$cate_current->keyword_seo!!} @stop
@section('content')
<div class="search-input component">
  <form method="GET" action="{{url('search-news')}}" class="search">
    <input required placeholder="Tìm kiếm bài viết ..." type="text" name="search_news"/>
    <span class="submit"></span>
    <input type="submit"/>
  </form>
</div>
<div class="news-list component" id="news_news-list">
  <h1 class="title"> {{$cate_current->title}} </h1>
  <div class="boxes"> 
  @if(count($news) >0)
  @foreach($news as $items)
  <a data-category="" href="{{url($items->alias)}}.html" class="box" title="{{$items->title}}">
    <div class="date">{{date('d-m-Y',$items->time+7*3600)}}</div>
    <img alt=""  src="{{url($items->thumb)}}"/>
    <div class="details">
      <h3 class="articleTitle">{{$items->title}}</h3>
      <div class="description">{{$items->description}} </div>
    </div>
    </a> 
  @endforeach
  @endif
    </div>
    
  <div class="pagination">
    {!!str_replace('/?','?',$news->render())!!}
  </div>
</div>
@stop