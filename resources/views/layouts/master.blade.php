<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@section('title') Dashboard @show</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
{{--    <link rel="stylesheet"--}}
{{--          href="{{asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">--}}
    <!-- iCheck -->
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">--}}
    <!-- JQVMap -->
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/jqvmap/jqvmap.min.css')}}">--}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/assets/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- DataTables -->
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css"--}}
{{--          href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">--}}
    <!-- Daterange picker -->
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">--}}
    <!-- summernote -->
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.css')}}">--}}
    <!-- Select2 -->
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"/>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <style type="text/css">
        .notifyjs-corner {
            z-index: 10000 !important;
        }
    </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('includes.header')
    @include('includes.sidebar')


    @yield('content')
    @if(session()->has('success'))
        <script type="text/javascript">
            $(function () {
                $.notify("{{session()->get('success')}}", {globalPosition: 'top right', className: 'success'});
            });
        </script>
    @endif
    @if(session()->has('error'))
        <script type="text/javascript">
            $(function () {
                $.notify("{{session()->get('error')}}", {globalPosition: 'top right', className: 'error'});
            });
        </script>
@endif
@include('includes.footer')



<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
{{--<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>--}}

<!-- JQVMap -->
{{--<script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>--}}
<!-- jQuery Knob Chart -->
{{--<script src="{{asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>--}}
<!-- daterangepicker -->
{{--<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>--}}
<!-- Tempusdominus Bootstrap 4 -->
{{--<script src="{{asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>--}}
<!-- Summernote -->
{{--<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>--}}
<!-- overlayScrollbars -->
<script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{asset('assets/dist/js/pages/dashboard.js')}}"></script>--}}
<!-- AdminLTE for demo purposes -->
{{--<script src="{{asset('assets/dist/js/demo.js')}}"></script>--}}
<!-- Select2 -->
{{--<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>--}}
<!-- Datatables----------->
{{--<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>--}}
<!-- Datatables----------->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script>
        @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"

    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
<script type="text/javascript">
    window.setTimeout(function () {
        $(".alert").alert('close');
    }, 10000);
</script>
<script type="text/javascript">
    $(document).on('click', '.deleteRecord', function (e) {
        // console.log(id);
        var deleteFunction = $(this).attr('data-action');

        swal({
                title: "Are you sure?",
                text: "You'll not be able to recover this record again!",
                type: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, Delete it!"
            },

            function () {
                window.location.href = deleteFunction;
            });
    });
    $(document).on('click', '.delete_media', function (e) {
        e.preventDefault();
        let form = $(this).attr('data-form');
        let type = $(this).attr('data-type');
        let btn = $(this);

        swal({
                title: "Are you sure?",
                type: "warning",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, Delete it!"
            },

            function () {
                $(btn).parent('section').remove();
                console.log(type);
               if(type=='video'){
                   $('#'+form).append('<input type="hidden" name="is_deleted_video" value="1">')
               } else if(type=='image'){
                   $('#'+form).append('<input type="hidden" name="is_deleted_image" value="1">')
               }
            });
    });
</script>
<script>
    /*
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });


    });
    */

</script>
<script>
    /*
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    */

</script>
@yield('scripts')
<!--Custom Admin Js----->
<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
