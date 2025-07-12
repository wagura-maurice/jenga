@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Insurance Deduction Fee Payments</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Insurance Deduction Fee Payments Form <small>insurance deduction fee payments details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! url('admin/pendinginsurancedeductionfee') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form id="form"  class="form-horizontal" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                    <div class="col-sm-6">
									    <p class="form-control-static">{{$insurancedeductionfeepaymentsdata['loan']->loan_number}}</p>
                                        <input type="hidden" name="loan" id="loan" value="{{$insurancedeductionfeepaymentsdata['loan']->id}}"/>
                                        <input type="hidden" name="loan_product" id="loan_product" value="{{$insurancedeductionfeepaymentsdata['loanproduct']->id}}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Loan" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
                                        <p class="form-control-static">{{$insurancedeductionfeepaymentsdata['loan']->clientmodel->first_name}} {{$insurancedeductionfeepaymentsdata['loan']->clientmodel->middle_name}} {{$insurancedeductionfeepaymentsdata['loan']->clientmodel->last_name}}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="payment_mode"  id="payment_mode" onchange="checkInsuranceDeductionConfiguration()">
                                            <option value="" >Select Payment Mode</option>				                                @foreach ($insurancedeductionfeepaymentsdata['paymentmodes'] as $paymentmodes)
				                                <option value="{!! $paymentmodes->id !!}">
					
				                                {!! $paymentmodes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="transaction_number"  id="transaction_number" class="form-control" placeholder="Transaction Number" value="" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="date"  id="date" class="form-control" placeholder="Date" value="" data-date-format="dd-mm-yyyy" data-date-end-date="Date.default" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <p>{{$insurancedeductionfeepaymentsdata['amount']}}</p>
                                        <input type="hidden" name="amount"  id="amount" class="form-control" placeholder="Amount" value="{{$insurancedeductionfeepaymentsdata['amount']}}" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="button" onclick="save()" class="btn btn-sm btn-primary" id="btn-save" disabled="true">
                                            <i class="fa fa-btn fa-plus"></i> Add Insurance Deduction Fee Payments
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
function save(){
	$("#btn-save").attr("disable",true);
	var formData = new FormData($('#form')[0]);
	$.ajax({
		type:'POST',
		url: "{!! route('insurancedeductionfeepayments.store')!!}",
		data:formData,
		cache:false,
		contentType: false,
		processData: false,
		success:function(data){
		$("#btn-save").attr("disable",false);
			var obj = jQuery.parseJSON( data );
			if(obj.status=='1'){
				$.gritter.add({
					title: 'Success',
					text: obj.message,
					sticky: false,
					time: '1000',
				});
				$("#form")[0].reset();
			}else{
				$.gritter.add({
					title: 'Fail',
					text: obj.message,
					sticky: false,
					time: '5000',
				});
			}
		},error: function(data){
console.log(data)
			$.gritter.add({
				title: 'Error',
				text: 'An Error occured. Please review your data then submit again!!',
				sticky: false,
				time: '5000',
			});
		}
	});
	return false;
}
function checkInsuranceDeductionConfiguration(){
    var paymentMode=$("#payment_mode").val();
    var loanProduct=$("#loan_product").val();
    $.ajax({
        type:'POST',
        url: "{!! url('/admin/checkinsurancedeductionconfiguration/')!!}",
        data:JSON.stringify({'_token':"{{ csrf_token() }}","payment_mode":paymentMode,"loan_product":loanProduct}),
        contentType: "application/json",
        processData: false,
        success:function(data){
            if(data=="1")
                $("#btn-save").attr("disabled",false);
            else
                $("#btn-save").attr("disabled",true);
        }
    });      

}
</script>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#date").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection