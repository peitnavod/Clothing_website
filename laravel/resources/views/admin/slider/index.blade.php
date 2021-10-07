@extends('layouts.admin')
@section('title')
    <title>Slider</title>
@endsection
@section('css')
    <link rel="stylesheet" href ="{{asset('../admins/products/index/list.css')}}" >
@endsection

@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Slider', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('sliders.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ten Slider</th>
                                <th scope="col">Mo ta</th>
                                <th scope="col">Hinh anh</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $sliderItem)
                                <tr>
                                    <th scope="row">{{$sliderItem->id}}</th>
                                    <td>{{$sliderItem->name}}</td>
                                    <td>{{$sliderItem->description}}</td>
                                    <td>
                                        <img src="{{$sliderItem->image_path}}" class="product_image_150_100">
                                    </td>
                                    <td>
                                        <a href="{{route('sliders.edit',['id'=>$sliderItem->id])}}" class="btn btn-default">Edit</a>
                                        <a  data-url="{{route('sliders.delete',['id'=>$sliderItem->id])}}"
                                            class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                  {{--  <div class="col-md-12">
                        {{$menus->links()}}
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src ="{{asset('../admins/sliders/list.js')}}" ></script>
@endsection
