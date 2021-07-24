@extends('layouts.master')
@section('title',isset($alert)?'Alert | Edit':'Alert | Add New')
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
                        <h1>Alert | {{isset($alert)?'Edit':'Add New'}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('alert.index')}}">Alert</a>
                            </li>
                            <li class="breadcrumb-item active">{{isset($alert)?'Edit':'Add New'}}</li>
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
                            <form method="post" enctype="multipart/form-data" id="alert_form"
                                  action="{{isset($alert)?route('alert.update',$alert->id):route('alert.store')}}">
                                @csrf
                                @if(isset($alert))
                                    @method('patch')
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label for="image">{{isset($alert)?'Replace Image':'Image'}}</label>
                                            <input type="file" accept="image/*" name="image" id="image"
                                                   class="form-control  @error('image') is-invalid @enderror">
                                            @error('image')
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                                @if(isset($alert) && $alert->image)
                                                    <section>
                                                <img src="{{asset($alert->image)}}" class="mt-3"
                                                     alt="image" width="" height="100"><br>
                                                <button data-form="alert_form" data-type="image"
                                                        class="mt-2 delete_media btn btn-danger btn-sm">Delete</button>
                                                </section>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label for="video">{{isset($alert)?'Replace Video':'Video'}}</label>
                                            <input type="file" accept="video/*" name="video" id="video"
                                                   class="form-control  @error('video') is-invalid @enderror">
                                            <small class="text-secondary">(Supported extension: <b>ogm, wmv, mpg, webm,
                                                    ogv, mov, asx, mpeg, mp4, m4v, avi, mov, 3gp, flv, mkv</b>. Max file
                                                Siz: <b>5MB</b>)</small>
                                            @error('video')
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                                @if(isset($alert) && $alert->video)
                                                    <section class="mt-2">
                                                <video src="{{asset($alert->video)}}" controls
                                                       style="width: 100%;height: 300px"></video>
                                                <button data-form="alert_form" data-type="video"
                                                        class="delete_media btn btn-danger btn-sm">Delete</button>
                                                </section>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label for="description">Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="description" id="description" required class="summernote form-control
                                            @error('description') is-invalid @enderror">{!! old('description')??$alert->description??'' !!}</textarea>
                                        </div>
                                        @error('description')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row d-flex justify-content-end mt-3">
                                    <button type="submit"
                                            class="btn btn-primary">{{isset($alert)?'Update':'Save'}}</button>
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
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endsection
