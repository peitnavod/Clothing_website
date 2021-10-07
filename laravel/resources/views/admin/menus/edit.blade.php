@extends('layouts.admin')
@section('title')
    <title>Trang chu</title>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Menu', 'key' => 'Edit'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('menus.update',['id'=>$menu->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Ten menu</label>
                                <input  name="name" class="form-control" value="{{$menu->name}}"  placeholder="Nhap ten menu">

                            </div>
                            <div class="form-group">
                                <label>Chon menu cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chon menu  cha</option>
                                    {!! $optionMenu !!}
                                </select>
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
