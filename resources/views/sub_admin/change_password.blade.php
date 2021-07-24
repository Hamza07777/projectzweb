@extends('layouts.master')
@section('title','Account | Change Password')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Account | Change Password</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('changePassword')}}">Change Password</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data"
                                  action="{{route('changePassword')}}">
                                @csrf
                                <div class="row mt-3 d-flex justify-content-center">
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="current_password">Current Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="current_password" id="current_password" required
                                                   class="form-control @error('current_password') is-invalid @enderror"
                                            >
                                        </div>
                                        @error('current_password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3 d-flex justify-content-center">
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="password">New Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="password" id="password" required
                                                   class="form-control @error('password') is-invalid @enderror"
                                            >
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3 d-flex justify-content-center">
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="new_password">Confirm New Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="new_password" id="new_password" required
                                                   class="form-control @error('new_password') is-invalid @enderror"
                                            >
                                        </div>
                                        @error('new_password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-end mt-3">
                                    <button type="submit"
                                            class="btn btn-primary">Update</button>
                                </div>
                            </form>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
