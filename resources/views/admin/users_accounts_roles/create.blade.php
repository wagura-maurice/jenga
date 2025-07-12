@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Users Accounts Roles</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Users Accounts Roles Form <small>users accounts roles details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('usersaccountsroles.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                                    <label for="User Account" class="col-sm-3 control-label">User Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="user_account"  id="user_account">
                                            <option value="" >Select User Account</option>				                                @foreach ($usersaccountsrolesdata['usersaccounts'] as $usersaccounts)
				                                <option value="{!! $usersaccounts->id !!}">
					
				                                {!! $usersaccounts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Module" class="col-sm-3 control-label">Module</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="module"  id="module">
                                            <option value="" >Select Module</option>				                                @foreach ($usersaccountsrolesdata['modules'] as $modules)
				                                <option value="{!! $modules->id !!}">
					
				                                {!! $modules->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_add" class="col-sm-3 control-label">_add</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_add"  id="_add" placeholder="_add" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_list" class="col-sm-3 control-label">_list</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_list"  id="_list" placeholder="_list" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_edit" class="col-sm-3 control-label">_edit</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_edit"  id="_edit" placeholder="_edit" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_delete" class="col-sm-3 control-label">_delete</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_delete"  id="_delete" placeholder="_delete" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_show" class="col-sm-3 control-label">_show</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_show"  id="_show" placeholder="_show" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_report" class="col-sm-3 control-label">_report</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_report"  id="_report" placeholder="_report" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="button" onclick="save()" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Add Users Accounts Roles
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
	var formData = new FormData($('#form')[0]);
	$.ajax({
		type:'POST',
		url: "{!! route('usersaccountsroles.store')!!}",
		data:formData,
		cache:false,
		contentType: false,
		processData: false,
		success:function(data){
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
@endsection