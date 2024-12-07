@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active">Order</li>
@endsection

@section('title')
    Order
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
                            <h3 class="card-title">List Of Orders</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sn.</th>
                                    <th>Name</th>
                                    <th>Order_number</th>
                                    <th>Price</th>
                                    <th>EMI</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $key=>$order)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->currency }} {{ $order->total }}</td>
                                        <td>{!! $order->emi() !!}</td>
                                        <td>{!! $order->status() !!}</td>
                                        <td>
                                            <a type="btn" class="btn btn-primary btn-sm" href="{{ route('admin.order.edit', $order->id) }}">
                                                <i class="fa fa-edit"></i></a>
                                            <!-- Large modal -->
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    data-toggle="modal" data-target=".bs-example-modal-lg"
                                                    id="{{ $order->id }}" onclick="onDeleteButton(id)" title="Delete">
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
                    <h4 class="modal-title" id="myModalLabel">Delete Selected Order</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <p>Are you sure you want to delete the selected order?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['route' => ['admin.order.destroy', 'delete'], 'method' => 'delete']) !!}
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