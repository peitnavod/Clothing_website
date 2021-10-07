@extends('layouts.admin')
@section('title')
    <title>Role</title>
@endsection
@section('css')
    <link rel="stylesheet" href ="{{asset('../admins/products/index/list.css')}}" >
@endsection

@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Role', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('roles.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ten Role</th>
                                <th scope="col">Mo ta Role</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $roleItem)
                                <tr>
                                    <th scope="row">{{$roleItem->id}}</th>
                                    <td>{{$roleItem->name}}</td>
                                    <td>{{$roleItem->display_name}}</td>
                                    <td>
                                        <a href="{{route('roles.edit',['id'=>$roleItem->id])}}" class="btn btn-default">Edit</a>
                                     {{--   <a  data-url="{{route('sliders.delete',['id'=>$sliderItem->id])}}"
                                            class="btn btn-danger action_delete">Delete</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                      <div class="col-md-12">
                          {{$roles->links()}}
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src ="{{asset('../admins/sliders/list.js')}}" ></script>
@endsection
