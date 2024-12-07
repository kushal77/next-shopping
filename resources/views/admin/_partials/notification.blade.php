@if(session()->has('error')||session()->has('success')||$errors->any())
    <div class="box box-default">
        <div class="box-body">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                            <li>
                                {!! $error !!}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {!! session()->get('success') !!}
                </div>
            @endif
        </div>
    </div>
@endif