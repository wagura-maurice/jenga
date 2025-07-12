@extends('admin.home')
@section('main_content')
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
                <a href="{!! route('clients.index') !!}"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                                data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-success"
                                data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning"
                                data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                                    class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">DataForm - Autofill</h4>
                    </div>
                    <div class="panel-body">
                        <form id="form" class="form-horizontal" enctype="multipart/form-data">
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
                                    <!-- 										<li>
              spouse
              <small>spouse details</small>
              </li>
     -->
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
                                                <label for="First Name" class="col-sm-3 control-label">First Name *</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="first_name" id="first_name"
                                                        class="form-control" placeholder="First Name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Middle Name" class="col-sm-3 control-label">Middle Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="middle_name" id="middle_name"
                                                        class="form-control" placeholder="Middle Name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Last Name" class="col-sm-3 control-label">Last Name *</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="last_name" id="last_name"
                                                        class="form-control" placeholder="Last Name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Id Number" class="col-sm-3 control-label">Id Number * </label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="id_number" id="id_number"
                                                        class="form-control" placeholder="Id Number" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Primary Phone Number" class="col-sm-3 control-label">Primary
                                                    Phone Number *</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="primary_phone_number"
                                                        placeholder="(999) 999-9999" id="primary_phone_number"
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Secondary Phone Number" class="col-sm-3 control-label">Secondary
                                                    Phone Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="secondary_phone_number"
                                                        placeholder="(999) 999-9999" id="secondary_phone_number"
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gender" class="col-sm-3 control-label">Gender * </label>
                                                <div class="col-sm-6">
                                                    <select class="form-control selectpicker" data-size="100000"
                                                        data-live-search="true" data-style="btn-white" name="gender"
                                                        id="gender">
                                                        <option value="">Select Gender</option>
                                                        @foreach ($clientsdata['genders'] as $genders)
                                                            <option value="{!! $genders->id !!}">

                                                                {!! $genders->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Title" class="col-sm-3 control-label">Salutation * </label>
                                                <div class="col-sm-6">
                                                    <select class="form-control selectpicker" data-size="100000"
                                                        data-live-search="true" data-style="btn-white" name="title"
                                                        id="title">
                                                        <option value="">Select Salutation</option>
                                                        @foreach ($clientsdata['salutations'] as $salutations)
                                                            <option value="{!! $salutations->id !!}">

                                                                {!! $salutations->abbreviation !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Date Of Birth" class="col-sm-3 control-label">Date Of Birth *
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="date_of_birth" id="date_of_birth"
                                                        class="form-control" placeholder="Date Of Birth" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Date Of Birth" class="col-sm-3 control-label">Age </label>
                                                <div class="col-sm-6">
                                                    <label for="Date Of Birth" class="control-label"
                                                        id="age"></label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Marital Status" class="col-sm-3 control-label">Marital Status
                                                    * </label>
                                                <div class="col-sm-6">
                                                    <select class="form-control selectpicker" data-size="100000"
                                                        data-live-search="true" data-style="btn-white"
                                                        name="marital_status" id="marital_status" onchange="clientAge()">
                                                        <option value="">Select Marital Status</option>
                                                        @foreach ($clientsdata['maritalstatuses'] as $maritalstatuses)
                                                            <option value="{!! $maritalstatuses->id !!}">

                                                                {!! $maritalstatuses->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="spouse_container" style="display: none;">

                                                <!-- <legend class="pull-left width-full">spouse</legend> -->
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="Spouse First Name"
                                                            class="col-sm-3 control-label">Spouse First Name</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="spouse_first_name"
                                                                id="spouse_first_name" class="form-control"
                                                                placeholder="Spouse First Name" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Spouse Middle Name"
                                                            class="col-sm-3 control-label">Spouse Middle Name</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="spouse_middle_name"
                                                                id="spouse_middle_name" class="form-control"
                                                                placeholder="Spouse Middle Name" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Spouse Last Name"
                                                            class="col-sm-3 control-label">Spouse Last Name</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="spouse_last_name"
                                                                id="spouse_last_name" class="form-control"
                                                                placeholder="Spouse Last Name" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Spouse Id Number"
                                                            class="col-sm-3 control-label">Spouse Id Number</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="spouse_id_number"
                                                                id="spouse_id_number" class="form-control"
                                                                placeholder="Spouse Id Number" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Spouse Primary Phone Number"
                                                            class="col-sm-3 control-label">Spouse Primary Phone
                                                            Number</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="spouse_primary_phone_number"
                                                                placeholder="(999) 999-9999"
                                                                id="spouse_primary_phone_number" class="form-control"
                                                                value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Spouse Secondary Phone Number"
                                                            class="col-sm-3 control-label">Spouse Secondary Phone
                                                            Number</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="spouse_secondary_phone_number"
                                                                placeholder="(999) 999-9999"
                                                                id="spouse_secondary_phone_number" class="form-control"
                                                                value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Spouse Email Address"
                                                            class="col-sm-3 control-label">Spouse Email Address</label>
                                                        <div class="col-sm-6">
                                                            <input type="email" name="spouse_email_address"
                                                                class="form-control" placeholder="Spouse Email Address"
                                                                id="spouse_email_address" value="" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="Postal Address" class="col-sm-3 control-label">Postal
                                                    Address</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="postal_address" id="postal_address"
                                                        class="form-control" placeholder="Postal Address" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Postal Code" class="col-sm-3 control-label">Postal
                                                    Code</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="postal_code" id="postal_code"
                                                        class="form-control" placeholder="Postal Code" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Postal Town" class="col-sm-3 control-label">Postal
                                                    Town</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="postal_town" id="postal_town"
                                                        class="form-control" placeholder="Postal Town" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email Address" class="col-sm-3 control-label">Email
                                                    Address</label>
                                                <div class="col-sm-6">
                                                    <input type="email" name="email_address" class="form-control"
                                                        placeholder="Email Address" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group" id="client-types-form-group">
                                                <label for="Client Type" class="col-sm-3 control-label">Client Type *
                                                </label>
                                                <div class="col-sm-6">
                                                    <select class="form-control selectpicker" data-size="100000"
                                                        data-live-search="true" data-style="btn-white" name="client_type"
                                                        id="client_type" onchange="clientType()">
                                                        <option value="">Select Client Type</option>
                                                        @foreach ($clientsdata['clienttypes'] as $clienttypes)
                                                            <option value="{!! $clienttypes->id !!}">

                                                                {!! $clienttypes->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Category" class="col-sm-3 control-label">Client
                                                    Category * </label>
                                                <div class="col-sm-6">
                                                    <select class="form-control selectpicker" data-size="100000"
                                                        data-live-search="true" data-style="btn-white"
                                                        name="client_category" id="client_category">
                                                        @foreach ($clientsdata['clientcategories'] as $clientcategories)
                                                            @if ($clientcategories->code == '001')
                                                                <option value="{!! $clientcategories->id !!}">

                                                                    {!! $clientcategories->name !!}
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
                                                    <select class="form-control selectpicker" data-size="100000"
                                                        data-live-search="true" data-style="btn-white" name="county"
                                                        id="county" onchange="subCounties()">
                                                        <option value="">Select County</option>
                                                        @foreach ($clientsdata['counties'] as $counties)
                                                            <option value="{!! $counties->id !!}">

                                                                {!! $counties->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Sub County" class="col-sm-3 control-label">Sub County *
                                                </label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="sub_county" id="sub_county">
                                                        <option value="">Select Sub County</option>
                                                        @foreach ($clientsdata['subcounties'] as $subcounties)
                                                            <option value="{!! $subcounties->id !!}">

                                                                {!! $subcounties->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Location" class="col-sm-3 control-label">Location</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="location" id="location"
                                                        class="form-control" placeholder="Location" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Village" class="col-sm-3 control-label">Village</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="village" id="village"
                                                        class="form-control" placeholder="Village" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Nearest Center" class="col-sm-3 control-label">Nearest
                                                    Center</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="nearest_center" id="nearest_center"
                                                        class="form-control" placeholder="Nearest Center" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Home GPS Latitude" class="col-sm-3 control-label">Home GPS
                                                    Latitude</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="home_gps_latitude" id="home_gps_latitude"
                                                        class="form-control" placeholder="Home GPS Latitude"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Home GPS Longitude" class="col-sm-3 control-label">Home GPS
                                                    Longitude</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="home_gps_longitude"
                                                        id="home_gps_longitude" class="form-control"
                                                        placeholder="Home GPS Longitude" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Business GPS Latitude" class="col-sm-3 control-label">Business
                                                    GPS Latitude</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="business_gps_latitude"
                                                        id="business_gps_latitude" class="form-control"
                                                        placeholder="Business GPS Latitude" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Business GPS Longitude"
                                                    class="col-sm-3 control-label">Business GPS Longitude</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="business_gps_longitude"
                                                        id="business_gps_longitude" class="form-control"
                                                        placeholder="Business GPS Longitude" value="">
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
                                                <label for="Relationship With Next Of Kin"
                                                    class="col-sm-3 control-label">Relationship With Next Of Kin</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control selectpicker" data-size="100000"
                                                        data-live-search="true" data-style="btn-white"
                                                        name="relationship_with_next_of_kin"
                                                        id="relationship_with_next_of_kin" onchange="spouseAsNextOfKin()">
                                                        <option value="">Select Relationship With Next Of Kin
                                                        </option>
                                                        @foreach ($clientsdata['nextofkinrelationships'] as $nextofkinrelationships)
                                                            <option value="{!! $nextofkinrelationships->id !!}">

                                                                {!! $nextofkinrelationships->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="Next Of Kin First Name" class="col-sm-3 control-label">Next Of
                                                    Kin First Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="next_of_kin_first_name"
                                                        id="next_of_kin_first_name" class="form-control"
                                                        placeholder="Next Of Kin First Name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Middle Name" class="col-sm-3 control-label">Next
                                                    Of Kin Middle Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="next_of_kin_middle_name"
                                                        id="next_of_kin_middle_name" class="form-control"
                                                        placeholder="Next Of Kin Middle Name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Last Name" class="col-sm-3 control-label">Next Of
                                                    Kin Last Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="next_of_kin_last_name"
                                                        id="next_of_kin_last_name" class="form-control"
                                                        placeholder="Next Of Kin Last Name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Primary Phone Number"
                                                    class="col-sm-3 control-label">Next Of Kin Primary Phone Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="next_of_kin_primary_phone_number"
                                                        placeholder="(999) 999-9999" id="next_of_kin_primary_phone_number"
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Secondary Phone Number"
                                                    class="col-sm-3 control-label">Next Of Kin Secondary Phone
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="next_of_kin_secondary_phone_number"
                                                        id="next_of_kin_secondary_phone_number" class="form-control"
                                                        placeholder="Next Of Kin Secondary Phone Number" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Email Address" class="col-sm-3 control-label">Next
                                                    Of Kin Email Address</label>
                                                <div class="col-sm-6">
                                                    <input type="email" name="next_of_kin_email_address"
                                                        id="next_of_kin_email_address" class="form-control"
                                                        placeholder="Next Of Kin Email Address" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin County" class="col-sm-3 control-label">Next Of Kin
                                                    County</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control selectpicker" data-size="100000"
                                                        data-live-search="true" data-style="btn-white"
                                                        name="next_of_kin_county" id="next_of_kin_county"
                                                        onchange="nextOfKinSubCounties()">
                                                        <option value="">Select Next Of Kin County</option>
                                                        @foreach ($clientsdata['counties'] as $counties)
                                                            <option value="{!! $counties->id !!}">

                                                                {!! $counties->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Sub County" class="col-sm-3 control-label">Next Of
                                                    Kin Sub County</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="next_of_kin_sub_county"
                                                        id="next_of_kin_sub_county">
                                                        <option value="">Select Next Of Kin Sub County</option>
                                                        @foreach ($clientsdata['subcounties'] as $subcounties)
                                                            <option value="{!! $subcounties->id !!}">

                                                                {!! $subcounties->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Location" class="col-sm-3 control-label">Next Of
                                                    Kin Location</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="next_of_kin_location"
                                                        id="next_of_kin_location" class="form-control"
                                                        placeholder="Next Of Kin Location" value="">
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
                                                <label for="Main Economic Activity"
                                                    class="col-sm-3 control-label">Business Type</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control selectpicker" data-size="100000"
                                                        data-live-search="true" data-style="btn-white"
                                                        name="main_economic_activity" id="main_economic_activity">
                                                        <option value="">Select Business Type</option>
                                                        @foreach ($clientsdata['maineconomicactivities'] as $maineconomicactivities)
                                                            <option value="{!! $maineconomicactivities->id !!}">

                                                                {!! $maineconomicactivities->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Secondary Economic Activity"
                                                    class="col-sm-3 control-label">Secondary Economic Activity</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control selectpicker" data-size="100000"
                                                        data-live-search="true" data-style="btn-white"
                                                        name="secondary_economic_activity"
                                                        id="secondary_economic_activity">
                                                        <option value="">Select Secondary Economic Activity</option>
                                                        @foreach ($clientsdata['secondaryeconomicactivities'] as $secondaryeconomicactivities)
                                                            <option value="{!! $secondaryeconomicactivities->id !!}">

                                                                {!! $secondaryeconomicactivities->name !!}
                                                            </option>
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
                                                <label for="Client Photo" class="col-sm-3 control-label">Client
                                                    Photo</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="client_photo" id="client_photo"
                                                        class="form-control" placeholder="Client Photo"
                                                        onchange="checkImage(this)" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Finger Print" class="col-sm-3 control-label">Client
                                                    Finger Print</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="client_finger_print"
                                                        id="client_finger_print" class="form-control"
                                                        onchange="checkImage(this)" placeholder="Client Finger Print"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Signature" class="col-sm-3 control-label">Client
                                                    Signature</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="client_signature" id="client_signature"
                                                        class="form-control" onchange="checkImage(this)"
                                                        placeholder="Client Signature" value="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="Home Image 1" class="col-sm-3 control-label">Home Image
                                                    1</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="home_image_1" id="home_image_1"
                                                        class="form-control" onchange="checkImage(this)"
                                                        placeholder="Home Image 1" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Home Image 2" class="col-sm-3 control-label">Home Image
                                                    2</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="home_image_2" id="home_image_2"
                                                        class="form-control" onchange="checkImage(this)"
                                                        placeholder="Home Image 2" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Home Image 3" class="col-sm-3 control-label">Home Image
                                                    3</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="home_image_3" id="home_image_3"
                                                        class="form-control" onchange="checkImage(this)"
                                                        placeholder="Home Image 3" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Business Image 1" class="col-sm-3 control-label">Business
                                                    Image 1</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="business_image_1" id="business_image_1"
                                                        class="form-control" onchange="checkImage(this)"
                                                        placeholder="Business Image 1" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Business Image 2" class="col-sm-3 control-label">Business
                                                    Image 2</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="business_image_2" id="business_image_2"
                                                        class="form-control" onchange="checkImage(this)"
                                                        placeholder="Business Image 2" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Business Image 3" class="col-sm-3 control-label">Business
                                                    Image 3</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="business_image_3" id="business_image_3"
                                                        class="form-control" onchange="checkImage(this)"
                                                        placeholder="Business Image 3" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Front National ID" class="col-sm-3 control-label">Front
                                                    National ID</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="front_national_id" id="front_national_id"
                                                        class="form-control" onchange="checkImage(this)"
                                                        placeholder="Front National ID" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Back National ID" class="col-sm-3 control-label">Back National
                                                    ID</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="back_national_id" id="back_national_id"
                                                        class="form-control" onchange="checkImage(this)"
                                                        placeholder="Back National ID" value="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="Comments" class="col-sm-3 control-label">Comments</label>
                                                <div class="col-sm-6">
                                                    <Textarea name="comments" id="comments" class="form-control" row="20" placeholder="Comments"
                                                        value=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div>
                                    <div class="jumbotron m-b-0 text-center">
                                        <p>Final section. Review the data then click submit to complete registration wizard
                                        </p>
                                        <button class="btn-success btn-lg btn" type='button' id="btn-save"
                                            onclick='save()'>Finish</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language="javascript" type="text/javascript">
        function clientAge() {
            var dob = new Date($("#date_of_birth").val());

            console.log("dob - " + dob);
            var today = new Date();
            console.log("today - " + today);
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000))
            console.log("age - " + age);
            $("#age").html(age);

            $.ajax({
                type: 'GET',
                url: "{!! url('/admin/getmaritalstatus/') !!}" + "/" + $("#marital_status").val(),
                data: JSON.stringify({
                    '_token': "{{ csrf_token() }}"
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    if (obj.code == "002") {
                        $("#spouse_container").css("display", "block");
                    } else {
                        $("#spouse_container").css("display", "none");
                    }
                }
            });

            if (age < 18) {
                $.gritter.add({
                    title: 'Age Limit',
                    text: "Client Must Be 18 Years Old and above!",
                    sticky: false,
                    time: '10000',
                });

                $("#age").html("");
                $("#date_of_birth").val("");
                return;
            }
        }

        function subCounties() {
            var county = $("#county").val();
            // var token=$("input[name=_token]").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/getsubcounties/') !!}",
                data: JSON.stringify({
                    'county': county,
                    '_token': "{{ csrf_token() }}"
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    // console.log(obj);
                    $("#sub_county option").remove();

                    var option = "<option value=''>Select Sub County</option>";
                    $("#sub_county").append(option);


                    for (var r = 0; r < obj.length; r++) {

                        var option = "<option value='" + obj[r].id + "'>" + obj[r].code + " " + obj[r].name +
                            "</option>";
                        $("#sub_county").append(option);

                    }
                }
            });

        }

        function nextOfKinSubCounties() {
            var county = $("#next_of_kin_county").val();
            // var token=$("input[name=_token]").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/getsubcounties/') !!}",
                data: JSON.stringify({
                    'county': county,
                    '_token': "{{ csrf_token() }}"
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    // console.log(obj);
                    $("#next_of_kin_sub_county option").remove();

                    var option = "<option value=''>Select Next Of Kin Sub County</option>";
                    $("#next_of_kin_sub_county").append(option);


                    for (var r = 0; r < obj.length; r++) {

                        var option = "<option value='" + obj[r].id + "'>" + obj[r].code + " " + obj[r].name +
                            "</option>";
                        $("#next_of_kin_sub_county").append(option);

                    }
                }
            });

        }
        var groups = 0;
        var bdos = 0;

        function clientType() {

            var clientType = $("#client_type").val();
            // var token=$("input[name=_token]").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/getclienttype/') !!}",
                data: JSON.stringify({
                    'id': clientType,
                    '_token': "{{ csrf_token() }}"
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    // console.log(obj);
                    if (obj == null) {
                        $("div#bdos-form-group").remove();
                        $("div#groups-form-group").remove();
                        $("div#compnay-name-form-group").remove();
                        $("div#registration-number-form-group").remove();
                        $("div#pin-number-form-group").remove();
                        $("div#industry-form-group").remove();


                    } else {
                        if (obj.code == "001") {
                            $("div#bdos-form-group").remove();
                            $("div#groups-form-group").remove();
                            $("div#compnay-name-form-group").remove();
                            $("div#registration-number-form-group").remove();
                            $("div#pin-number-form-group").remove();
                            $("div#industry-form-group").remove();

                            var formGroup = $(
                                "<div class=\"form-group\" id=\"groups-form-group\"><label for=\"Groups\" class=\"col-sm-3 control-label\">Group * </label><div class=\"col-sm-6\"><select class=\"form-control selectpicker\" data-size=\"100000\" data-live-search=\"true\" data-style=\"btn-white\" name=\"client_group\"  id=\"client_group\"><option value=\"\" required>Select Client Group</option>                                               @foreach ($clientsdata['groups'] as $groups)<option value=\"{!! $groups->id !!}\">{!! $groups->group_name !!}</option>@endforeach</select></div></div>"
                                );
                            formGroup.insertAfter("div#client-types-form-group");
                        } else if ((obj.code == "003")) {
                            $("div#bdos-form-group").remove();
                            $("div#groups-form-group").remove();
                            $("div#compnay-name-form-group").remove();
                            $("div#registration-number-form-group").remove();
                            $("div#pin-number-form-group").remove();
                            $("div#industry-form-group").remove();

                            var formGroup = $(
                                "<div class=\"form-group\" id=\"bdos-form-group\"><label for=\"Officers\" class=\"col-sm-3 control-label\">BDO * </label><div class=\"col-sm-6\"><select class=\"form-control selectpicker\" data-size=\"100000\" data-live-search=\"true\" data-style=\"btn-white\" name=\"bdo\"  id=\"bdo\"><option value=\"\" >Select BDO Officer</option>                                               @foreach ($clientsdata['employees'] as $employees)<option value=\"{!! $employees->id !!}\">{!! $employees->first_name !!} {!! $employees->middle_name !!} {!! $employees->last_name !!}</option>@endforeach</select></div></div>"
                                );
                            formGroup.insertAfter("div#client-types-form-group");

                            formGroup = $(
                                "<div class=\"form-group\" id=\"compnay-name-form-group\"><label for=\"Company Name\" class=\"col-sm-3 control-label\">Company Name * </label><div class=\"col-sm-6\"><input type='text' name='compnay-name' id='compnay-name' placeholder='Company Name' class='form-control'/></div></div>"
                                );
                            formGroup.insertAfter("div#bdos-form-group");

                            formGroup = $(
                                "<div class=\"form-group\" id=\"registration-number-form-group\"><label for=\"Registration Number\" class=\"col-sm-3 control-label\">Registration Number * </label><div class=\"col-sm-6\"><input type='text' name='registration-number' placeholder='Registration Number' id='registration-number' class='form-control'/></div></div>"
                                );
                            formGroup.insertAfter("div#compnay-name-form-group");

                            formGroup = $(
                                "<div class=\"form-group\" id=\"pin-number-form-group\"><label for=\"Pin Number\" class=\"col-sm-3 control-label\">Pin Number * </label><div class=\"col-sm-6\"><input type='text' name='pin-number' id='pin-number' placeholder='Pin Number' class='form-control'/></div></div>"
                                );
                            formGroup.insertAfter("div#registration-number-form-group");

                            var formGroup = $(
                                "<div class=\"form-group\" id=\"industry-form-group\"><label for=\"Industry\" class=\"col-sm-3 control-label\">Industry * </label><div class=\"col-sm-6\"><select class=\"form-control selectpicker\" data-size=\"100000\" data-live-search=\"true\" data-style=\"btn-white\" name=\"industry\"  id=\"industry\"><option value=\"\" >Select Industry</option>                                               @foreach ($clientsdata['industries'] as $industries)<option value=\"{!! $industries->id !!}\">{!! $industries->code !!} {!! $industries->name !!} </option>@endforeach</select></div></div>"
                                );
                            formGroup.insertAfter("div#pin-number-form-group");

                        } else if ((obj.code != "001") && (obj.code != "003")) {


                            $("div#bdos-form-group").remove();
                            $("div#groups-form-group").remove();
                            $("div#compnay-name-form-group").remove();
                            $("div#registration-number-form-group").remove();
                            $("div#pin-number-form-group").remove();
                            $("div#industry-form-group").remove();
                            var formGroup = $(
                                "<div class=\"form-group\" id=\"bdos-form-group\"><label for=\"Officers\" class=\"col-sm-3 control-label\">BDO * </label><div class=\"col-sm-6\"><select class=\"form-control selectpicker\" data-size=\"100000\" data-live-search=\"true\" data-style=\"btn-white\" name=\"bdo\"  id=\"bdo\"><option value=\"\" >Select BDO Officer</option>                                               @foreach ($clientsdata['employees'] as $employees)<option value=\"{!! $employees->id !!}\">{!! $employees->first_name !!} {!! $employees->middle_name !!} {!! $employees->last_name !!}</option>@endforeach</select></div></div>"
                                );
                            formGroup.insertAfter("div#client-types-form-group");

                        }





                    }
                }
            });
        }

        function spouseAsNextOfKin() {
            $.ajax({
                type: 'GET',
                url: "{!! url('/admin/getnextofkinrelationship/') !!}" + "/" + $("#relationship_with_next_of_kin").val(),
                data: JSON.stringify({
                    'id': clientType,
                    '_token': "{{ csrf_token() }}"
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    if (obj.code == "005" || obj.code == "006") {
                        $("#next_of_kin_first_name").val($("#spouse_first_name").val());
                        $("#next_of_kin_middle_name").val($("#spouse_middle_name").val());
                        $("#next_of_kin_last_name").val($("#spouse_last_name").val());
                        $("#next_of_kin_primary_phone_number").val($("#spouse_primary_phone_number").val());
                        $("#next_of_kin_email_address").val($("#spouse_email_address").val())
                        $("#next_of_kin_secondary_phone_number").val($("#spouse_secondary_phone_number").val())
                        $("#next_of_kin_first_name").val($("#spouse_first_name").val())
                    }
                }
            });
        }

        function checkImage(obj) {
            var files = obj.files;
            console.log(files);
            var fileType = files[0]["type"];
            var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
            if ($.inArray(fileType, ValidImageTypes) < 0) {

                $.gritter.add({
                    title: 'Image Upload Error',
                    text: files[0]["name"] + " is not a valid image file!",
                    sticky: false,
                    time: '10000',
                });
                var input = obj;

                $(input).wrap("<form>").closest("form").get(0).reset();
                $(input).unwrap();
            }

        }

        function save() {

            $("#btn-save").attr("disabled", true);
            if ($("#client_photo").prop("files").length == 0) {
                $.gritter.add({
                    title: 'Warning',
                    text: "Client Photo Is Empty!",
                    sticky: false,
                    time: '1000',
                });
                $("#btn-save").attr("disabled", false);
                return;
            }

            if ($("#client_signature").prop("files").length == 0) {
                $.gritter.add({
                    title: 'Warning',
                    text: "Client Signature Is Empty!",
                    sticky: false,
                    time: '1000',
                });
                $("#btn-save").attr("disabled", false);
                return;
            }


            if ($("#client_finger_print").prop("files").length == 0) {
                $.gritter.add({
                    title: 'Warning',
                    text: "Client Finger Print Is Empty!",
                    sticky: false,
                    time: '1000',
                });
                $("#btn-save").attr("disabled", false);
                return;
            }

            if ($("#primary_phone_number").val() == "" || $("#primary_phone_number").val() == null) {
                $.gritter.add({
                    title: 'Warning',
                    text: "Client Number Is Empty!",
                    sticky: false,
                    time: '1000',
                });
                $("#btn-save").attr("disabled", false);
                return;

            }

            if ($("#first_name").val() == "" || $("#first_name").val() == null || $("#last_name").val() == "" || $(
                    "#last_name").val() == null) {
                $.gritter.add({
                    title: 'Warning',
                    text: "Name is Empty!",
                    sticky: false,
                    time: '1000',
                });
                $("#btn-save").attr("disabled", false);
                return;

            }


            var formData = new FormData($('#form')[0]);
            $.ajax({
                type: 'POST',
                url: "{!! route('clients.store') !!}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#btn-save").attr("disabled", false);
                    var obj = jQuery.parseJSON(data);
                    if (obj.status == '1') {
                        $.gritter.add({
                            title: 'Success',
                            text: obj.message,
                            sticky: false,
                            time: '1000',
                        });
                        $("#form")[0].reset();
                    } else {
                        $.gritter.add({
                            title: 'Fail',
                            text: obj.message,
                            sticky: false,
                            time: '10000',
                        });
                    }
                },
                error: function(data) {
                    $("#btn-save").attr("disabled", false);
                    console.log(data)
                    $.gritter.add({
                        title: 'Error',
                        text: 'An Error occured. Please review your data then submit again!!',
                        sticky: false,
                        time: '10000',
                    });
                }
            });
            return false;
        }
    </script>
@endsection
@section('script')
    <script language="javascript" type="text/javascript">
        $("#primary_phone_number").mask("(999) 999-9999");
        $("#secondary_phone_number").mask("(999) 999-9999");
        $("#date_of_birth").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
        $("#spouse_primary_phone_number").mask("(999) 999-9999");
        $("#spouse_secondary_phone_number").mask("(999) 999-9999");
        $("#next_of_kin_primary_phone_number").mask("(999) 999-9999");
        $(document).ready(function() {
            // function clientsCount(){


            //     $.ajax({
            //         type:'POST',
            //         url: "{!! url('/admin/clientscount/') !!}",
            //         data:JSON.stringify({'_token':"{{ csrf_token() }}"}),
            //         contentType: 'application/json',
            //         processData: false,
            //         success:function(data){
            //             var obj = jQuery.parseJSON( data );
            //             if(obj<10){
            //                 $("#client_number").val("C0000"+(obj+1));
            //             }else if(obj<100){
            //                 $("#client_number").val("C000"+(obj+1));
            //             }else if(obj<1000){
            //                 $("#client_number").val("C00"+(obj+1));
            //             }else if(obj<10000){
            //                 $("#client_number").val("C0"+(obj+1));
            //             }else{
            //                 $("#client_number").val("C"+(obj+1));
            //             }

            //             // console.log(obj);
            //         }
            //     });

            // } 
            // clientsCount();

        });
        $("#next_of_kin_secondary_phone_number").mask("(999) 999-9999");
    </script>
@endsection
