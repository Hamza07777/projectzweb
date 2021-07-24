@extends('layouts.master')
@section('title',isset($vaccineCenter)?'Vaccine Center | Edit':'Vaccine Center | Add New')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Vaccine Center | {{isset($vaccineCenter)?'Edit':'Add New'}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('vaccine-center.index')}}">Vaccine Center</a>
                            </li>
                            <li class="breadcrumb-item active">{{isset($vaccineCenter)?'Edit':'Add New'}}</li>
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
                            <form method="post"
                                  action="{{isset($vaccineCenter)?route('vaccine-center.update',$vaccineCenter->id):route('vaccine-center.store')}}">
                                @csrf
                                @if(isset($vaccineCenter))
                                    @method('patch')
                                @endif
                                <small class="text-info">*All fields are required</small>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" autocomplete="new-name" required
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{old('name') ?? $vaccineCenter->name ?? ''}}"
                                            >
                                        </div>
                                        @error('name')
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
                                                   value="{{old('lga') ?? $vaccineCenter->lga ?? ''}}">
                                        </div>
                                        @error('lga')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="state">State</label>
                                            <input type="text" name="state" id="state" autocomplete="new-state" required
                                                   class="form-control  @error('state') is-invalid @enderror"
                                                   value="{{old('state') ?? $vaccineCenter->state ?? ''}}">
                                        </div>
                                        @error('state')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="person_in_charge">Person In Charge</label>
                                            <input type="number" name="person_in_charge" id="person_in_charge" required
                                                   class="form-control  @error('person_in_charge') is-invalid @enderror"
                                                   value="{{old('person_in_charge') ?? $vaccineCenter->person_in_charge ?? ''}}">
                                        </div>
                                        @error('person_in_charge')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="sent_vaccines">How many vaccines sent</label>
                                            <input type="number" name="sent_vaccines" id="sent_vaccines" required
                                                   class="form-control  @error('sent_vaccines') is-invalid @enderror"
                                                   value="{{old('sent_vaccines') ?? $vaccineCenter->sent_vaccines ?? ''}}">
                                        </div>
                                        @error('sent_vaccines')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary">{{isset($vaccineCenter)?'Update':'Save'}}</button>
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
