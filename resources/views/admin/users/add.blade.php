@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Users</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('title')
    Users
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
                            <h3 class="card-title">Add User</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{ Form::open(['route' => 'admin.users.store']) }}
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::label('first_name', 'First name *') }}
                                    {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter First name']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('last_name', 'Last name *') }}
                                    {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Last name']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('email', 'Email *') }}
                                    {{ Form::email('email', null, ['class' => 'form-control','placeholder' => 'Enter Email']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('password', 'Password *') }}
                                    {{ Form::password('password',['class' => 'form-control','placeholder' => 'Enter Password']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('password_confirmation', 'Confirm Password *') }}
                                    {{ Form::password('password_confirmation', ['class' => 'form-control','placeholder' => 'Confirm Password']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('type', 'Type *') }}
                                    {{ Form::select('type',['' => 'Select Type','1'=>'Admin','2'=>'Customer'], null, ['class' => 'form-control select2']) }}
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