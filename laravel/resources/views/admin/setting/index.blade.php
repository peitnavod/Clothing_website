@extends('layouts.admin')
@section('title')
    <title>Setting</title>
@endsection
@section('css')
   <link rel="stylesheet" href ="{{asset('../admins/settings/index/list.css')}}">
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('../admins/settings/index/list.js')}}"></script>
@endsection
@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Setting', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                Add Setting
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a href="{{route('settings.create') .'?type=Text'}}">Text</a></li>
                                <li><a href="{{route('settings.create') .'?type=TextArea'}}">TextArea</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $settingItem)
                                <tr>
                                    <th scope="row">{{$settingItem->id}}</th>
                                    <td>{{$settingItem->config_key}}</td>
                                    <td>{{$settingItem->config_value}}</td>
                                    <td>
                                        <a href="{{route('settings.edit',['id'=>$settingItem->id])}}" class="btn btn-default">Edit</a>
                                        <a data-url="{{route('settings.delete',['id'=>$settingItem->id])}}"
                                            class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$settings->links()}}
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
