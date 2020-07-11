@extends('layouts.admin')

@section('header')
@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
		<div class="box-header">
                            <h3 class="box-title"><a href="{{URL::route('NewCourse')}}"  class="btn btn-info">Create New </a></h3>
							
                        </div>
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Courses</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				
				 <th class="sorting">Sl No</th>
                  <th>Category</th>
                  <th>Description</th>
                  <th>Video</th>
                  
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php $i =1 ?>
				@foreach($courses as $course)
				
                <tr>
				
                  
                  <td>{{ $i}}</td>
                  <td>{{$course->category}}</td>
                  <td>{{$course->description}}</td>
                  <td>
                    <video width="320" height="240" poster="{{ url('data/temp/'.$course->video) }}" controls>
                           <source src="{{ url('data/temp/'.$course->video) }}" type="video/mp4">
                           
                           Your browser does not support the video tag.
                    </video>
                  </td>
                  
                  <td>
				 <a class="btnsedit " data-tooltip="Edit" data-id="{{$course->id}}" href="{{URL::route('EditCourse',$course->id)}}" title="Edit"><i class=" edi pad fa fa-edit"></i></a>
                 <a class="btnsecal deleteButton" data-tooltip="Delete" data-id="{{$course->id}}"  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
                               
							  </td>
                </tr>
				  <?php $i ++; ?>
               @endforeach
                </tbody>
                <tfoot>
               
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
	 <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form id="deleteModalForm">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="delete_id" type="hidden" name="delete_id" value="" />
                        <input type="hidden" name="type"   value="delete_course" />
                        <button class="btn btn-primary" type="submit">Yes</button>
                        <button class="btn btn-default" type="button">Close</button>
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure?.</p>
                    </div>
                    <div class="modal-footer" id="modalFooter">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-default" >Yes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
	     </div>
@endsection

@section('footer')

   <script>
        $(document).ready(function(){
 
            $('.deleteButton').click(function(){

                var prod_id = $(this).attr('data-id');
                $('#delete_id').val(prod_id);
            });
            $("#deleteModalForm").validate({
                errorPlacement: function(error, element) {
                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },

                submitHandler: function(form) {

                    // do other things for a valid form
                    var formData = $("#deleteModalForm").serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            if(data.status == 1){

                                $('.modal-body').html(' Successfully Deleted');
                                $('#modalFooter').addClass('hidden');
                                setTimeout(function(){
                                    location.reload();
                                },1000);

                            }
                        }
                    });
                    return false;
                }

            });

        });
    </script>
@endsection
