@extends('home.oneself.oneself')

@section('title',$title)
 @section('oneself')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
    </div>
    <div class="mws-panel-body no-padding">
        <form id="art_form" class="mws-form" action="/home/profile" method='post' enctype='multipart/form-data'>
    
                        <div class="fileinput-holder" style="position: relative;">
                            
                            <img id='img' src="{{$profile}}" alt="" style='width:180px;height:220px'>

                            <input id='file_upload' type="file" name='profile' >
                            <input type="hidden" name="username" value="{{$name}}">

                        </div>
               
            <div class="mws-button-row">
                {{csrf_field()}}
                
            </div>
        </form>
    </div>      
</div>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script>
    // alert($)
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
                url: "/home/doprofile/{{$name}}",
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    //data ==> '/upload/348348384304.jpg'
                    console.log(data);

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





