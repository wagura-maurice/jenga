@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Change Type Requests</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Change Type Requests Form <small>change type requests details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('changetyperequests.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="client"  id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($changetyperequestsdata['clients'] as $clients)
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
                                    <label for="Current Type" class="col-sm-3 control-label">Current Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="current_type"  id="current_type">
                                            <option value="" >Select Current Type</option>				                                @foreach ($changetyperequestsdata['clienttypes'] as $clienttypes)
				                                <option value="{!! $clienttypes->id !!}">
					
				                                {!! $clienttypes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="New Type" class="col-sm-3 control-label">New Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="new_type"  id="new_type">
                                            <option value="" >Select New Type</option>				                                @foreach ($changetyperequestsdata['clienttypes'] as $clienttypes)
				                                <option value="{!! $clienttypes->id !!}">
					
				                                {!! $clienttypes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="date"  id="date" class="form-control" placeholder="Date" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Comments" class="col-sm-3 control-label">Comments</label>
                                    <div class="col-sm-6">
                                        <Textarea name="comments" id="comments"  class="form-control" row="20" placeholder="Comments" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Status" class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="status"  id="status">
                                            <option value="" >Select Status</option>				                                @foreach ($changetyperequestsdata['changetyperequeststatuses'] as $changetyperequeststatuses)
				                                <option value="{!! $changetyperequeststatuses->id !!}">
					
				                                {!! $changetyperequeststatuses->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="button" onclick="save()" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add Change Type Requests
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
		url: "{!! route('changetyperequests.store')!!}",
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
$("#date").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection