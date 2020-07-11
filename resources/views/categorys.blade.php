@extends('layouts.admin')

@section('header')
@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <div class="box-header">
                            <h3 class="box-title"><a href="{{URL::route('NewCategory')}}"  class="btn btn-info">Create New </a></h3>
              
                        </div>
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Categorys</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
         
         <th class="sorting">Sl No</th>
                  <th>Name</th>
                  
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
        <?php $i =1 ?>
        @foreach($categorys as $category)
        
                <tr>
        
                 
                  <td>{{ $i}}</td>
                  <td>{{$category->category}}</td>
                  
                  <td>
         <a class="btnsedit " data-tooltip="Edit" data-id="{{$category->cat_id}}" href="{{URL::route('EditCategory',$category->cat_id)}}" title="Edit"><i class=" edi pad fa fa-edit"></i></a>
                 <a class="btnsecal deleteButton" data-tooltip="Delete" data-id="{{$category->cat_id}}"  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
                               
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
                        <input type="hidden" name="type"   value="delete_category" />
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

                var cat_id = $(this).attr('data-id');
                
                $('#delete_id').val(cat_id);
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
