@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Lgf To Fine Transfers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Lgf To Fine Transfers Form <small>lgf to fine transfers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('lgftofinetransfers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                                    <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="transaction_number"  id="transaction_number" class="form-control" placeholder="Transaction Number" value="">
                                    </div>
                                </div>                        
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" onchange="getLgfBalance()" data-size="100000" data-live-search="true" data-style="btn-white" name="client"  id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($lgftofinetransfersdata['clients'] as $clients)
				                                <option value="{!! $clients->id !!}">
					
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Balance</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly=""  id="balance" class="form-control" placeholder="Balance" value="">
                                    </div>
                                </div>   
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Balance After Transfer</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" id="balance_after_transfer" class="form-control" placeholder="Balance After Transfer" value="">
                                    </div>
                                </div>                                 
                                <div class="form-group">
                                    <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="loan" onchange="getloanbalance()"  id="loan">
                                            <option value="" >Select Loan</option>				                                @foreach ($lgftofinetransfersdata['loans'] as $loans)
				                                <option value="{!! $loans->id !!}">
					
				                                {!! $loans->loan_number!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Loan Balance</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="loan_balance" id="loan_balance" class="form-control" placeholder="Loan balance" value="" readonly="">
                                    </div>
                                </div>                                  
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount" onchange="checkAmount()"  id="amount" class="form-control" placeholder="Amount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Initiated By" class="col-sm-3 control-label">Initiated By</label>
                                    <div class="col-sm-6">
									    <input type="text" readonly="" class="form-control" value="{{ strtoupper(Auth::user()->name) }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Date" class="col-sm-3 control-label">Transaction Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="transaction_date"  id="transaction_date" class="form-control" placeholder="Transaction Date" value="" data-date-end-date="Date.default">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="button" onclick="save()" class="btn btn-sm btn-primary" id="btn-save" disabled="">
                                            <i class="fa fa-btn fa-plus"></i> Add Lgf To Fine Transfers
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
		url: "{!! route('lgftofinetransfers.store')!!}",
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


function getLgfBalance(){

    var clientFrom=$("#client").val();
    var amount=Number($("#amount").val());

    $.get("{!!url('/admin/getclientlgfbalance')!!}/"+clientFrom, function (data) {
        var balance=Number(data.balance);
        if(Number(balance)>0){
            $("#balance").val(balance);
            $("#balance_after_transfer").val(balance-amount);

            if((balance-amount)<0){
                $("#btn-save").attr("disabled",true);
            }else{
                $("#btn-save").attr("disabled",false);
            }

            if(isNaN(amount) || amount<=0){
                $("#btn-save").attr("disabled",true);
            }

        }
    }); 

}


function getloanbalance(){

    var loan=$("#loan").val();

    $.get("{!!url('/admin/getloanbalancebyid')!!}/"+loan, function (data) {

        $("#loan_balance").val(Number(data));

    });

}

function checkAmount(){

    $amount=Number($("#amount").val());
    $loanbalance=Number($("#loan_balance").val());
    $lgfbalance=Number($("#balance").val());
    $("#balance_after_transfer").val($lgfbalance-$amount);

    if($amount>$lgfbalance){

        $("#btn-save").attr("disabled","disabled");

    }else{

        $("#btn-save").removeAttr("disabled");


    }

}

</script>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#transaction_date").datepicker({todayHighlight:!0,autoclose:!0}).datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", new Date());
$(document).ready(function(){

    function gettransactionnumber(){

        $.get("{!!url('/admin/getlgftofinetransactionnumber')!!}", function (data) {
            $("#transaction_number").val(data);
        }); 

    }    

    gettransactionnumber();
});
</script>
@endsection