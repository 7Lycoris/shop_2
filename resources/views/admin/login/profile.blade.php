@extends('layout.admins')

@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>{{$title}}</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form id="art_form" class="mws-form" action="/admin/user" method='post' enctype='multipart/form-data'>
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">头像</label>
                    <div class="mws-form-item">
                        <div class="fileinput-holder" style="position: relative;">
                            
                            <img id='img' src="{{$profile}}" alt="" style='width:180px;height:220px'>

                            <input id='file_upload' type="file" name='profile' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                {{csrf_field()}}
                
            </div>
        </form>
    </div>      
</div>
@stop

@section('js')
<script>
    
    // $(function () {
        $("#file_upload").change(function () {
          // alert(11);
           //  判断是否有选择上传文件
            var imgPath = $("#file_upload").val();

            if (imgPath == "") {
                alert("请选择上传图片！");
                return;
            }
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
            if (strExtension != 'jpg' && strExtension != 'gif'
                && strExtension != 'png') {
                alert("请选择图片文件");
                return;
            }

            //实例化 表单数据 
            var formData = new FormData($('#art_form')[0]);

            $.ajax({
                type: "POST",
                url: "/admin/doprofile/{{$id}}",
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    //data ==> '/upload/348348384304.jpg'
                    // console.log(data);

                    $('#img').attr('src',data);
                    // $('#art_thumb').val(data);
                    location.reload(true);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        })
    // })
    
</script>

@stop
