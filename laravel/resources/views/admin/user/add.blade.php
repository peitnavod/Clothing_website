@extends('layouts.admin')
@section('title')
    <title>User</title>
@endsection
@section('css')
    <link href="{{asset('../vendors/select2/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('../admins/products/add/add.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'User', 'key' => 'Add'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Nhap Name</label>
                                <input  name="name" class="form-control"  placeholder="Nhap ten user">

                            </div>

                            <div class="form-group">
                                <label>Nhap email</label>
                                <input  name="email" class="form-control"  placeholder="Nhap email">
                            </div>
                            <div class="form-group">
                                <label>Nhap Password</label>
                                <input type="password"  name="password" class="form-control"  placeholder="Nhap Password">
                            </div>
                            <div class="form-group">
                                <label>Chon vai tro</label>
                                <select name="role_id[]" class="form-control select2_init" multiple>
                                    @foreach($roles as $roleItem)
                                        <option value="{{$roleItem->id}}">{{$roleItem->name}}</option>
                                    @endforeach
                                    <option value="">admin</option>

                                </select>
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
    <script src="{{asset('../admins/products/add/add.js')}}"></script>

@endsection
