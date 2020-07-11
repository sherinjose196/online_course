@extends('layouts.admin')

@section('header')
@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Course</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="prod_form" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Category</label>
                <select class="form-control" name="category" id="category">
                 <option value="{{$course->category_id}}">{{$course->category}}</option>
                    <option value="">Select Categorys</option>
                    @foreach($categorys as $category)
                    <option value="{{$category->cat_id}}">{{$category->category}}</option>
                      @endforeach
              
                  </select>
                </div>
                <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="descrip" placeholder="Enter ...">{{$course->description}}</textarea>
                      </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Video</label>
                  <input type="file" name="files" class="form-control" id="Image" placeholder="Enter Phone">
           <table class="table table-bordered table-hover" style="width: 50%">
                                                <thead>
                                                <tr role="row" class="heading">
                                                    <th width="8%">
                                                        Attachment
                                                    </th>

                                                    <th width="10%"> Remove

                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="ImagePrevs">


                                                <tr >
                                                    <td>
                                                        <a href="" class="fancybox-button" data-rel="fancybox-button">
                                                          <input type="hidden" name="fileURLs" value="{{$course->video}}"  />
                                                            <img style="margin: 0 10px 10px 0 !important; width:100px;" src="{{ url('data/temp/'.$course->video) }}" />

                                                        </a>
                                                    </td>

                                                    <td>
                           <a href="javascript:;" class="btn default btn-sm removeImage" onclick="removeImage({{$course->id}})" id="{{ $course->id }}"  >
                                                            <i class="fa fa-times"></i> Remove </a>     
                                                                                          </td>
                                                </tr>

                                                </tbody>
                                            </table>
                </div>
				
               
                
                
              <!-- /.box-body -->

              <div class="box-footer">
			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
			     <input type="hidden" name="course_id"   value="{{$course->id}}" />

               <input type="hidden" name="type"   value="editCourse" />
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
  
    </div>
@endsection

@section('footer')
    <script>
	 $(document).ready(function()
	 {
		 
            var token = '{{ csrf_token() }}';

            var url = '{{ URL::route("PostImageUpload") }}';


            $('#Image').fileupload({

                url: url,
                dataType: 'json',
                formData : {_token:token},
                add: function (e, data) {
                    var fileType = data.files[0].name.split('.').pop(), allowdtypes = 'mp4,jpeg,png,gif';


                    if (allowdtypes.indexOf(fileType) < 0) {
                        alert('Sorry,JPG PNG GIF are allowed.');
                        return false;
                    }

                    if( data.files[0]['size'] > 10000000000) { //10MB
                        alert('Filesize is too big');
                        return false;
                    }
                    data.submit();
                },progressall: function (e, data) {
                    $("#progress").show();

                    var progress = parseInt(data.loaded / data.total * 100, 10);

                    $('#progress .progress-bar').css('width',progress + '%');
                },
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        var url = "";

                        if(file.type == "image/mp4" || file.type == "image/jpg" || file.type == "image/png" || file.type == "image/gif" ){
                            var urlRoute = "{{ asset('data/temp/') }}/";

                            url = "<img src='"+urlRoute+file.name+"' style='max-width: 50px;'/>";
                        }
                        var html = '<tr ><td><a href="#" class="fancybox-button" data-rel="fancybox-button">'+url+'<input type="hidden" name="fileURLs" value="'+file.name+'"  /></td><td><a href="javascript:;" class="btn default btn-sm removeImage"  id=""><i class="fa fa-times"></i> Remove </a> </td> </tr>';
                        $('#ImagePrevs').append(html);
                    });

                    $("#progress").hide();
                    var $ImagePrevs = $('#ImagePrevs');

                },


            }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
            $('body').on('click', '.removeImage', function () {

                $(this).parent().parent().remove();

            });
       $("#prod_form").validate({
               rules: {
                    name: {
                        required: true,
                    },price: {
                        required: true,
                    },image: {
                        required: true,
                    },brand: {
                        required: true,
                    },processor: {
                        required: true,
                    },screeb: {
                        required: true,
                    }
                
                },
                messages: {
                    name: {
                        required: "Please enter  name ",
                    }
                },
                errorPlacement: function(error, element) {
                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },
                submitHandler: function(form) {

                    // do other things for a valid form
                    var formData = $("#prod_form").serialize();
                    $("#messageModalBody").html("Your formhas been successfully submitting...");
                    $('#messageModal').modal('show');
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            setInterval(function(){
                                $("#messageModalBody").html("Your form has been successfully submited, you are now being redirected ...");
                                $('#messageModal').modal('show');
                                window.location.href="{{URL::route('Courses')}}";
                            }, 1500);

                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endsection
