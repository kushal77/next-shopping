@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.order.index')}}">Order</a></li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('title')
    Order
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary" style="padding: 20px;">
                                <label>Order Number</label>{{$order->order_number}}
                                <label>Order Date</label>  {{Carbon\Carbon::parse($order->created_at)->format('D M d Y')}}
                                <label>Cutomer</label> {{$order->user->first_name}} {{$order->user->last_name}}
                                <label>Contact Number</label>  {{$order->user->phone_no}}
                                <label>EMI</label>  @if($order->emi) Yes @else No @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary" style="padding: 20px;">
                                <label>Delivery Date</label>{{Carbon\Carbon::parse($order->devilery_date)->format('D M d Y')}}
                                @php $shipping = json_decode($order->shipping_address); $billing = json_decode($order->billing_address); @endphp
                                <label>Shipping Address</label>{{$shipping->region}}, {{$shipping->city}}, {{$shipping->address}}, {{$shipping->post_code}}
                                <label>Billing Address</label>  {{$billing->region}}, {{$billing->city}}, {{$billing->address}}, {{$billing->post_code}}
                                <label>Payment Method</label> Cash On Delivery
                                <label>Status</label>
                                @if($order->status==2)
                                    Completed
                                @else 
                                <select class="form-control" name="status" id="status">
                                    <option value="0" @if($order->status==0) selected @endif>Pending</option>
                                    <option value="1" @if($order->status==1) selected @endif>Shipping</option>
                                    <option value="2">Completed</option>
                                </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Order Items</h3>
                        </div>
                        <div class="OrderDetailPadd">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table cellpadding="0" cellspacing="0" class="order_items table">
                                            <thead class="Thrwad_bg">
                                                <tr>
                                                    <th class="item sortable" data-sort="string-ins">Item</th>
                                                    <th class="quantity sortable" data-sort="int">Qty</th> 
                                                    <th class="quantity sortable" data-sort="int">Price</th>
                                                    <th class="item_cost sortable" data-sort="float">Amount</th>
                                                </tr>
                                                <tbody id="order_line_items">
                                                    @foreach($order->detail as $detail)
                                                        <tr>
                                                            <td><a href="{{ route('view.product', $detail->product->alias) }}" target="_Blank">{{$detail->product->title}}</a></td>
                                                            <td>{{$detail->quantity}}</td>
                                                            <td>{{$detail->currency}} {{$detail->net_price}}</td>
                                                            <td>{{$detail->currency}} {{$detail->total}}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="3">SUB-TOTAL</td>
                                                        <td>{{$detail->currency}} {{$order->net_price}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">DISCOUNT</td>
                                                        <td>{{$detail->currency}} {{$order->discount}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">ESTIMATED SHIPPING</td>
                                                        <td>{{$detail->currency}} {{$order->shipping}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">TOTAL</td>
                                                        <td>{{$detail->currency}} {{$order->total}}</td>
                                                    </tr>
                                                </tbody>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('#status').on('change',function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });
            var id = {{$order->id}};
            var status=$(this).val();
            $.ajax({
                url: '{{ url('backend/order/') }}/'+id,
                type: 'PUT',
                data: {
                    status: status,
                },
                success: function () {}
            })
        })
    </script>
@endsection