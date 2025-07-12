@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Clients</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Clients Form <small>clients details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('clients.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
								<div id="wizard">
									<ol>
										<li>
										basic
										    <small>basic details</small>
										</li>
										<li>
										residential
										    <small>residential details</small>
										</li>
										<li>
										spouse
										    <small>spouse details</small>
										</li>
										<li>
										next of kin
										    <small>next of kin details</small>
										</li>
										<li>
										income
										    <small>income details</small>
										</li>
										<li>
										other
										    <small>other details</small>
										</li>
										<li>
										Completed
										    <small>Final Section</small>
										</li>
									</ol>
									<div>
                                        <fieldset>
                                            <legend class="pull-left width-full">basic</legend>
                                            <div class="row">
                                <div class="form-group">
                                    <label for="Client Number" class="col-sm-3 control-label">Datebase Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="db_name" id="db_name" class="form-control"  placeholder="Database Name" value="microfinance_import">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client Number" class="col-sm-3 control-label">Host</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="db_host" id="db_host" class="form-control"  placeholder="Host" value="localhost">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client Number" class="col-sm-3 control-label">Username</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="db_user_name" id="db_user_name" class="form-control"  placeholder="Username" value="root">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client Number" class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="db_password" id="db_password" class="form-control"  placeholder="Password" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Client Number" class="col-sm-3 control-label">Table</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="db_table" id="db_table" class="form-control"  placeholder="Table" value="client">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="Client Number" class="col-sm-3 control-label">Client Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="client_number" id="client_number" class="form-control"  placeholder="Client Number" value="client_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="First Name" class="col-sm-3 control-label">First Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="first_name" id="first_name" class="form-control"  placeholder="First Name" value="first_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Middle Name" class="col-sm-3 control-label">Middle Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="middle_name" id="middle_name" class="form-control"  placeholder="Middle Name" value="middle_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Last Name" class="col-sm-3 control-label">Last Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="last_name" id="last_name" class="form-control"  placeholder="Last Name" value="last_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Id Number" class="col-sm-3 control-label">Id Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="id_number" id="id_number" class="form-control"  placeholder="Id Number" value="id_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Primary Phone Number" class="col-sm-3 control-label">Primary Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="primary_phone_number"   placeholder="Phone Number" id="primary_phone_number" class="form-control"  value="primary_phone_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Secondary Phone Number" class="col-sm-3 control-label">Secondary Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="secondary_phone_number"   placeholder="Phone Number" id="secondary_phone_number" class="form-control"  value="secondary_phone_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Gender" class="col-sm-3 control-label">Gender</label>
                                    <div class="col-sm-6">
									    <input type="text" name="gender"   placeholder="Gender" id="gender" class="form-control"  value="gender">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date Of Birth" class="col-sm-3 control-label">Date Of Birth</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Date Of Birth" value="date_of_birth">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Marital Status" class="col-sm-3 control-label">Marital Status</label>
                                    <div class="col-sm-6">
									    <input type="text" name="marital_status" id="marital_status" class="form-control" placeholder="Marital Status" value="marital_status">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Address" class="col-sm-3 control-label">Postal Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_address" id="postal_address" class="form-control"  placeholder="Postal Address" value="postal_address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Code" class="col-sm-3 control-label">Postal Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_code" id="postal_code" class="form-control"  placeholder="Postal Code" value="postal_code">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Town" class="col-sm-3 control-label">Postal Town</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_town" id="postal_town" class="form-control"  placeholder="Postal Town" value="postal_town">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Email Address" class="col-sm-3 control-label">Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="email_address"    class="form-control" placeholder="Email Address" value="email_address"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client Type" class="col-sm-3 control-label">Client Type</label>
                                    <div class="col-sm-6">
									    <input type="text" name="client_type" id="client_type" class="form-control" placeholder="Client Type" value="client_type">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client Category" class="col-sm-3 control-label">Client Category</label>
                                    <div class="col-sm-6">
									    <input type="text" name="client_category" id="client_category" class="form-control" placeholder="Client Category" value="client_category">
                                    </div>
                                </div>
                                            </div>
                                        </fieldset>
									</div>
									<div>
                                        <fieldset>
                                            <legend class="pull-left width-full">residential</legend>
                                            <div class="row">
                                <div class="form-group">
                                    <label for="County" class="col-sm-3 control-label">County</label>
                                    <div class="col-sm-6">
									    <input type="text" name="county" id="county" class="form-control" placeholder="County" value="county">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Sub County" class="col-sm-3 control-label">Sub County</label>
                                    <div class="col-sm-6">
									    <input type="text" name="sub_county" id="sub_county" class="form-control" placeholder="Sub County" value="sub_county">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Location" class="col-sm-3 control-label">Location</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="location" id="location" class="form-control"  placeholder="Location" value="location">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Village" class="col-sm-3 control-label">Village</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="village" id="village" class="form-control"  placeholder="Village" value="village">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Nearest Center" class="col-sm-3 control-label">Nearest Center</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="nearest_center" id="nearest_center" class="form-control"  placeholder="Nearest Center" value="nearest_center">
                                    </div>
                                </div>
                                            </div>
                                        </fieldset>
									</div>
									<div>
                                        <fieldset>
                                            <legend class="pull-left width-full">spouse</legend>
                                            <div class="row">
                                <div class="form-group">
                                    <label for="Spouse First Name" class="col-sm-3 control-label">Spouse First Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_first_name" id="spouse_first_name" class="form-control"  placeholder="Spouse First Name" value="spouse_first_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Middle Name" class="col-sm-3 control-label">Spouse Middle Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_middle_name" id="spouse_middle_name" class="form-control"  placeholder="Spouse Middle Name" value="spouse_middle_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Last Name" class="col-sm-3 control-label">Spouse Last Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_last_name" id="spouse_last_name" class="form-control"  placeholder="Spouse Last Name" value="spouse_last_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Id Number" class="col-sm-3 control-label">Spouse Id Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_id_number" id="spouse_id_number" class="form-control"  placeholder="Spouse Id Number" value="spouse_id_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Primary Phone Number" class="col-sm-3 control-label">Spouse Primary Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_primary_phone_number"   placeholder="Phone Number" id="spouse_primary_phone_number" class="form-control"  value="spouse_primary_phone_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Secondary Phone Number" class="col-sm-3 control-label">Spouse Secondary Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_secondary_phone_number"   placeholder="Phone Number" id="spouse_secondary_phone_number" class="form-control"  value="spouse_secondary_phone_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Email Address" class="col-sm-3 control-label">Spouse Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_email_address"    class="form-control" placeholder="Spouse Email Address" value="spouse_email_address"/>
                                    </div>
                                </div>
                                            </div>
                                        </fieldset>
									</div>
									<div>
                                        <fieldset>
                                            <legend class="pull-left width-full">next of kin</legend>
                                            <div class="row">
                                <div class="form-group">
                                    <label for="Next Of Kin First Name" class="col-sm-3 control-label">Next Of Kin First Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_first_name" id="next_of_kin_first_name" class="form-control"  placeholder="Next Of Kin First Name" value="next_of_kin_first_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Middle Name" class="col-sm-3 control-label">Next Of Kin Middle Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_middle_name" id="next_of_kin_middle_name" class="form-control"  placeholder="Next Of Kin Middle Name" value="next_of_kin_middle_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Last Name" class="col-sm-3 control-label">Next Of Kin Last Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_last_name" id="next_of_kin_last_name" class="form-control"  placeholder="Next Of Kin Last Name" value="next_of_kin_last_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Relationship With Next Of Kin" class="col-sm-3 control-label">Relationship With Next Of Kin</label>
                                    <div class="col-sm-6">
									    <input type="text" name="relationship_with_next_of_kin" id="relationship_with_next_of_kin" class="form-control" placeholder="Relationship With Next Of Kin" value="relationship_with_next_of_kin">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Primary Phone Number" class="col-sm-3 control-label">Next Of Kin Primary Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_primary_phone_number"   placeholder="Phone Number" id="next_of_kin_primary_phone_number" class="form-control"  value="next_of_kin_primary_phone_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Secondary Phone Number" class="col-sm-3 control-label">Next Of Kin Secondary Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_secondary_phone_number" id="next_of_kin_secondary_phone_number" class="form-control"  placeholder="Next Of Kin Secondary Phone Number" value="next_of_kin_secondary_phone_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Email Address" class="col-sm-3 control-label">Next Of Kin Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_email_address"    class="form-control" placeholder="Next Of Kin Email Address" value="next_of_kin_email_address"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin County" class="col-sm-3 control-label">Next Of Kin County</label>
                                    <div class="col-sm-6">
									    <input type="text" name="next_of_kin_county" id="next_of_kin_county" class="form-control" placeholder="Next Of kin County" value="next_of_kin_county">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Sub County" class="col-sm-3 control-label">Next Of Kin Sub County</label>
                                    <div class="col-sm-6">
									    <input type="text" name="next_of_kin_sub_county" id="next_of_kin_sub_county" class="form-control" placeholder="Next Of Kin Sub County" value="next_of_kin_sub_county">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Location" class="col-sm-3 control-label">Next Of Kin Location</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_location" id="next_of_kin_location" class="form-control"  placeholder="Next Of Kin Location" value="next_of_kin_location">
                                    </div>
                                </div>
                                            </div>
                                        </fieldset>
									</div>
									<div>
                                        <fieldset>
                                            <legend class="pull-left width-full">income</legend>
                                            <div class="row">
                                <div class="form-group">
                                    <label for="Main Economic Activity" class="col-sm-3 control-label">Main Economic Activity</label>
                                    <div class="col-sm-6">
									    <input type="text" name="main_economic_activty" id="main_economic_activty" class="form-control" placeholder="Main Economic Activity" value="main_economic_activty">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Secondary Economic Activity" class="col-sm-3 control-label">Secondary Economic Activity</label>
                                    <div class="col-sm-6">
									    <input type="text" name="secondary_economix_activity" id="secondary_ecoomic_activty" class="form-control" placeholder="Secondary Economic Activity" value="secondary_ecoomic_activty">
                                    </div>
                                </div>
                                            </div>
                                        </fieldset>
									</div>
									<div>
                                        <fieldset>
                                            <legend class="pull-left width-full">other</legend>
                                            <div class="row">
                                <div class="form-group">
                                    <label for="Client Photo" class="col-sm-3 control-label">Client Photo</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="client_photo" id="client_photo" class="form-control"  placeholder="Client Photo" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client Finger Print" class="col-sm-3 control-label">Client Finger Print</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="client_finger_print" id="client_finger_print" class="form-control"  placeholder="Client Finger Print" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client Signature" class="col-sm-3 control-label">Client Signature</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="client_signature" id="client_signature" class="form-control"  placeholder="Client Signature" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Comments" class="col-sm-3 control-label">Comments</label>
                                    <div class="col-sm-6">
                                        <Textarea name="comments"  id="comments" class="form-control" row="20" placeholder="Comments" value="comments"></textarea>
                                    </div>
                                </div>
                                            </div>
                                        </fieldset>
									</div>
									<div>
									    <div class="jumbotron m-b-0 text-center">
                                            <p>Final section. Review the data then click submit to complete registration wizard</p>
                                            <button class="btn-success btn-lg btn" type='button' onclick='save()'>Finish</button>
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
		url: "{!! url('/admin/dbimport')!!}",
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
@endsection