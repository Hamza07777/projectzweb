@extends('layouts.master')
@if(isset($account))
    @section('title','Account | Update Profile')
@else
    @section('title',isset($user)?'Sub Admin | Edit':'Sub Admin | Add New')
@endif
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datepicker/css/datepicker.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if(isset($account))
                            <h1>Account | Update Profile</h1>
                        @else
                            <h1>Sub Admin | {{isset($user)?'Edit':'Add New'}}</h1>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item">
                                @if(isset($account))
                                    <a href="{{route('userUpdate')}}">Update Profile</a>
                                @else
                                    <a href="{{route('sub-admin.index')}}">Sub Admin</a>
                                @endif
                            </li>
                            <li class="breadcrumb-item active">{{isset($user)?'Edit':'Add New'}}</li>
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
                            @if(isset($account))
                                <form method="post"
                                      action="{{route('userUpdate')}}">
                                    @else
                                        <form method="post"
                                              action="{{isset($user)?route('sub-admin.update',$user->id):route('sub-admin.store')}}">
                                            @if(isset($user))
                                                @method('patch')
                                            @endif
                                            @endif
                                            @csrf
                                            <small class="text-info">*All fields are required</small>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-0">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" id="name" autocomplete="new-name"
                                                               required
                                                               class="form-control @error('name') is-invalid @enderror"
                                                               value="{{old('name') ?? $user->name ?? ''}}"
                                                        >
                                                    </div>
                                                    @error('name')
                                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="email">Email</label>
                                                    <div class="input-group  mb-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-envelope"></i></span>
                                                        </div>
                                                        <input type="email" name="email" autocomplete="off" id="email"
                                                               required
                                                               class="form-control @error('email') is-invalid @enderror"
                                                               value="{{old('email') ?? $user->email ?? ''}}">
                                                    </div>
                                                    @error('email')
                                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-0">
                                                        <label for="password">Password</label>
                                                        <input type="password" name="password"
                                                               autocomplete="new-password"
                                                               id="password" {{isset($user)?'':'required'}}
                                                               class="form-control  @error('password') is-invalid @enderror">
                                                    </div>
                                                    @if(isset($user))
                                                        <small class="text-secondary">(Leave this field blank if you
                                                            don't want to
                                                            change the password)</small>
                                                    @endif
                                                    @error('password')
                                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                                <!-- /.col -->

                                            </div>
                                            @if(!isset($admin))
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="dob">Date of Birth</label>
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-calendar"></i></span>
                                                        </div>
                                                        <input type="text" autocomplete="off" name="dob" id="dob"
                                                               required
                                                               class="form-control datepicker @error('dob') is-invalid @enderror"
                                                               value="{{old('dob') ?? $user->subAdmin->dob ?? ''}}">
                                                    </div>
                                                    @error('dob')
                                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-0">
                                                        <label for="profession">Profession</label>
                                                        <input type="text" name="profession" id="profession" required
                                                               class="form-control  @error('profession') is-invalid @enderror"
                                                               value="{{old('profession') ?? $user->subAdmin->profession ?? ''}}">
                                                    </div>
                                                    @error('profession')
                                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-0">
                                                        <label for="lga">LGA</label>
                                                        <input type="text" name="lga" id="lga" required
                                                               class="form-control  @error('lga') is-invalid @enderror"
                                                               value="{{old('lga') ?? $user->subAdmin->lga ?? ''}}">
                                                    </div>
                                                    @error('lga')
                                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-8">
                                                    <div class="form-group mb-0">
                                                        <label for="address">Address</label>
                                                        <input type="text" name="address" autocomplete="new-address"
                                                               id="address"
                                                               required
                                                               class="form-control  @error('address') is-invalid @enderror"
                                                               value="{{old('address') ?? $user->subAdmin->address ?? ''}}">
                                                    </div>
                                                    @error('address')
                                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-0">
                                                        <label for="state">State</label>
                                                        <input type="text" name="state" id="state"
                                                               autocomplete="new-state" required
                                                               class="form-control  @error('state') is-invalid @enderror"
                                                               value="{{old('state') ?? $user->subAdmin->state ?? ''}}">
                                                    </div>
                                                    @error('state')
                                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif
                                            <div class="row d-flex justify-content-end mt-3">
                                                <button type="submit"
                                                        class="btn btn-primary">{{isset($user)?'Update':'Save'}}</button>
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
@section('scripts')
    <script src="{{asset('assets/plugins/datepicker/js/datepicker.js')}}"></script>
    <script>
        $('.datepicker').datepicker({
            orientation: "bottom"
        });
    </script>
@endsection
