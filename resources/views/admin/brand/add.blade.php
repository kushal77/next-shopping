@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.brand.index')}}">Brand</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('title')
    Brand
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
                            <h3 class="card-title">Add Brand</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{ Form::open(['route' => 'admin.brand.store',"enctype"=>"multipart/form-data"]) }}
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::label('title', 'Title *') }}
                                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('image', 'Logo *') }}
                                    {{ Form::file('image', ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('cat_image', 'Category Image *') }}
                                    {{ Form::file('cat_image', ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('cat_bg_image', 'Category Background Image *') }}
                                    {{ Form::file('cat_bg_image', ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('metatitle', 'Meta Title *') }}
                                    {{ Form::text('metatitle', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Title']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('metakey', 'Meta Key *') }}
                                    {{ Form::text('metakey', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Key']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('metadesc', 'Meta Description *') }}
                                    {{ Form::text('metadesc', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Description']) }}
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