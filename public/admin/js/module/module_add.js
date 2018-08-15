$(document).ready(function(){
    $('#column').change(function(){
        num = $(this).val();
        data = '';
        for(i=1;i<=num;i++){
            data += '<div class="columns">';
            data += '<div class="col-md-3 col-xs-12 col-sm-3 text-right">';
            data += '<h3>Cột '+i+'</h3>';
            data += '</div>';
            data += '<div class="clearfix"></div>';
            data += '<div class="item form-group">';
            data += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Tên cột</label>';
            data += '<div class="col-md-6 col-sm-6 col-xs-12">';
            data += '<input class="form-control col-md-7 col-xs-12" name="name'+i+'" type="text" >';
            data += '</div>';
            data += '</div>';
            data += '<div class="clearfix"></div>';
            data += '<div class="item form-group">';
            data += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Tên hiển thị</label>';
            data += '<div class="col-md-6 col-sm-6 col-xs-12">';
            data += '<input class="form-control col-md-7 col-xs-12" name="display_name'+i+'" type="text" >';
            data += '</div>';
            data += '</div>';
            data += '<div class="clearfix"></div>';
            data += '<div class="item form-group">';
            data += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Kiểu hiển thị</label>';
            data += '<div class="col-md-6 col-sm-6 col-xs-12">';
            data += '<select name="display_type'+i+'" target="#select_options'+i+'" class="display_type form-control col-md-7 col-xs-12">';
            data += '<option value="0">Text</option>';
            data += '<option value="1">Checkbox</option>';
            data += '<option value="2">Number</option>';
            data += '<option value="3">Radio</option>';
            data += '<option value="4">Select</option>';
            data += '<option value="5">File</option>';
            data += '<option value="6">Textarea</option>';
            data += '</select>';
            data += '</div>';
            data += '</div>';
            data += '<div class="clearfix"></div>';
            data += '<div id="option'+i+'">';

            data += '</div>';
            data += '<div class="clearfix"></div>';
            data += '<div class="item form-group" id="select_options'+i+'" style="display:none;">';
            data += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Options</label>';
            data += '<div class="col-md-6 col-sm-6 col-xs-12">';
            data += '<input class="form-control col-md-7 col-xs-12 select_option" name="select_option'+i+'" target="#option'+i+'" type="text" >';
            data += '</div>';
            data += '</div>';
            data += '<div class="clearfix"></div>';
            data += '<div class="item form-group">';
            data += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Kiểu dữ liệu</label>';
            data += '<div class="col-md-6 col-sm-6 col-xs-12">';
            data += '<select name="type'+i+'" class="form-control col-md-7 col-xs-12">';
            data += '<option value="0">Chọn kiểu</option>';
            data += '<option value="1">Integer</option>';
            data += '<option value="2">Varchar</option>';
            data += '<option value="3">Text</option>';
            data += '<option value="4">Date</option>';
            data += '</select>';
            data += '</div>';
            data += '</div>';
            data += '<div class="item form-group">';
            data += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Độ dài</label>';
            data += '<div class="col-md-6 col-sm-6 col-xs-12">';
            data += '<input class="form-control col-md-7 col-xs-12" name="length'+i+'" type="number" >';
            data += '</div>';
            data += '</div>';
            data += '<div class="clearfix"></div>';
            data += '</div>';
        }
        $("#column_list").html(data);
        $(".display_type").change(function(){
            type = $(this).val();
            if(type == 4){
                target = $(this).attr('target');
                $(target).show();
                str = "";
            }else{
                target = $(this).attr('target');
                $(target).hide();
            }
        })
        str = "";
        $('.select_option').change(function(){
            val = $(this).val();
            target = $(this).attr('target');
            str = $(target).html();
            str += '<div class="item form-group">';
            str += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Values</label>';
            str += '<div class="col-md-6 col-sm-6 col-xs-12">';
            str += '<div class=" input-group">'
            str += '<input class="form-control col-md-7 col-xs-12" name="'+target.replace('#','')+'[]" type="text" value="'+val+'" readonly>';
            str += '<span class="input-group-addon rm_options" style="cursor:pointer;"><i class="fa fa-remove" aria-hidden="true"></i></span>';
            str += '</div>';
            str += '</div>';
            str += '</div>';
            str += '<div class="clearfix"></div>';
            $(target).html(str);
            str = "";
            $('.rm_options').click(function(){
                $(this).parent().parent().parent().remove();
            })
        })
    });

})