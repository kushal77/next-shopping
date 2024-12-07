@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.coupon.index')}}">Coupon</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('title')
    Coupon
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
                            <h3 class="card-title">Add Coupon</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{ Form::open(['route' => 'admin.coupon.store',"enctype"=>"multipart/form-data"]) }}
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::label('title', 'Title *') }}
                                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('code', 'Code *') }}
                                    {{ Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Enter Code']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('discount', 'Discount *') }}
                                    {{ Form::number('discount', 0.00, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('status', 'Status *') }}
                                    {{ Form::select('status',['' => 'Select Status','1'=>'Publish','2'=>'Unpublish'], null, ['class' => 'form-control select2']) }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        {{ Form::close() }}
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection