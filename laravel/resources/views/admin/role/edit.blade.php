@extends('layouts.admin')
@section('title')
    <title>Role</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{(asset('../admins/Role/add.css'))}}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Role', 'key' => 'Edit'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <form action="{{route('roles.update',['id'=>$role->id])}}" method="post" enctype="multipart/form-data" style="width: 100%;">
                        <div class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label>Ten role</label>
                                <input name="name"
                                       class="form-control"
                                       placeholder="Nhap ten role"
                                       value="{{$role->name}}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Nhap mo ta role</label>
                                <textarea name="display_name" class="form-control ">{{$role->display_name}}</textarea>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="checkbox" class="checkbox_all">
                                        checked all
                                    </label>
                                </div>
                            <div class="row">
                                @foreach($permission as $permissionItem)
                                    <div class="card border-primary mb-3 col-md-12">
                                        <div class="card-header">
                                            <label>
                                                <input type="checkbox"
                                                       value=""
                                                       class="checkbox_wrapper">
                                            </label>
                                            {{$permissionItem->name}}
                                        </div>
                                        <div class="row">
                                            @foreach($permissionItem->permissionChildrent as $permissionChildrentItem)
                                                <div class="card-body text-primary col-md-3">
                                                    <h5 class="card-title">
                                                        <label>

                                                            <input type="checkbox" name="permission_id[]"
                                                                   class="checkbox_child"
                                                                   {{$permissionOfRole->contains('id',$permissionChildrentItem->id)?'checked':''}}
                                                                   value="{{$permissionChildrentItem->id}}">
                                                        </label>
                                                            {{$permissionChildrentItem->name}}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')
    <script src="{{asset('../admins/Role/add.js')}}"></script>
@endsection
