@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Clients</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Clients Update Form <small>clients details goes here...</small></h1>
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
                    <form action="{!! route('clients.update',$clientsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
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
                                    <label for="Client Number" class="col-sm-3 control-label">Client Number *</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="client_number" id="client_number" class="form-control" readonly placeholder="First Name" value="{{ $clientsdata['data']->client_number }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="First Name" class="col-sm-3 control-label">First Name *</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="first_name" id="first_name" class="form-control"  placeholder="First Name" value="{{ $clientsdata['data']->first_name }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Middle Name" class="col-sm-3 control-label">Middle Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="middle_name" id="middle_name" class="form-control"  placeholder="Middle Name" value="{{ $clientsdata['data']->middle_name }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Last Name" class="col-sm-3 control-label">Last Name *</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="last_name" id="last_name" class="form-control"  placeholder="Last Name" value="{{ $clientsdata['data']->last_name }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Id Number" class="col-sm-3 control-label">Id Number * </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="id_number" id="id_number" class="form-control"  placeholder="Id Number" value="{{ $clientsdata['data']->id_number }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Primary Phone Number" class="col-sm-3 control-label">Primary Phone Number *</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="primary_phone_number"   placeholder="(999) 999-9999" id="primary_phone_number" class="form-control"  value="{{ $clientsdata['data']->primary_phone_number }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Secondary Phone Number" class="col-sm-3 control-label">Secondary Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="secondary_phone_number"   placeholder="(999) 999-9999" id="secondary_phone_number" class="form-control"  value="{{ $clientsdata['data']->secondary_phone_number }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Gender" class="col-sm-3 control-label">Gender * </label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="gender"  id="gender">
                                            <option value="" >Select Gender</option>				                                @foreach ($clientsdata['genders'] as $genders)
				                                <option value="{!! $genders->id !!}" {!! $genders->id == $clientsdata['data']->gender ? 'selected' : NULL !!}>
								
				                                {!! $genders->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Title" class="col-sm-3 control-label">Salutation * </label>
                                    <div class="col-sm-6">
                                        <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="title"  id="title">
                                            <option value="" >Select Salutation</option>                                                @foreach ($clientsdata['salutations'] as $salutations)
                                                <option value="{!! $salutations->id !!}" {!! $salutations->id == $clientsdata['data']->salutation ? 'selected' : NULL !!}>
                                
                                                {!! $salutations->abbreviation!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label for="Date Of Birth" class="col-sm-3 control-label">Date Of Birth * </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Date Of Birth" value="{{ $clientsdata['data']->date_of_birth }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date Of Birth" class="col-sm-3 control-label">Age </label>
                                    <div class="col-sm-6">
                                        <label for="Date Of Birth" class="control-label" id="age"></label>
                                        
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label for="Marital Status" class="col-sm-3 control-label">Marital Status * </label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="marital_status"  id="marital_status" onchange="clientAge()">
                                            <option value="" >Select Marital Status</option>				                                @foreach ($clientsdata['maritalstatuses'] as $maritalstatuses)
				                                <option value="{!! $maritalstatuses->id !!}" {!! $maritalstatuses->id == $clientsdata['data']->marital_status ? 'selected' : NULL !!}>
								
				                                {!! $maritalstatuses->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Address" class="col-sm-3 control-label">Postal Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_address" id="postal_address" class="form-control"  placeholder="Postal Address" value="{{ $clientsdata['data']->postal_address }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Code" class="col-sm-3 control-label">Postal Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_code" id="postal_code" class="form-control"  placeholder="Postal Code" value="{{ $clientsdata['data']->postal_code }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Town" class="col-sm-3 control-label">Postal Town</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_town" id="postal_town" class="form-control"  placeholder="Postal Town" value="{{ $clientsdata['data']->postal_town }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Email Address" class="col-sm-3 control-label">Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email_address"    class="form-control" placeholder="Email Address" value="{{ $clientsdata['data']->email_address }}"/>
                                    </div>
                                </div>
                                <div class="form-group" id="client-types-form-group">
                                    <label for="Client Type" class="col-sm-3 control-label">Client Type * </label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="client_type"  id="client_type" onchange="clientType()">
                                            <option value="" >Select Client Type</option>				                                @foreach ($clientsdata['clienttypes'] as $clienttypes)
				                                <option value="{!! $clienttypes->id !!}" {!! $clienttypes->id == $clientsdata['data']->client_type ? 'selected' : NULL !!}>
								
				                                {!! $clienttypes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client Category" class="col-sm-3 control-label">Client Category * </label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="client_category"  id="client_category">
                                            @foreach ($clientsdata['clientcategories'] as $clientcategories)
                                                @if($clientcategories->code=="001")
				                                <option value="{!! $clientcategories->id !!}" {!! $clientcategories->id == $clientsdata['data']->client_category ? 'selected' : NULL !!}>
								
				                                {!! $clientcategories->name!!}
				                                </option>
                                                @endif
				                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                            </div>
                                        </fieldset>
									</div>
									<div>
                                        <fieldset>
                                            <legend class="pull-left width-full">residential </legend>
                                            <div class="row">
                                <div class="form-group">
                                    <label for="County" class="col-sm-3 control-label">County * </label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="county"  id="county" onchange="subCounties()">
                                            <option value="" >Select County</option>				                                @foreach ($clientsdata['counties'] as $counties)
				                                <option value="{!! $counties->id !!}" {!! $counties->id == $clientsdata['data']->county ? 'selected' : NULL !!}>
								
				                                {!! $counties->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Sub County" class="col-sm-3 control-label">Sub County * </label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="sub_county"  id="sub_county">
                                            <option value="" >Select Sub County</option>				                                @foreach ($clientsdata['subcounties'] as $subcounties)
				                                <option value="{!! $subcounties->id !!}" {!! $subcounties->id == $clientsdata['data']->sub_county ? 'selected' : NULL !!}>
								
				                                {!! $subcounties->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Location" class="col-sm-3 control-label">Location</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="location" id="location" class="form-control"  placeholder="Location" value="{{ $clientsdata['data']->location }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Village" class="col-sm-3 control-label">Village</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="village" id="village" class="form-control"  placeholder="Village" value="{{ $clientsdata['data']->village }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Nearest Center" class="col-sm-3 control-label">Nearest Center</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="nearest_center" id="nearest_center" class="form-control"  placeholder="Nearest Center" value="{{ $clientsdata['data']->nearest_center }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Home GPS Latitude" class="col-sm-3 control-label">Home GPS Latitude</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="home_gps_latitude" id="home_gps_latitude" class="form-control"  placeholder="Home GPS Latitude" value="{{ $clientsdata['data']->home_gps_latitude }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Home GPS Longitude" class="col-sm-3 control-label">Home GPS Longitude</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="home_gps_longitude" id="home_gps_longitude" class="form-control"  placeholder="Home GPS Longitude" value="{{ $clientsdata['data']->home_gps_longitude }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Business GPS Latitude" class="col-sm-3 control-label">Business GPS Latitude</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="business_gps_latitude" id="business_gps_latitude" class="form-control"  placeholder="Business GPS Latitude" value="{{ $clientsdata['data']->business_gps_latitude }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Business GPS Longitude" class="col-sm-3 control-label">Business GPS Longitude</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="business_gps_longitude" id="business_gps_longitude" class="form-control"  placeholder="Business GPS Longitude" value="{{ $clientsdata['data']->business_gps_longitude }}">
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
                                        <input type="text" name="spouse_first_name" id="spouse_first_name" class="form-control"   placeholder="Spouse First Name" value="{!! $clientsdata['data']->spouse_first_name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Middle Name" class="col-sm-3 control-label">Spouse Middle Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_middle_name" id="spouse_middle_name" class="form-control"   placeholder="Spouse Middle Name" value="{!! $clientsdata['data']->spouse_middle_name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Last Name" class="col-sm-3 control-label">Spouse Last Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_last_name" id="spouse_last_name" class="form-control"   placeholder="Spouse Last Name" value="{!! $clientsdata['data']->spouse_last_name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Id Number" class="col-sm-3 control-label">Spouse Id Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_id_number" id="spouse_id_number" class="form-control"   placeholder="Spouse Id Number" value="{!! $clientsdata['data']->spouse_id_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Primary Phone Number" class="col-sm-3 control-label">Spouse Primary Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_primary_phone_number" id="spouse_primary_phone_number" class="form-control" placeholder="Spouse Primary Phone Number" value="{!! $clientsdata['data']->spouse_primary_phone_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Secondary Phone Number" class="col-sm-3 control-label">Spouse Secondary Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="spouse_secondary_phone_number" id="spouse_secondary_phone_number" class="form-control" placeholder="Spouse Secondary Phone Number" value="{!! $clientsdata['data']->spouse_secondary_phone_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Spouse Email Address" class="col-sm-3 control-label">Spouse Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="spouse_email_address"    class="form-control" placeholder="Spouse Email Address" value="{!! $clientsdata['data']->spouse_email_address !!}"/>
                                    </div>
                                </div>
                                            </div>
                                        </fieldset>
									</div>
									<div>
                                        <fieldset>
                                            <legend class="pull-left width-full">next of kine</legend>
                                            <div class="row">
                                <div class="form-group">
                                    <label for="Next Of Kin First Name" class="col-sm-3 control-label">Next Of Kin First Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_first_name" id="next_of_kin_first_name" class="form-control"   placeholder="Next Of Kin First Name" value="{!! $clientsdata['data']->next_of_kin_first_name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Middle Name" class="col-sm-3 control-label">Next Of Kin Middle Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_middle_name" id="next_of_kin_middle_name" class="form-control"   placeholder="Next Of Kin Middle Name" value="{!! $clientsdata['data']->next_of_kin_middle_name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Last Name" class="col-sm-3 control-label">Next Of Kin Last Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_last_name" id="next_of_kin_last_name" class="form-control"   placeholder="Next Of Kin Last Name" value="{!! $clientsdata['data']->next_of_kin_last_name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Relationship With Next Of Kin" class="col-sm-3 control-label">Relationship With Next Of Kin</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="relationship_with_next_of_kin" id="relationship_with_next_of_kin">
                                            <option value="" >Select Relationship With Next Of Kin</option>				                                @foreach ($clientsdata['nextofkinrelationships'] as $nextofkinrelationships)
				                                @if( $nextofkinrelationships->id  ==  $clientsdata['data']->relationship_with_next_of_kin  ){
				                                <option selected value="{!! $nextofkinrelationships->id !!}" >
								
				                                {!! $nextofkinrelationships->name!!}
				                                </option>@else
				                                <option value="{!! $nextofkinrelationships->id !!}" >
								
				                                {!! $nextofkinrelationships->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Primary Phone Number" class="col-sm-3 control-label">Next Of Kin Primary Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_primary_phone_number" id="next_of_kin_primary_phone_number" class="form-control" placeholder="Next Of Kin Primary Phone Number" value="{!! $clientsdata['data']->next_of_kin_primary_phone_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Secondary Phone Number" class="col-sm-3 control-label">Next Of Kin Secondary Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_secondary_phone_number" id="next_of_kin_secondary_phone_number" class="form-control"   placeholder="Next Of Kin Secondary Phone Number" value="{!! $clientsdata['data']->next_of_kin_secondary_phone_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Email Address" class="col-sm-3 control-label">Next Of Kin Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="next_of_kin_email_address"    class="form-control" placeholder="Next Of Kin Email Address" value="{!! $clientsdata['data']->next_of_kin_email_address !!}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin County" class="col-sm-3 control-label">Next Of Kin County</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="next_of_kin_county" id="next_of_kin_county">
                                            <option value="" >Select Next Of Kin County</option>				                                @foreach ($clientsdata['counties'] as $counties)
				                                @if( $counties->id  ==  $clientsdata['data']->next_of_kin_county  ){
				                                <option selected value="{!! $counties->id !!}" >
								
				                                {!! $counties->name!!}
				                                </option>@else
				                                <option value="{!! $counties->id !!}" >
								
				                                {!! $counties->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Sub County" class="col-sm-3 control-label">Next Of Kin Sub County</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="next_of_kin_sub_county" id="next_of_kin_sub_county">
                                            <option value="" >Select Next Of Kin Sub County</option>				                                @foreach ($clientsdata['subcounties'] as $subcounties)
				                                @if( $subcounties->id  ==  $clientsdata['data']->next_of_kin_sub_county  ){
				                                <option selected value="{!! $subcounties->id !!}" >
								
				                                {!! $subcounties->name!!}
				                                </option>@else
				                                <option value="{!! $subcounties->id !!}" >
								
				                                {!! $subcounties->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Next Of Kin Location" class="col-sm-3 control-label">Next Of Kin Location</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="next_of_kin_location" id="next_of_kin_location" class="form-control"   placeholder="Next Of Kin Location" value="{!! $clientsdata['data']->next_of_kin_location !!}">
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
                                    <label for="Main Economic Activity" class="col-sm-3 control-label">Business Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="main_economic_activity" id="main_economic_activity">
                                            <option value="" >Select Business Type</option>				                                @foreach ($clientsdata['maineconomicactivities'] as $maineconomicactivities)
				                                @if( $maineconomicactivities->id  ==  $clientsdata['data']->main_economic_activity  ){
				                                <option selected value="{!! $maineconomicactivities->id !!}" >
								
				                                {!! $maineconomicactivities->name!!}
				                                </option>@else
				                                <option value="{!! $maineconomicactivities->id !!}" >
								
				                                {!! $maineconomicactivities->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Secondary Economic Activity" class="col-sm-3 control-label">Secondary Economic Activity</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="secondary_economic_activity" id="secondary_economic_activity">
                                            <option value="" >Select Secondary Economic Activity</option>				                                @foreach ($clientsdata['secondaryeconomicactivities'] as $secondaryeconomicactivities)
				                                @if( $secondaryeconomicactivities->id  ==  $clientsdata['data']->secondary_economic_activity  ){
				                                <option selected value="{!! $secondaryeconomicactivities->id !!}" >
								
				                                {!! $secondaryeconomicactivities->name!!}
				                                </option>@else
				                                <option value="{!! $secondaryeconomicactivities->id !!}" >
								
				                                {!! $secondaryeconomicactivities->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
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
                                        <input type="file" name="client_photo" id="client_photo" class="form-control"  placeholder="Client Photo" onchange="checkImage(this)" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client Finger Print" class="col-sm-3 control-label">Client Finger Print</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="client_finger_print" id="client_finger_print" class="form-control" onchange="checkImage(this)" placeholder="Client Finger Print" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client Signature" class="col-sm-3 control-label">Client Signature</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="client_signature" id="client_signature" class="form-control" onchange="checkImage(this)" placeholder="Client Signature" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Home Image 1" class="col-sm-3 control-label">Home Image 1</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="home_image_1" id="home_image_1" class="form-control" onchange="checkImage(this)" placeholder="Home Image 1" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Home Image 2" class="col-sm-3 control-label">Home Image 2</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="home_image_2" id="home_image_2" class="form-control" onchange="checkImage(this)" placeholder="Home Image 2" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Home Image 3" class="col-sm-3 control-label">Home Image 3</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="home_image_3" id="home_image_3" class="form-control" onchange="checkImage(this)" placeholder="Home Image 3" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Business Image 1" class="col-sm-3 control-label">Business Image 1</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="business_image_1" id="business_image_1" class="form-control" onchange="checkImage(this)" placeholder="Business Image 1" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Business Image 2" class="col-sm-3 control-label">Business Image 2</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="business_image_2" id="business_image_2" class="form-control" onchange="checkImage(this)" placeholder="Business Image 2" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Business Image 3" class="col-sm-3 control-label">Business Image 3</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="business_image_3" id="business_image_3" class="form-control" onchange="checkImage(this)" placeholder="Business Image 3" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Front National ID" class="col-sm-3 control-label">Front National ID</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="front_national_id" id="front_national_id" class="form-control" onchange="checkImage(this)" placeholder="Front National ID" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Back National ID" class="col-sm-3 control-label">Back National ID</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="back_national_id" id="back_national_id" class="form-control" onchange="checkImage(this)" placeholder="Back National ID" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Comments" class="col-sm-3 control-label">Comments</label>
                                    <div class="col-sm-6">
                                        <Textarea name="comments"  id="comments" class="form-control" row="20" placeholder="Comments" value=""></textarea>
                                    </div>
                                </div>
                                            </div>
                                        </fieldset>
									</div>
									<div>
									    <div class="jumbotron m-b-0 text-center">
                                            <p>Final section. Review the data then click submit to complete registration wizard</p>
                                            <button class="btn-success btn-lg btn" >Finish</button>
									</div>
								</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
function subCounties(){
    var county=$("#county").val();
    // var token=$("input[name=_token]").val();
    $.ajax({
        type:'POST',
        url: "{!! url('/admin/getsubcounties/')!!}",
        data:JSON.stringify({'county':county,'_token':"{{ csrf_token() }}"}),
        contentType: 'application/json',
        processData: false,
        success:function(data){
            var obj = jQuery.parseJSON( data );
            // console.log(obj);
            $("#sub_county option").remove();
            
            var option="<option value=''>Select Sub County</option>";
            $("#sub_county").append(option);
            

            for(var r=0;r<obj.length;r++){
                
                var option="<option value='"+obj[r].id+"'>"+obj[r].code+" "+obj[r].name+"</option>";
                $("#sub_county").append(option);
                
            }
        }
    });
 
}    

function nextOfKinSubCounties(){
    var county=$("#next_of_kin_county").val();
    // var token=$("input[name=_token]").val();
    $.ajax({
        type:'POST',
        url: "{!! url('/admin/getsubcounties/')!!}",
        data:JSON.stringify({'county':county,'_token':"{{ csrf_token() }}"}),
        contentType: 'application/json',
        processData: false,
        success:function(data){
            var obj = jQuery.parseJSON( data );
            // console.log(obj);
            $("#next_of_kin_sub_county option").remove();
            
            var option="<option value=''>Select Next Of Kin Sub County</option>";
            $("#next_of_kin_sub_county").append(option);
            

            for(var r=0;r<obj.length;r++){
                
                var option="<option value='"+obj[r].id+"'>"+obj[r].code+" "+obj[r].name+"</option>";
                $("#next_of_kin_sub_county").append(option);
                
            }
        }
    });
 
}    
$("#primary_phone_number").mask("(999) 999-9999");
$("#secondary_phone_number").mask("(999) 999-9999");
$("#date_of_birth").datepicker({todayHighlight:!0,autoclose:!0});
$("#spouse_primary_phone_number").mask("(999) 999-9999");
$("#spouse_secondary_phone_number").mask("(999) 999-9999");
$("#next_of_kin_primary_phone_number").mask("(999) 999-9999");
</script>
@endsection