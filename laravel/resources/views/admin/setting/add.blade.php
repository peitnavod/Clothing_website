@extends('layouts.admin')
@section('title')
    <title>Setting</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Setting', 'key' => 'Add'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('settings.store'). '?type=' . request()->type}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Config key</label>
                                <input type="text"
                                       name="config_key"
                                       class="form-control @error('config_key') is-invalid @enderror"
                                       placeholder="Nhap config key">
                            </div>
                            @error('config_key')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                            @if(request()->type === 'Text')
                                <div class="form-group">
                                    <label>Config value</label>
                                    <input type="text"
                                           name="config_value"
                                           class="form-control @error('config_value') is-invalid @enderror"
                                           placeholder="Nhap config value">
                                </div>
                                @error('config_value')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            @elseif(request()->type === 'TextArea')
                                <div class="form-group">
                                    <label>Config value</label>
                                    <textarea
                                        name="config_value"
                                        class="form-control @error('config_value') is-invalid @enderror"
                                        rows="5"
                                        placeholder="Nhap config value"></textarea>
                                </div>
                                @error('config_value')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            @endif

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
