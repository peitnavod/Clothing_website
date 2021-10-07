@extends('layouts.admin')
@section('title')
    <title>Slider</title>
@endsection
@section('css')

    <link href="{{asset('../admins/products/add/add.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Slider', 'key' => 'Add'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Ten slider</label>
                                <input  name="name" class="form-control"  placeholder="Nhap ten slider">

                            </div>
                            <div class="form-group">
                                <label>Nhap mo ta</label>
                                <textarea name="description" class="form-control my-editor">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Hinh anh slider</label>
                                <input  name="image_path" type="file" class="form-control-file" >
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script src="{{asset('../vendors/select2/select2.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('../admins/products/add/add.js')}}"></script>

@endsection
