<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Online Course</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->

    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/_all-skins.min.css') }}">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/googleapis.css')  }}">

    @yield('header')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Left side column. contains the logo and sidebar -->
    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b></b>Online Course</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('assets/admin/images/download.png') }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">Settings</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset('assets/admin/images/download.png') }}" class="img-circle" alt="User Image">
                                <p>
                                   
                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ URL::route('AdminLogout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('assets/admin/images/download.png') }}" class="img-circle" alt="User Image"> </img>
                </div>
                <div class="pull-left info">
                    
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">

                <li class="treeview">

                        <li><a href="{{ URL::route('Categorys') }}"><i class="fa fa-circle-o"></i> Categorys </a></li>
                        <li><a href="{{ URL::route('Courses') }}"><i class="fa fa-circle-o"></i> Courses </a></li>
                        


                </li>
            </ul>

        </section>
    </aside>

    <section id="content">
        @yield('content')
    </section>
    {{--Delete Modal--}}

    <div class="modal modal-danger fade in" id="deleteModal" >
        <div class="modal-dialog">
            <form id="deleteForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Delete Data </h4>
                    </div>
                    <div class="modal-body">
                        <p>Do you want delete this data ?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="type" id="type">
                        <input type="hidden" name="delete_id" id="delete_id">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline">Delete</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{--Loading Modal--}}
    <div class="modal modal-success fade" id="messageModal">
        <div class="modal-dialog" >
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Loading Successfully....</h4>
                </div>
                <div class="modal-body text-center"  >
                    <p id="messageModalBody" ></p>
                    <img src="{{  asset('assets/admin/images/loading.gif') }}"/>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="{{ asset('assets/admin/js/jquery-1.10.2.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/jquery.validate.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/jquery-ui-1.9.2.custom.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/jquery-migrate-1.2.1.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/bootstrap.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/modernizr.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/jquery.nicescroll.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/dataTables.bootstrap.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/jquery.slimscroll.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/fastclick.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/adminlte.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/demo.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/scripts.js') }}" type="text/javascript"> </script>
<script type="text/javascript" src="{{ url('assets/admin/js/jquery.fileupload.js') }}"></script>

<!-- page script -->

@yield('footer')
<script>
    $(function () {
        $('#sorting').dataTable( {
            "order": [],
            // Your other options here...
        } );

    })
</script>
</body>
</html>
