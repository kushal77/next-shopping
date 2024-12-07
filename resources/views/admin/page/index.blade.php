@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active">Page</li>
@endsection

@section('title')
    Page
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Of Pages</h3>
                            <div align="right">
                                <a type="button" href="{{route('admin.page.create')}}" class="btn btn-success btn-sm">Add New Page</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sn.</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pages as $key=>$page)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ route('page',$page->alias) }}</td>
                                        <td>
                                            <a type="btn" class="btn btn-primary btn-sm" href="{{ route('admin.page.edit', $page->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection