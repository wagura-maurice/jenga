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
        <li><a href="#">Sales Order Payments</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">({!!$salesorderpaymentsdata['salesorder']->order_number!!}) Sales Order Payments - DATA <small>sales order payments data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($salesorderpaymentsdata['usersaccountsroles'][0]->_add==1 && $salesorderpaymentsdata['salesorder']->orderstatusmodel->code=='0001')
            <a href="{!! url('/admin/createsalesorderpayments') !!}/{!!$salesorderpaymentsdata['salesorder']->id!!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
        </div>
    </div>
    @if($salesorderpaymentsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Order Number</th>
                                        <th>Customer</th>
                                        <th>Payment Mode</th>
                                        <th>Payment Date</th>
                                        <th>Reference</th>
                                        <th>Amount</th>
                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($salesorderpaymentsdata['list'] as $salesorderpayments)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $salesorderpayments->salesordermodel->order_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $salesorderpayments->salesordermodel->customer_name !!}
                                </div></td>                                
                                <td class='table-text'><div>
                                	{!! $salesorderpayments->paymentmodemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $salesorderpayments->payment_date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $salesorderpayments->reference !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $salesorderpayments->amount !!}
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
                <h4 class="modal-title">Sales Order Payments - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/salesorderpaymentsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Sales Order" class="col-sm-3 control-label">Sales Order</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="sales_order"  id="sales_order">
                                            <option value="" >Select Sales Order</option>				                                @foreach ($salesorderpaymentsdata['salesorders'] as $salesorders)
				                                <option value="{!! $salesorders->id !!}">
					
				                                {!! $salesorders->order_number!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="payment_mode"  id="payment_mode">
                                            <option value="" >Select Payment Mode</option>				                                @foreach ($salesorderpaymentsdata['paymentmodes'] as $paymentmodes)
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
                                    <label for="Reference" class="col-sm-3 control-label">Reference</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="reference"  id="reference" class="form-control" placeholder="Reference" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount"  id="amount" class="form-control" placeholder="Amount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Sales Order Payments
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