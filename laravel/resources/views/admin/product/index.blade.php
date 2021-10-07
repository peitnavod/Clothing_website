@extends('layouts.admin')
@section('title')
    <title> Product</title>
@endsection
@section('css')
<link rel="stylesheet" href ="{{asset('../admins/products/index/list.css')}}" >
@endsection
@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Product', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('product.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Ten san pham</th>
                                <th scope="col">Gia</th>
                                <th scope="col">Hinh Anh</th>
                                <th scope="col">Danh Muc</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $item)

                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>
                                        <img class="product_image_150_100" src="{{$item->image_path}}" alt="">
                                    </td>
                                    <td>
                                        {{optional($item->category)->name}}
                                    </td>

                                    <td>
                                        <a href="{{route('product.edit',['id' => $item->id])}}" class="btn btn-default">Edit</a>
                                      <a
                                         data-url ="{{route('product.delete',['id'=> $item->id])}}"
                                         class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src ="{{asset('../admins/products/index/list.js')}}" ></script>
@endsection
