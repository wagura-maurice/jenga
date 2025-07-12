@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Purchase Order Payments</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Purchase Order {!!$purchaseorderpaymentsdata['purchaseorder']->order_number!!} Payments Form <small>purchase order payments details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('purchaseorderpayments.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form id="form" action="{!! url('/admin/storepurchaseorderpayment') !!}/{!!$purchaseorderpaymentsdata['purchaseorder']->id!!}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                                <input type="hidden" name="purchase_order" value="{!!$purchaseorderpaymentsdata['purchaseorder']->id!!}" />

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
                                        <input type="text" name="payment_date"  id="payment_date" class="form-control" placeholder="Payment Date" value="" data-date-end-date="Date.default">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="amount"  id="amount" class="form-control" placeholder="Amount" value="{!!$purchaseorderpaymentsdata['purchaseorder']->amount!!}">
                                        <input type="text" readonly class="form-control" placeholder="Amount" value="{!!$purchaseorderpaymentsdata['purchaseorder']->amount!!}">                                        
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
                                        <button type="submit" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add Purchase Order Payments
                                        </button>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="javascript" type="text/javascript">
</script>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#payment_date").datepicker({todayHighlight:!0,autoclose:!0}).datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", new Date());;
</script>
@endsection