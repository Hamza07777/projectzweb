@extends('layouts.master')
@section('title','Vaccine Centers')
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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Vaccine Centers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Vaccine Centers</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            <a href="{{route('vaccine-center.create')}}">
                                <button class="btn btn-primary btn-sm">Add New</button>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>State</th>
                                    <th>LGA</th>
                                    <th>Person In Charge</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($vaccines))
                                    @foreach($vaccines as $row)
                                        <tr>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->state}}</td>
                                            <td>{{$row->lga}}</td>
                                            <td>{{$row->person_in_charge}}</td>
                                            <td>
                                                <a href="{{route('vaccine-center.edit',$row->id)}}">
                                                <i class="fa fa-edit text-primary mr-2"></i>
                                                </a>
                                                <a href="javascript:void(0)" data-action="{{route('vaccineCenterDestroy',$row->id)}}" class="deleteRecord">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>State</th>
                                    <th>LGA</th>
                                    <th>Person In Charge</th>
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
