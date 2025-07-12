@extends("admin.home")
@section("main_content")
<style type="text/css">
	td div img{
		max-width: 64px;
	}
</style>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Purchase Order Payments</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Purchase Order {!! $purchaseorderpaymentsdata['purchaseorder']->order_number !!} Payments - DATA <small>purchase order payments data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($purchaseorderpaymentsdata['usersaccountsroles'][0]->_add==1 && $purchaseorderpaymentsdata['purchaseorder']->orderstatusmodel->code=='0001')
            <a href="{!! url('/admin/createpurchaseorderpayment') !!}/{!!$purchaseorderpaymentsdata['purchaseorder']->id!!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
        </div>
    </div>
    @if($purchaseorderpaymentsdata['usersaccountsroles'][0]->_list==1)
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
                    <h4 class="panel-title">DataTable - Autofill</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Purchase Order</th>
                                        <th>Payment Mode</th>
                                        <th>Payment Date</th>
                                        <th>Amount</th>
                                        <th>Reference</th>
                                                                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($purchaseorderpaymentsdata['list'] as $purchaseorderpayments)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $purchaseorderpayments->purchaseordermodel->order_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderpayments->paymentmodemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderpayments->payment_date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderpayments->amount !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderpayments->reference !!}
                                </div></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    @endif
<div class="modal fade modal-message" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                <h4 class="modal-title">Purchase Order Payments - Filter Dialog</h4>
            </div>
            <div class="modal-body">
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/purchaseorderpaymentsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Purchase Order" class="col-sm-3 control-label">Purchase Order</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="purchase_order"  id="purchase_order">
                                            <option value="" >Select Purchase Order</option>				                                @foreach ($purchaseorderpaymentsdata['purchaseorders'] as $purchaseorders)
				                                <option value="{!! $purchaseorders->id !!}">
					
				                                {!! $purchaseorders->order_number!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="payment_mode"  id="payment_mode">
                                            <option value="" >Select Payment Mode</option>				                                @foreach ($purchaseorderpaymentsdata['paymentmodes'] as $paymentmodes)
				                                <option value="{!! $paymentmodes->id !!}">
					
				                                {!! $paymentmodes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Date" class="col-sm-3 control-label">Payment Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="payment_datefrom" id="payment_datefrom" class="form-control m-b-5" placeholder="Payment Date From" value="">
                                        <input type="text" name="payment_dateto" id="payment_dateto" class="form-control" placeholder="Payment Date To" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount"  id="amount" class="form-control" placeholder="Amount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Reference" class="col-sm-3 control-label">Reference</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="reference"  id="reference" class="form-control" placeholder="Reference" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Purchase Order Payments
                                        </button>
                                    </div>
                                </div>
                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#payment_datefrom").datepicker({todayHighlight:!0,autoclose:!0});
$("#payment_dateto").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection