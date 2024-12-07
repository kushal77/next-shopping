@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item">Setting</li>
@endsection

@section('title')
    Setting
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Setting</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{ Form::open(['route' => 'admin.setting.update',"enctype"=>"multipart/form-data"]) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach($settings as $setting)
                                            <div class="form-group">
                                                <label for="{{$setting->code}}">{{$setting->label}} *</label>
                                                <input class="form-control" placeholder="Enter {{$setting->label}}" name="appsetting[{{$setting->code}}]" type="text" value="{{$setting->value}}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        {{ Form::close() }}
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection