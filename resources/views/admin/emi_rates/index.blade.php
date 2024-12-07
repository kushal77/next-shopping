@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active">EMI Rates</li>
@endsection

@section('title')
    EMI Rates
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
                            <h3 class="card-title">List Of EMI Rates</h3>
                            <div align="right">
                                <a type="button" href="{{route('admin.emi.create')}}" class="btn btn-success btn-sm">Add New EMI</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sn.</th>
                                    <th>No. of Months</th>
                                    <th>Rate (%)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($emi_rates as $key=>$emi_rate)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $emi_rate->months }}</td>
                                        <td>{{ $emi_rate->rate }}</td>
                                        <td>{!! $emi_rate->status() !!}</td>
                                        <td>
                                            <a type="btn" class="btn btn-primary btn-sm" href="{{ route('admin.emi.edit', $emi_rate->id) }}">
                                                <i class="fa fa-edit"></i></a>
                                            <!-- Large modal -->
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    data-toggle="modal" data-target=".bs-example-modal-lg"
                                                    id="{{ $emi_rate->id }}" onclick="onDeleteButton(id)" title="Delete">
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
                    <h4 class="modal-title" id="myModalLabel">Delete Selected EMI Rate</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <p>Are you sure you want to delete the selected EMI Rate?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['route' => ['admin.emi.destroy', 'delete'], 'method' => 'delete']) !!}
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
