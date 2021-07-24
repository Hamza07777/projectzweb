@extends('layouts.master')
@section('title',isset($user)?'User | Edit':'User | Add New')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datepicker/css/datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User | {{isset($user)?'Edit':'Add New'}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
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
                            <form method="post" enctype="multipart/form-data"
                                  action="{{isset($user)?route('users.update',$user->id):route('users.store')}}">
                                @csrf
                                @if(isset($user))
                                    @method('patch')
                                @endif
                                @if(isset($user->profile->barcode))
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="{{asset($user->profile->barcode)}}" style="width: 15%" alt="barcode">
                                    </div>
                                </div>
                                @endif
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="first_name">First Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="first_name" id="first_name" required
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   value="{{old('first_name') ?? $user->profile->first_name ?? ''}}"
                                            >
                                        </div>
                                        @error('first_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="middle_name">Middle Name</label>
                                            <input type="text" name="middle_name" id="middle_name"
                                                   class="form-control @error('middle_name') is-invalid @enderror"
                                                   value="{{old('middle_name') ?? $user->profile->middle_name ?? ''}}"
                                            >
                                        </div>
                                        @error('middle_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" id="last_name" required
                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                   value="{{old('last_name') ?? $user->profile->last_name ?? ''}}"
                                            >
                                        </div>
                                        @error('last_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- /.col -->

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <div class="input-group  mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" name="email" autocomplete="off" id="email"
                                                   required class="form-control @error('email') is-invalid @enderror"
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
                                            <label for="password">Password
                                                @if(!isset($user))
                                                <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="password" name="password" autocomplete="new-password"
                                                   id="password" {{isset($user)?'':'required'}}
                                                   class="form-control  @error('password') is-invalid @enderror">
                                        </div>
                                        @if(isset($user))
                                            <small class="text-secondary">(Leave this field blank if you don't want to
                                                change the password)</small>
                                        @endif
                                        @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" autocomplete="off" name="dob" id="dob" required
                                                   class="form-control datepicker @error('dob') is-invalid @enderror"
                                                   value="{{old('dob') ?? $user->profile->dob ?? ''}}">
                                        </div>
                                        @error('dob')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" name="phone_number" id="phone_number" required
                                                   class="form-control  @error('phone_number') is-invalid @enderror"
                                                   value="{{old('phone_number') ?? $user->profile->phone_number ?? ''}}">
                                        </div>
                                        @error('phone_number')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="image">{{isset($user)?'Replace Image':'Image'}}
                                                @if(!isset($user))
                                                <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" accept="image/*" name="image" id="image"
                                                   {{isset($user)?'':'required'}}
                                                   class="form-control  @error('image') is-invalid @enderror">
                                            @if(isset($user->profile->image))
                                                <img src="{{asset($user->profile->image)}}" class="mt-3"
                                                     alt="image" width="" height="100">
                                            @endif
                                        </div>
                                        @error('image')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="city">City/LGA <span class="text-danger">*</span></label>
                                            <input type="text" name="city" id="city" required
                                                   class="form-control  @error('city') is-invalid @enderror"
                                                   value="{{old('city') ?? $user->profile->city ?? ''}}">
                                        </div>
                                        @error('city')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="vaccine_center">Vaccine Center <span class="text-danger">*</span></label>
                                            <select name="vaccine_center" required
                                                    class="form-control select2bs4 @error('vaccine_center') is-invalid @enderror"
                                                    id="vaccine_center">
                                                <option value="" selected disabled>Select Vaccine Center</option>
                                                @if(count($vaccineCenters))
                                                    @foreach($vaccineCenters as $row)
                                                        <option
                                                            value="{{$row->id}}" {{old('vaccine_center')&&old('vaccine_center')==$row->id?'selected':(isset($user->profile->vaccine_center)&&$user->profile->vaccine_center==$row->id?'selected':'')}}>{{$row->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @error('vaccine_center')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="test_result">Test Result <span class="text-danger">*</span></label>
                                            <input type="text" name="test_result" id="test_result" required
                                                   class="form-control  @error('test_result') is-invalid @enderror"
                                                   value="{{old('test_result') ?? $user->profile->test_result ?? ''}}">
                                        </div>
                                        @error('test_result')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="state_of_origin">State of Origin <span class="text-danger">*</span></label>
                                            <input type="text" name="state_of_origin" id="state_of_origin" required
                                                   class="form-control  @error('state_of_origin') is-invalid @enderror"
                                                   value="{{old('state_of_origin') ?? $user->profile->state_of_origin ?? ''}}">
                                        </div>
                                        @error('state_of_origin')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-8">
                                        <div class="form-group mb-0">
                                            <label for="address">Address <span class="text-danger">*</span></label>
                                            <input type="text" name="address" autocomplete="new-address" id="address"
                                                   required
                                                   class="form-control  @error('address') is-invalid @enderror"
                                                   value="{{old('address') ?? $user->profile->address ?? ''}}">
                                        </div>
                                        @error('address')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
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
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $('.datepicker').datepicker({
            orientation: "bottom"
        });
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    </script>
@endsection
