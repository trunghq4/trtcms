@extends('admin.layout.layout')
@section('title') Thêm {{$module_detail->name}}
@stop
@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel"> @include('errors.note')
        <div class="x_content">
          <form class="form-horizontal form-label-left" method="post" enctype='multipart/form-data'>
            <span class="section">Thêm {{$module_detail->name}}</span>

            <div class="col-md-9">
              @foreach(json_decode($module_detail->fields) as $items)
              <?php $name = $items->name; ?>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="{{$items->name}}">{{$items->display_name}}<span class="required">*</span> </label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                  @if($items->display_type == 0)
                  <input id="{{$items->name}}" class="form-control col-md-7 col-xs-12" name="{{$items->name}}" type="text" value="{{$get_old->$name}}">
                  @elseif($items->display_type == 1)
                  <input type="checkbox" name="{{$items->name}}" id="{{$items->name}}" class="flat" @if($get_old->$name == 1) checked @endif>
                  @elseif($items->display_type == 2)
                  <input id="{{$items->name}}" class="form-control col-md-7 col-xs-12" name="{{$items->name}}" type="number" value="{{$get_old->$name}}">
                  @elseif($items->display_type == 4)
                  <select id="{{$items->name}}" class="form-control col-md-7 col-xs-12" name="{{$items->name}}">
                    @foreach($items->option as $key => $val)
                    <option value="{{$key}}" @if($get_old->$name == $key) selected @endif>{{$val}}</option>
                    @endforeach
                  </select>
                  @elseif($items->display_type == 5)
                  <input id="fileUpload" class="form-control col-md-7 col-xs-12" name="{{$items->name}}" type="file">
                  <div class="clearfix"></div>
                  <div id="image-holder" class="col-md-3 col-xs-12">@if(file_exists($get_old->$name)) <img src="{{url($get_old->$name)}}" class="img-thumbnail"> @endif</div>
                  @elseif($items->display_type == 6)
                  <textarea class="form-control" id="{{$items->name}}" name="{{$items->name}}">{{$get_old->$name}}</textarea>
                  <script type="text/javascript">CKEDITOR.replace('{{$items->name}}')</script>
                  @endif

                </div>
              </div>
              <div class="clearfix"></div>
              @endforeach
            </div>

            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <input id="submit" name="submit" type="submit" class="btn btn-success" value="Thêm" />
              </div>
            </div>
            {{csrf_field()}}
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
@stop