@extends('layouts.master')
@section('title',isset($vaccineDetail)?'Vaccine Detail | Edit':'Vaccine Detail | Add New')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Vaccine Detail | {{isset($vaccineDetail)?'Edit':'Add New'}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('vaccine-detail.index')}}">Vaccine Detail</a>
                            </li>
                            <li class="breadcrumb-item active">{{isset($vaccineDetail)?'Edit':'Add New'}}</li>
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
                                  action="{{isset($vaccineDetail)?route('vaccine-detail.update',$vaccineDetail->id):route('vaccine-detail.store')}}">
                                @csrf
                                @if(isset($vaccineDetail))
                                    @method('patch')
                                @endif
                                <small class="text-info">*All fields are required</small>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" autocomplete="new-name" required
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{old('name') ?? $vaccineDetail->name ?? ''}}"
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
                                            <label for="type">Type</label>
                                            <input type="text" name="type" id="type" required
                                                   class="form-control  @error('type') is-invalid @enderror"
                                                   value="{{old('type') ?? $vaccineDetail->type ?? ''}}">
                                        </div>
                                        @error('type')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="image">{{isset($vaccineDetail)?'Replace Image':'Image'}}</label>
                                            <input type="file" accept="image/*" name="image" id="image" {{isset($vaccineDetail)?'':'required'}}
                                                   class="form-control  @error('image') is-invalid @enderror">
                                            @if(isset($vaccineDetail))
                                                <img src="{{asset($vaccineDetail->image)}}" class="mt-3"
                                                     alt="image" width="" height="100">
                                            @endif
                                        </div>
                                        @error('image')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label for="detail">Detail</label>
                                            <textarea name="detail" id="detail" rows="5" class="summernote form-control
                                            @error('detail') is-invalid @enderror">{!! old('detail')??$vaccineDetail->detail??'' !!}</textarea>
                                        </div>
                                        @error('detail')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row d-flex justify-content-end mt-3">
                                    <button type="submit"
                                            class="btn btn-primary">{{isset($vaccineDetail)?'Update':'Save'}}</button>
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
    <script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        });
    </script>
@endsection
