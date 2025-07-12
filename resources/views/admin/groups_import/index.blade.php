@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Groups</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Groups Form <small>groups details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('groups.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                                    <label for="Group Number" class="col-sm-3 control-label">Group Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="group_number"  id="group_number" class="form-control" placeholder="Group Number" value="group_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Group Name" class="col-sm-3 control-label">Group Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="group_name"  id="group_name" class="form-control" placeholder="Group Name" value="group_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Meeting Day" class="col-sm-3 control-label">Meeting Day</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="meeting_day"  id="meeting_day" class="form-control" placeholder="Meeting Day" value="meeting_day"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Meeting Time" class="col-sm-3 control-label">Meeting Time</label>
                                    <div class="col-sm-6">
								        
                                            <input type="text" class="form-control" name="meeting_time" value="meeting_time"/>

                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Meeting Frequency" class="col-sm-3 control-label">Meeting Frequency</label>
                                    <div class="col-sm-6">
                                            <input type="text" class="form-control" name="meeting_frequency" value="meeting_frequency"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Preferred Mode Of Banking" class="col-sm-3 control-label">Preferred Mode Of Banking</label>
                                    <div class="col-sm-6">
                                            <input type="text" class="form-control" name="preferred_mode_of_banking" value="preferred_mode_of_banking"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Registration Date" class="col-sm-3 control-label">Registration Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="registration_date"  id="registration_date" class="form-control" placeholder="Registration Date" value="registration_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Group Formation Date" class="col-sm-3 control-label">Group Formation Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="group_formation_date"  id="group_formation_date" class="form-control" placeholder="Group Formation Date" value="group_formation_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Officer" class="col-sm-3 control-label">Officer</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="group_formation_date"  id="group_formation_date" class="form-control" placeholder="Group Formation Date" value="officer">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="button" onclick="save()" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Add Groups
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
		url: "{!! route('groupsimport.store')!!}",
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
<script language="javascript" type="text/javascript">

</script>
<script language="javascript" type="text/javascript">

</script>
<script language="javascript" type="text/javascript">
</script>
@endsection