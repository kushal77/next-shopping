@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.emi.index')}}">EMI</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('title')
    EMI Rates
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
                            <h3 class="card-title">Edit EMI Rate</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{ Form::model($emi_rate, ['route' => ['admin.emi.update', $emi_rate->id], 'method' => 'PUT',"enctype"=>"multipart/form-data"]) }}
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::label('months', 'No. of Months *') }}
                                    {{ Form::number('months', null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('rate', 'Rate *') }}
                                    {{ Form::number('rate',null,['class' => 'form-control']) }}
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
