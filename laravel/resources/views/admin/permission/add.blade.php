@extends('layouts.admin')
@section('title')
    <title>Trang chu</title>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Permission', 'key' => 'Add'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('permissions.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Chon ten module</label>
                                <select class="form-control" name="module_parent">
                                    <option selected value="">Chon ten module</option>
                                  @foreach(config('permissions.table_module') as $moduleItem)
                                      <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">

                                    @foreach(config('permissions.module_childrent') as $module_childrentItem)
                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" value="{{$module_childrentItem}}" name="module_child[]">
                                            {{$module_childrentItem}}
                                        </label>
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
    </div>
@endsection
