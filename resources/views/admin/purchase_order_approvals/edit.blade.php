@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Purchase Order Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Purchase Order Approvals Update Form <small>purchase order approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('purchaseorderapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('purchaseorderapprovals.update',$purchaseorderapprovalsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Purchase Order" class="col-sm-3 control-label">Purchase Order</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="purchase_order" id="purchase_order">
                                            <option value="" >Select Purchase Order</option>				                                @foreach ($purchaseorderapprovalsdata['purchaseorders'] as $purchaseorders)
				                                @if( $purchaseorders->id  ==  $purchaseorderapprovalsdata['data']->purchase_order  ){
				                                <option selected value="{!! $purchaseorders->id !!}" >
								
				                                {!! $purchaseorders->order_number!!}
				                                </option>@else
				                                <option value="{!! $purchaseorders->id !!}" >
								
				                                {!! $purchaseorders->order_number!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="approval_level" id="approval_level" class="form-control" placeholder="Approval Level" value="{!! $purchaseorderapprovalsdata['data']->approval_level !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="User" class="col-sm-3 control-label">User</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="user" id="user" class="form-control" placeholder="User" value="{!! $purchaseorderapprovalsdata['data']->user !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Status" class="col-sm-3 control-label">Approval Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_status" id="approval_status">
                                            <option value="" >Select Approval Status</option>				                                @foreach ($purchaseorderapprovalsdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $purchaseorderapprovalsdata['data']->approval_status  ){
				                                <option selected value="{!! $approvalstatuses->id !!}" >
								
				                                {!! $approvalstatuses->name!!}
				                                </option>@else
				                                <option value="{!! $approvalstatuses->id !!}" >
								
				                                {!! $approvalstatuses->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Purchase Order Approvals
                                        </button>
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