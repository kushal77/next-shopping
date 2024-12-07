@php
	$customblocks = json_decode($category,true);
@endphp
@foreach($customblocks as $key => $customblock)
	<div class="form-group">
        <label for="title">{{$customblock['label']}} *</label>
        @if ($customblock['fieldtype']=='text')
        	<input class="form-control" placeholder="Enter {{$customblock['label']}}" name="custom[{{$customblock['label']}}][value]" type="text">
    	@elseif ($customblock['fieldtype']=='select')
    		@php 
    			$options = explode(',', $customblock['options']);
    		@endphp
    		<select class="form-control" name="custom[{{$customblock['label']}}}][value]"> 
    			@foreach($options as $option)
    				<option value="{{$option}}">{{$option}}</option>
    			@endforeach
    		</select>
        @endif
        
    </div>
@endforeach