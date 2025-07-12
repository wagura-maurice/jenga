@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Suppliers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Suppliers Form <small>suppliers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('suppliers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                                    <label for="Phone Number" class="col-sm-3 control-label">Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone_number"  id="phone_number" placeholder="(999) 999-9999"  class="form-control"  value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Email Address" class="col-sm-3 control-label">Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email_address"    class="form-control" placeholder="Email Address" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Code" class="col-sm-3 control-label">Postal Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_code"  id="postal_code" class="form-control" placeholder="Postal Code" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Address" class="col-sm-3 control-label">Postal Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_address"  id="postal_address" class="form-control" placeholder="Postal Address" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Street" class="col-sm-3 control-label">Street</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="street"  id="street" class="form-control" placeholder="Street" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Town" class="col-sm-3 control-label">Town</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="town"  id="town" class="form-control" placeholder="Town" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Contact Person Name" class="col-sm-3 control-label">Contact Person Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="contact_person_name"  id="contact_person_name" class="form-control" placeholder="Contact Person Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Contact Person Phone Number" class="col-sm-3 control-label">Contact Person Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="contact_person_phone_number"  id="contact_person_phone_number" class="form-control" placeholder="Contact Person Phone Number" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Contact Person Email Address" class="col-sm-3 control-label">Contact Person Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="contact_person_email_address"  id="contact_person_email_address" class="form-control" placeholder="Contact Person Email Address" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="button" onclick="save()" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add Suppliers
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
		url: "{!! route('suppliers.store')!!}",
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
$("#phone_number").mask("(999) 999-9999");
</script>
@endsection