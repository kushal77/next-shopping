@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active">Product</li>
@endsection

@section('title')
    Product
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
                            <h3 class="card-title">List Of Products</h3>
                            <div align="right">
                                <a type="button" href="{{route('admin.product.create')}}" class="btn btn-success btn-sm">Add New Product</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sn.</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Emi</th>
                                    <th>Flash Sale</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $key=>$product)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td><img src="{{ asset('images/product/'.$product->images[0]->image)}}" width="200" height="70" /></td>
                                        <td>{!! $product->emi() !!}</td>
                                        <td>{!! $product->flashSale() !!}</td>
                                        <td>{!! $product->status() !!}</td>
                                        <td>
                                            <a type="btn" class="btn btn-primary btn-sm" href="{{ route('admin.product.edit', $product->id) }}">
                                                <i class="fa fa-edit"></i></a>
                                            <!-- Large modal -->
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    data-toggle="modal" data-target=".bs-example-modal-lg"
                                                    id="{{ $product->id }}" onclick="onDeleteButton(id)" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
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

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Delete Selected Product</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <p>Are you sure you want to delete the selected product?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['route' => ['admin.product.destroy', 'delete'], 'method' => 'delete']) !!}
                    <input id="user_id" name="user_id" type="hidden">
                    <button type="submit" class="btn btn-primary btn-sm">Delete</button>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function onDeleteButton(id) {
            $('#user_id').val(id);
        }
    </script>
@endsection