@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.faq.index')}}">Faq</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('title')
    Faq
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
                            <h3 class="card-title">Add Faq</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{ Form::open(['route' => 'admin.faq.store']) }}
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::label('question', 'Question *') }}
                                    {{ Form::text('question', null, ['class' => 'form-control', 'placeholder' => 'Enter Question']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('answer', 'Answer*') }}
                                    {{ Form::textarea('answer', null, ['class' => 'form-control', 'id' => 'textare']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('status', 'Status') }}
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