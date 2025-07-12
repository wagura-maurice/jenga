@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Transaction Gateways</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Transaction Gateways Form <small>transaction gateways details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('transactiongateways.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                                    <label for="Name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name"  id="name" class="form-control" placeholder="Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Short Code" class="col-sm-3 control-label">Short Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="short_code"  id="short_code" class="form-control" placeholder="Short Code" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Pass Key" class="col-sm-3 control-label">Pass Key</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="pass_key"  id="pass_key" class="form-control" placeholder="Pass Key" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Call Back Url" class="col-sm-3 control-label">Call Back Url</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="call_back_url"  id="call_back_url" class="form-control" placeholder="Call Back Url" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Queue Time Out Url" class="col-sm-3 control-label">Queue Time Out Url</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="queue_time_out_url"  id="queue_time_out_url" class="form-control" placeholder="Queue Time Out Url" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Result Url" class="col-sm-3 control-label">Result Url</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="result_url"  id="result_url" class="form-control" placeholder="Result Url" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="button" onclick="save()" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add Transaction Gateways
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
		url: "{!! route('transactiongateways.store')!!}",
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
</script>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
</script>
@endsection