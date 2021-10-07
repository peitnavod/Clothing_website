@extends('layouts.admin')
@section('title')
    <title>Product</title>
@endsection
@section('css')

    <link href="{{asset('../vendors/select2/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('../admins/products/add/add.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href ="{{asset('../admins/products/index/list.css')}}" >
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Product', 'key' => 'Edit'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('product.update',['id' => $product->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Ten san pham</label>
                                <input value="{{$product->name}}"  name="name" class="form-control"  placeholder="Nhap ten san pham">
                            </div>
                            <div class="form-group">
                                <label>Gia san pham</label>
                                <input  value="{{$product->price}}" name="price" class="form-control"  placeholder="Nhap gia san pham">
                            </div>

                            <div class="form-group">
                                <label>Hinh anh san pham</label>
                                <input value="{{$product->image_path}}" name="image_path" type="file" class="form-control-file" >
                            </div>
                            <div class="col-md-12">
                                    <div class="row">
                                        <img class="product_image_150_100" src="{{$product->image_path}}" alt="">
                                    </div>
                            </div>

                            <div class="form-group">
                                <label>Hinh anh chi tiet</label>
                                <input  name="list_image_path[]" type="file"
                                        multiple class="form-control-file" >
                                <div class="col-md-12">
                                    <div class="row">
                                        @foreach($product->images as $listImageDetails)
                                            <img class="product_image_150_100" src="{{$listImageDetails->list_image_path}}" alt="">
                                        @endforeach

                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Chon danh muc</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="0">Chon danh muc </option>
                                    {!! $htmlOption !!}

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Chon Tag</label>
                                <select name="tags[]" class="form-control  tags_select_choose" multiple="multiple">
                                    @foreach($product->tags as $tagItem)
                                        <option selected value="{{$tagItem->id}}">{{$tagItem->name}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Nhap noi dung</label>
                                <textarea  name="content" class="form-control my-editor">{{$product->content}}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('../vendors/select2/select2.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('../admins/products/add/add.js')}}"></script>

@endsection
