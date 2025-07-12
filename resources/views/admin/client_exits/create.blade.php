@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Client Exits</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Client Exits Form <small>client exits details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('clientexits.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                                    <label for="Amount" class="col-sm-3 control-label">Exit Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="exit_number" id="exit_number" class="form-control" placeholder="Exit Number" value="">
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" onchange="getLgfBalance()" data-size="100000" data-live-search="true" data-style="btn-white" name="client"  id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($clientexitsdata['clients'] as $clients)
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
                                    <label for="Amount" class="col-sm-3 control-label">LGF Balance</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly=""  id="balance" class="form-control" placeholder="Balance" value="">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Loan Balance</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly=""  id="loan_balance" class="form-control" placeholder="Loan Balance" value="">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label for="Request Date" class="col-sm-3 control-label">Request Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="request_date"  id="request_date" class="form-control" placeholder="Request Date" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Initiated By" class="col-sm-3 control-label">Initiated By</label>
                                    <div class="col-sm-6">
									    <input type="text" readonly="" class="form-control" value="{{ strtoupper(Auth::user()->name) }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Reason" class="col-sm-3 control-label">Reason</label>
                                    <div class="col-sm-6">
                                        <Textarea name="reason" id="reason"  class="form-control" row="20" placeholder="Reason" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Remarks" class="col-sm-3 control-label">Remarks</label>
                                    <div class="col-sm-6">
                                        <Textarea name="remarks" id="remarks"  class="form-control" row="20" placeholder="Remarks" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="button" disabled="disabled" onclick="save()" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add Client Exits
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
		url: "{!! route('clientexits.store')!!}",
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

        if(data){

            var balance=Number(data.balance);

            $("#balance").val(parseFloat(balance).toFixed(2));

            if(Number(balance)==0){

                if(Number($("#balance").val())==0 && Number($("#loan_balance").val())==0){
                    $("#btn-save").attr("disabled",false);
                }else{
                    $("#btn-save").attr("disabled",true);
                }


            }            
        }else{

            $("#balance").val("0");

        }

    }); 

    $.get("{!!url('/admin/getoverralloanbalance')!!}/"+clientFrom, function (data) {

        var balance=Number(data);

        $("#loan_balance").val(parseFloat(balance).toFixed(2));

        if(Number(balance)==0){

            if(Number($("#balance").val())==0 && Number($("#loan_balance").val())==0){
                $("#btn-save").attr("disabled",false);
            }else{
                $("#btn-save").attr("disabled",true);
            }


        }
    });     

}


</script>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#request_date").datepicker({todayHighlight:!0,autoclose:!0});
$("#approved_date").datepicker({todayHighlight:!0,autoclose:!0});

$(document).ready(function(){

    function gettransactionnumber(){

        $.get("{!!url('/admin/getclientexitnumber')!!}", function (data) {
            $("#exit_number").val(data);
        }); 

    }    

    gettransactionnumber();
});
</script>
@endsection