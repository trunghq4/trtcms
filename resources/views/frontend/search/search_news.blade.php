@extends('frontend.layout.layout')
@section('title') Tìm kiếm @stop
@section('content')
<div class="search-input component">
  <form method="GET" action="{{url('search-news')}}" class="search">
    <input required placeholder="Tìm kiếm bài viết ..." type="text" name="search_news"/>
    <span class="submit"></span>
    <input type="submit"/>
  </form>
</div>
@if(count($list_news) >0)
<div class="news-list component" id="news_news-list">
  <h1 class="title"> Kết quả tìm kiếm </h1>
  <div class="boxes">
  @foreach($list_news as $items)
  <a data-category="" href="{{url($items->alias)}}.html" class="box" title="{{$items->title}}">
    <div class="date">{{date('d-m-Y',$items->time+7*3600)}}</div>
    <img alt=""  src="{{url($items->thumb)}}"/>
    <div class="details">
      <h3 class="articleTitle">{{$items->title}}</h3>
      <div class="description">{{$items->description}} </div>
    </div>
    </a> 
  @endforeach
    </div>
  <div class="pagination">
    {!!str_replace('/?','?',$list_news->render())!!}
  </div>
</div>
  @else
  <div class="news-list component" id="news_news-list">
    <h1 class="title"> Không tìm thấy kết quả nào </h1>
  </div>
  @endif
@stop
