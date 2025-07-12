@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Product Transfers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Product Transfers Update Form <small>product transfers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('producttransfers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">DataForm - Autofill</h4>
                </div>
                <div class="panel-body">
                    <form action="{!! route('producttransfers.update',$producttransfersdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Product" class="col-sm-3 control-label">Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control" data-size="100000" data-live-search="true" data-style="btn-white" name="product" id="product" disabled="">
                                            <option value="" >Select Product</option>				                                @foreach ($producttransfersdata['products'] as $products)
				                                @if( $products->id  ==  $producttransfersdata['data']->product  ){
				                                <option selected value="{!! $products->id !!}" >
								
				                                {!! $products->product_number!!}
				                                {!! $products->name!!}
				                                </option>@else
				                                <option value="{!! $products->id !!}" >
								
				                                {!! $products->product_number!!}
				                                {!! $products->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Store From" class="col-sm-3 control-label">Store From</label>
                                    <div class="col-sm-6">
									    <select class="form-control" data-size="100000" data-live-search="true" data-style="btn-white" name="store_from" id="store_from" disabled="">
                                            <option value="" >Select Store From</option>				                                @foreach ($producttransfersdata['stores'] as $stores)
				                                @if( $stores->id  ==  $producttransfersdata['data']->store_from  ){
				                                <option selected value="{!! $stores->id !!}" >
								
				                                {!! $stores->number!!}
				                                {!! $stores->name!!}
				                                </option>@else
				                                <option value="{!! $stores->id !!}" >
								
				                                {!! $stores->number!!}
				                                {!! $stores->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Store To" class="col-sm-3 control-label">Store To</label>
                                    <div class="col-sm-6">
									    <select class="form-control" data-size="100000" data-live-search="true" data-style="btn-white" name="store_to" id="store_to" disabled="">
                                            <option value="" >Select Store To</option>				                                @foreach ($producttransfersdata['stores'] as $stores)
				                                @if( $stores->id  ==  $producttransfersdata['data']->store_to  ){
				                                <option selected value="{!! $stores->id !!}" >
								
				                                {!! $stores->number!!}
				                                {!! $stores->name!!}
				                                </option>@else
				                                <option value="{!! $stores->id !!}" >
								
				                                {!! $stores->number!!}
				                                {!! $stores->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>                               
                                <div class="form-group">
                                    <label for="Size" class="col-sm-3 control-label">Size</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="size" readonly="" id="size" class="form-control" placeholder="Size" value="{!! $producttransfersdata['data']->size !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_transfer_status" class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-6">
                                        @if( $producttransfersdata['data']->product_transfer_status!="001" )
                                        <select class="form-control" disabled="" name="product_transfer_status" id="product_transfer_status" required="required">
                                            <option value="" >Select Status</option>                                              @foreach ($producttransfersdata['statuses'] as $status)
                                                @if( $status->id  ==  $producttransfersdata['data']->product_transfer_status  ){
                                                <option selected value="{!! $status->id !!}" >
                                
                                                {!! $status->number!!}
                                                {!! $status->name!!}
                                                </option>@else
                                                <option value="{!! $status->id !!}" >
                                
                                                {!! $status->number!!}
                                                {!! $status->name!!}
                                                </option>@endif
                                                @endforeach
                                        </select>                                        
                                        @else
                                        <select class="form-control" name="product_transfer_status" id="product_transfer_status" required="required">
                                            <option value="" >Select Status</option>                                              @foreach ($producttransfersdata['statuses'] as $status)
                                                @if( $status->id  ==  $producttransfersdata['data']->product_transfer_status  ){
                                                <option selected value="{!! $status->id !!}" >
                                
                                                {!! $status->number!!}
                                                {!! $status->name!!}
                                                </option>@else
                                                <option value="{!! $status->id !!}" >
                                
                                                {!! $status->number!!}
                                                {!! $status->name!!}
                                                </option>@endif
                                                @endforeach
                                        </select>
                                        @endif                                 

                                                                               

                                    </div>
                                </div>                                 
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        @if( $producttransfersdata['data']->product_transfer_status=="001" )
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Submit
                                        </button>
                                        @endif
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
</script>
@endsection