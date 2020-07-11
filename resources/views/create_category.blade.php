@extends('layouts.admin')

@section('header')
@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="cat_form">
              <div class="box-body">
               
                <div class="form-group">
                  <label for="exampleInputPassword1">Category </label>
                  <input type="text" name="category" class="form-control" id="exampleInputPassword1" placeholder="Enter Category">
                </div>
                
                
				
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="hidden" name="type"   value="newCategory" />
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
  
    </div>
@endsection

@section('footer')
    <script>
	 $(document).ready(function(){
       $("#cat_form").validate({
                rules: {
                    menu: {
                        required: true,
                    },content: {
                        required: true,
                    },files: {
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
                    var formData = $("#cat_form").serialize();
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
                                window.location.href="{{URL::route('Categorys')}}";
                            }, 1500);

                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endsection
