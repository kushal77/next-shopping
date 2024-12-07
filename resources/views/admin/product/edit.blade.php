@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Product</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('title')
    Product
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
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{ Form::model($product, ['route' => ['admin.product.update', $product->id], 'method' => 'PUT',"enctype"=>"multipart/form-data"]) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7 col-7">
                                        <div class="form-group">
                                            {{ Form::label('title', 'Title *') }}
                                            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('short_text', 'Short Text *') }}
                                            {{ Form::textarea('short_text', null, ['class' => 'form-control', 'placeholder' => 'Enter Short Text','rows'=>2]) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('description', 'Description *') }}
                                            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('emi_description', 'Emi Description *') }}
                                            {{ Form::textarea('emi_description', null, ['class' => 'form-control', 'placeholder' => 'Enter Emi Description']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('image', 'Image*') }}
                                            <div class="images" style="margin: 0 0 10px 0;"> 
                                                {{ Form::file('image[]', ['class' => 'form-control','style'=>'margin: 0 0 10px 0;']) }}
                                            </div>
                                            <button class="btn btn-primary" id="addnewimage">Add Image</button>
                                        </div>
                                        <div class="row"> 
                                            @foreach($product->images as $image)
                                                <div class="col-md-3" style="margin-right: 10px;">
                                                    <button class="btn btn-danger deleteimage" data-id="{{$image->id}}">Delete</button> <br>
                                                    <img src="{{asset('images/product/'.$image->image)}}" width="150" height="150" />
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="customfields"></div>
                                        @php 
                                            $seo = json_decode($product->seo,true);
                                        @endphp
                                        <div class="form-group">
                                            {{ Form::label('metatitle', 'Meta Title *') }}
                                            {{ Form::text('metatitle', $seo['metatitle'], ['class' => 'form-control', 'placeholder' => 'Enter Meta Title']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('metakey', 'Meta Key *') }}
                                            {{ Form::text('metakey', $seo['metakey'], ['class' => 'form-control', 'placeholder' => 'Enter Meta Key']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('metadesc', 'Meta Description *') }}
                                            {{ Form::text('metadesc', $seo['metadesc'], ['class' => 'form-control', 'placeholder' => 'Enter Meta Description']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('status', 'Status *') }}
                                            {{ Form::select('status',['' => 'Select Status','1'=>'Publish','2'=>'Unpublish'], null, ['class' => 'form-control select2']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-5">
                                        <div class="form-group">
                                            {{ Form::label('cat_id', 'Category *') }}
                                            <select class="form-control" name="cat_id" id="cat_id">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <optgroup label="{{$category->title}}">
                                                        @foreach($category->childrens as $child)
                                                            <option value="{{$child->id}}" @if($product->cat_id==$child->id) selected @endif>{{$child->title}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('brand_id', 'Brand *') }}
                                            {{ Form::select('brand_id', $brands,null, ['class' => 'form-control', 'placeholder' => 'select Brand']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('currency', 'Currency *') }}
                                            {{ Form::select('currency', ['Rs'=>'Rs'],'Rs', ['class' => 'form-control','readonly'=>true]) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('price', 'Price *') }}
                                            {{ Form::number('price',null,['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('discount', 'Discount *') }}
                                            {{ Form::number('discount',null,['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('quantity', 'Quantity *') }}
                                            {{ Form::number('quantity',null,['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('emi', 'Emi *') }}
                                            {{ Form::select('emi', ['1'=>'Yes','0'=>'No'],null, ['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group showdownpayment" @if(!$product->emi) style="display: none;" @endif>
                                            {{ Form::label('downpayment', 'Down Payment (In %) *') }}
                                            {{ Form::number('downpayment',null,['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('special_deals', 'Special Deals *') }}
                                            {{ Form::select('special_deals', ['1'=>'Yes','0'=>'No'],null, ['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('flash_sale', 'Flash Sale *') }}
                                            {{ Form::select('flash_sale', ['1'=>'Yes','0'=>'No'],null, ['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('top_sales', 'Top Sales *') }}
                                            {{ Form::select('top_sales', ['1'=>'Yes','0'=>'No'],null, ['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('most_liked', 'Most Liked *') }}
                                            {{ Form::select('most_liked', ['1'=>'Yes','0'=>'No'],null, ['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('just_for_you', 'Just For you *') }}
                                            {{ Form::select('just_for_you', ['1'=>'Yes','0'=>'No'],null, ['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            @php
                                                $taglist = [];
                                                foreach ($product->tags as $tag) {
                                                    $taglist[] = $tag->tag;
                                                }
                                            @endphp
                                            {{ Form::label('tags', 'Tags *') }}
                                            {{ Form::text('tags', implode(',', $taglist), ['class' => 'form-control', 'placeholder' => 'Enter Tags']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
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

@section('scripts')
    <script type="text/javascript">
        $('#addnewimage').click(function(e){
            e.preventDefault();
            $('.images').append('{{ Form::file('image[]',  ['class' => 'form-control','style'=>'margin: 0 0 10px 0;']) }}');
        })
        $('.deleteimage').click(function(e){
            e.preventDefault();
            if(confirm("Are you sure you want to delete this?")){
                $(this).parent().remove();
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    method:"POST",
                    url:"{{ route('admin.product.removeimage') }}",
                    data:{ id: id },
                    success:function(data){
                        $('.customfields').html(data.html)
                    }
                })
            }else{
                return false;
            }
        })
        $('#cat_id').on('change',function(e){
            e.preventDefault();
            var catId = $(this).val();
            if(catId=={{$product->cat_id}}){
                var productId = {{$product->id}};
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    method:"POST",
                    url:"{{ route('admin.loadcustomfields') }}",
                    data:{ catId: catId,productId: productId },
                    success:function(data){
                        $('.customfields').html(data.html)
                    }
                })
            }else{
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    method:"POST",
                    url:"{{ route('admin.getcategory.customfields') }}",
                    data:{ catId: catId },
                    success:function(data){
                        $('.customfields').html(data.html)
                    }
                })
            }
        })
        var catId = {{$product->cat_id}};
        var productId = {{$product->id}};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
        $.ajax({
            method:"POST",
            url:"{{ route('admin.loadcustomfields') }}",
            data:{ catId: catId,productId: productId },
            success:function(data){
                $('.customfields').html(data.html)
            }
        })
        $('#emi').on('change',function(e){
            e.preventDefault();
            if($(this).val()==1){
                $('.showdownpayment').show()
            }else{
                $('.showdownpayment').hide()
            }
        })
    </script>
@endsection