@extends('layouts.admin')
@section('title')
    <title>User</title>
@endsection
@section('css')
    <link rel="stylesheet" href ="{{asset('../admins/products/index/list.css')}}" >
@endsection

@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'User', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('users.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ten </th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $userItem)
                                <tr>
                                    <th scope="row">{{$userItem->id}}</th>
                                    <td>{{$userItem->name}}</td>
                                    <td>{{$userItem->email}}</td>

                                    <td>
                                        <a href="{{route('users.edit',['id'=>$userItem->id])}}" class="btn btn-default">Edit</a>
                                        <a  data-url="{{route('users.delete',['id'=>$userItem->id])}}"
                                            class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                      <div class="col-md-12">
                          {{$users->links()}}
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
