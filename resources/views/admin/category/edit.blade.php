@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Category</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('title')
    Category
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
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{ Form::model($category, ['route' => ['admin.category.update', $category->id], 'method' => 'PUT',"enctype"=>"multipart/form-data"]) }}
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::label('parent_id', 'Category *') }}
                                    {{ Form::select('parent_id',$parentCats, null, ['class' => 'form-control', 'placeholder' => 'Root']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('title', 'Title *') }}
                                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('image', 'Image*') }}
                                    {{ Form::file('image', ['class' => 'form-control']) }}
                                </div>
                                <img src="{{asset('images/category/'.$category->image)}}" width="150" height="150" />
                                <div class="customfields">
                                    @php
                                        $customblocks = json_decode($category->customfields,true);
                                        $blocks = 0;
                                        if($customblocks){
                                            $blocks = count($customblocks);
                                        }
                                    @endphp
                                    @if($customblocks)
                                        @foreach($customblocks as $key => $customblock)
                                            <div class="customblock">
                                                <div class="form-group">
                                                    <label for="label">Label *</label>
                                                    <input class="form-control" placeholder="Enter Label" name="customfield[{{$key}}][label]" type="text" value="{{$customblock['label']}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Field Type*</label>
                                                    <select class="form-control fieldtype" name="customfield[{{$key}}][fieldtype]" data-block="{{$key}}">
                                                        <option value="text" @if($customblock['fieldtype']=='text') selected @endif>Text</option>
                                                        <option value="select" @if($customblock['fieldtype']=='select') selected @endif>Select</option>
                                                    </select>
                                                    <div class="selectoptions">
                                                        @if(isset($customblock['options']))
                                                            <div class="form-group">
                                                                <label for="image">Options*</label>
                                                                <input class="form-control" placeholder="Enter Label" name="customfield[{{$key}}][options]" type="text" value="{{$customblock['options']}}">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <button class="removeblock pull-right btn btn-danger" style="margin-bottom:10px;">Remove</button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button class="btn btn-primary addcustomfield">Add CustomField</button>
                                @php 
                                    $seo = json_decode($category->seo,true);
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

@section('scripts')
    <script type="text/javascript">
        var block = {{$blocks}};
        $('.addcustomfield').on('click',function(e) {
            e.preventDefault();
            $('.customfields').append('<div class="customblock"><div class="form-group">{{ Form::label('label', 'Label *') }}<input class="form-control" placeholder="Enter Label" name="customfield['+block+'][label]" type="text" ></div><div class="form-group">{{ Form::label('image', 'Field Type*') }}<select class="form-control fieldtype" name="customfield['+block+'][fieldtype]" data-block="'+block+'"><option value="text" selected="selected">Text</option><option value="select">Select</option></select><div class="selectoptions"></div></div><button class="removeblock pull-right btn btn-danger" style="margin-bottom:10px;">Remove</button</div>');
            block++;
        })
        $(document).on('change','.fieldtype',function(e){
            e.preventDefault();
            $(this).parent().children('.selectoptions').html('');
            if($(this).val()=='select'){
                $(this).parent().children('.selectoptions').html('<div class="form-group">{{ Form::label('options', 'Options *') }}<input class="form-control" placeholder="eg: black, white" name="customfield['+$(this).attr('data-block')+'][options]" type="text" ></div>');
            }
        })
        $(document).on('click','.removeblock',function(e){
            e.preventDefault();
            $(this).parent().remove();
        })
    </script>
@endsection