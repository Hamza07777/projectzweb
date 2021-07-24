@extends('layouts.master')
@section('title','Users')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">

            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                     
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Vaccine Center</th>
                                    <th>Test Result</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                        <tr>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->profile->phone_number ?? '-'}}</td>
                                            <td>{{$row->profile->vaccineCenter->name ?? '-'}}</td>
                                            <td>{{$row->profile->test_result ?? '-'}}</td>

                                        </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Vaccine Center</th>
                                    <th>Test Result</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('scripts')
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script>
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
    </script>
@endsection
