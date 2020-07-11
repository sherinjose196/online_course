<!DOCTYPE html>
<html>
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/AdminLTE.min.css') }}">


    <!-- iCheck -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/googleapis.css')  }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>Panel</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form  id="loginForm">
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <span id="error"></span>

            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <a data-toggle="modal" href="#forgotModal">I forgot my password</a><br>
                    </div>
                    </div>

                <!-- /.col -->
                <div class="col-xs-4">
                    <input type="hidden" name="type" value="login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->

            </div>
        </form>

        <!-- /.social-auth-links -->


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<div class="modal modal-success fade" id="loginModal">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Loading Successfully....</h4>
            </div>
            <div class="modal-body text-center"  >
                <p id="loginModalBody" ></p>
                <img src="{{  asset('assets/admin/images/loading.gif') }}"/>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="forgotModal" class="modal fade">
    <div class="modal-dialog" >
        <form id="forgotForm">
           <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Enter your e-mail </h4>
            </div>
            <div class="modal-body text-center"  >
                <p>Enter your e-mail address below to reset your password.</p>
                <input type="text" name="forgot_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                <div class="registration" id="forgot_error"></div>
                <div class="registration" id="forgot_success"></div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" class="form-control" name="type" value="forgotPassword">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- jQuery 3 -->
<script src="{{ asset('assets/admin/css/jquery.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/jquery.validate.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/bootstrap.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/demo.js') }}" type="text/javascript"> </script>

<!-- Bootstrap 3.3.7 -->
<!-- iCheck -->
<script>

    $(document).ready(function() {

        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                },

            },

            errorPlacement: function(error, element) {

                console.log(element.attr('name'));
                $( error ).insertAfter( element);
            },
            submitHandler: function(form) {

                // do other things for a valid form
                var formData = $("#loginForm").serialize();
                $("#loginModalBody").html("Login successfully submitting...please wait while redirecting!");
                $('#loginModal').modal('show');
                $.ajax({
                    type: 'post',
                    url: '{{ URL::route("AdminAuthManage") }}',
                    data: formData,
                    success: function(data){
                        if(data.status == 1){
                            $("#loginModalBody").html("Login Success, you are now being redirected ...");
                            $('#loginModal').modal('show');
                            setInterval(function () {
                                window.location.href = '{{ URL::route('Categorys') }}';
                            }, 1500);
                        }else{
                            $('#loginModal').modal('hide');
                            $('#error').html('<p style="color: red"><strong>Invalid!</strong> password or email...</p>');
                        }


                    }
                });




                return false;
            }
        });

        $("#forgotForm").validate({
            rules: {
                forgot_email: {
                    required: true,
                }

            },

            errorPlacement: function(error, element) {

                console.log(element.attr('name'));
                $( error ).insertAfter( element);
            },
            submitHandler: function(form) {
                // do other things for a valid form
                var formData = $("#forgotForm").serialize();
                $('#forgotModal').modal('hide');
                $("#loginModalBody").html("Mail successfully submitting...");
                $('#loginModal').modal('show');
                $.ajax({
                    type: 'post',
                    url: '{{ URL::route("AdminAuthManage") }}',
                    data: formData,
                    success: function(data){
                        if(data.status == 1) {
                            $("#loginModalBody").html("Mail successfully submitted, Please Check your mail...");
                            $('#loginModal').modal('show');
                            setInterval(function () {
                                location.reload();
                            }, 1500);

                        }else if(data.status == 2){
                            $('#loginModal').modal('hide');
                            $('#forgotModal').modal('show');
                            $('#forgot_error').html(data.html);
                        }
                    }
                });
                return false;
            }
        });
    });

</script>
</body>
</html>
