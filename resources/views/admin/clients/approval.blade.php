@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Clients</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Approve Client <small>clients details goes here...</small></h1>
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
                        <form action="{!! route('clients.update', $clientsdata['data']->id) !!}" method="POST" class="form-horizontal">

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

                                </ol>
                                <div>
                                    <fieldset>
                                        <legend class="pull-left width-full">basic</legend>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="Client Number" class="col-sm-3 control-label">Client
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <label for="Client Number"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->client_number !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Name" class="col-sm-3 control-label">Name</label>
                                                <div class="col-sm-6">
                                                    <label for="Name"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->first_name !!}
                                                        {!! $clientsdata['data']->middle_name !!} {!! $clientsdata['data']->last_name !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Id Number" class="col-sm-3 control-label">Id Number</label>
                                                <div class="col-sm-6">
                                                    <label for="Id Number"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->id_number !!}</label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Primary Phone Number" class="col-sm-3 control-label">Primary
                                                    Phone Number</label>
                                                <div class="col-sm-6">
                                                    <label for="Primary Phone Number"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->primary_phone_number !!}</label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Secondary Phone Number" class="col-sm-3 control-label">Secondary
                                                    Phone Number</label>
                                                <div class="col-sm-6">
                                                    <label for="Secondary Phone Number"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->secondary_phone_number !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gender" class="col-sm-3 control-label">Gender</label>
                                                <div class="col-sm-6">
                                                    <label for="Gender" class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['genders'] as $genders)
                                                            @if ($genders->id == $clientsdata['data']->gender)
                                                                {!! $genders->name !!}
                                                            @endif
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Salutation" class="col-sm-3 control-label">Salutation</label>
                                                <div class="col-sm-6">
                                                    <label for="Salutation" class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['salutations'] as $salutations)
                                                            {!! $salutations->abbreviation !!}
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Date Of Birth" class="col-sm-3 control-label">Date Of
                                                    Birth</label>
                                                <div class="col-sm-6">
                                                    <label for="Date Of Birth"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->date_of_birth !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Marital Status" class="col-sm-3 control-label">Marital
                                                    Status</label>
                                                <div class="col-sm-6">
                                                    <label for="Marital Status" class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['maritalstatuses'] as $maritalstatuses)
                                                            @if ($maritalstatuses->id == $clientsdata['data']->marital_status)
                                                                {!! $maritalstatuses->name !!}
                                                            @endif
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Postal Address" class="col-sm-3 control-label">Postal
                                                    Address</label>
                                                <div class="col-sm-6">
                                                    <label for="Postal Address"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->postal_address !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Postal Code" class="col-sm-3 control-label">Postal
                                                    Code</label>
                                                <div class="col-sm-6">
                                                    <label for="Postal Code"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->postal_code !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Postal Town" class="col-sm-3 control-label">Postal
                                                    Town</label>
                                                <div class="col-sm-6">
                                                    <label for="Postal Town"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->postal_town !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email Address" class="col-sm-3 control-label">Email
                                                    Address</label>
                                                <div class="col-sm-6">
                                                    <label for="Email Address"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->email_address !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Type" class="col-sm-3 control-label">Client
                                                    Type</label>
                                                <div class="col-sm-6">
                                                    <label for="Client Type" class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['clienttypes'] as $clienttypes)
                                                            @if ($clienttypes->id == $clientsdata['data']->client_type)
                                                                {!! $clienttypes->name !!}
                                                            @endif
                                                        @endforeach
                                                    </label>



                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Category" class="col-sm-3 control-label">Client
                                                    Category</label>
                                                <div class="col-sm-6">
                                                    <label for="Client Category" class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['clientcategories'] as $clientcategories)
                                                            @if ($clientcategories->id == $clientsdata['data']->client_category)
                                                                {!! $clientcategories->name !!}
                                                            @endif
                                                        @endforeach
                                                    </label>
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
                                                    <label for="County" class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['counties'] as $counties)
                                                            @if ($counties->id == $clientsdata['data']->county)
                                                                {!! $counties->name !!}
                                                            @endif
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Sub County" class="col-sm-3 control-label">Sub County</label>
                                                <div class="col-sm-6">
                                                    <label for="Sub County" class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['subcounties'] as $subcounties)
                                                            @if ($subcounties->id == $clientsdata['data']->sub_county)
                                                                {!! $subcounties->name !!}
                                                            @endif
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Location" class="col-sm-3 control-label">Location</label>
                                                <div class="col-sm-6">
                                                    <label for="Location"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->location !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Village" class="col-sm-3 control-label">Village</label>
                                                <div class="col-sm-6">
                                                    <label for="Village"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->village !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Nearest Center" class="col-sm-3 control-label">Nearest
                                                    Center</label>
                                                <div class="col-sm-6">
                                                    <label for="Nearest Center"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->nearest_center !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Home GPS Latitude" class="col-sm-3 control-label">Home GPS
                                                    Latitude</label>
                                                <div class="col-sm-6">
                                                    <label for="Home GPS Latitude"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->home_gps_latitude !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Home GPS Longitude" class="col-sm-3 control-label">Home GPS
                                                    Longitude</label>
                                                <div class="col-sm-6">
                                                    <label for="Home GPS Longitude"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->home_gps_longitude !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Business GPS Latitude" class="col-sm-3 control-label">Business
                                                    GPS Latitude</label>
                                                <div class="col-sm-6">
                                                    <label for="Business GPS Latitude"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->business_gps_latitude !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Business GPS Longitude"
                                                    class="col-sm-3 control-label">Business GPS Longitude</label>
                                                <div class="col-sm-6">
                                                    <label for="Business GPS Longitude"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->business_gps_longitude !!}</label>
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
                                                <label for="Spouse First Name" class="col-sm-3 control-label">Spouse
                                                    Name</label>
                                                <div class="col-sm-6">
                                                    <label for="Spouse Name"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->spouse_first_name !!}
                                                        {!! $clientsdata['data']->spouse_middle_name !!} {!! $clientsdata['data']->spouse_last_name !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Spouse Id Number" class="col-sm-3 control-label">Spouse Id
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <label for="Spouse Id Number"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->spouse_id_number !!}</label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Spouse Primary Phone Number"
                                                    class="col-sm-3 control-label">Spouse Primary Phone Number</label>
                                                <div class="col-sm-6">
                                                    <label for="Spouse Primary Phone Number"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->spouse_primary_phone_number !!}</label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Spouse Secondary Phone Number"
                                                    class="col-sm-3 control-label">Spouse Secondary Phone Number</label>
                                                <div class="col-sm-6">
                                                    <label for="Spouse Secondary Phone Number"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->spouse_secondary_phone_number !!}</label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Spouse Email Address" class="col-sm-3 control-label">Spouse
                                                    Email Address</label>
                                                <div class="col-sm-6">
                                                    <label for="Spouse Email Address"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->spouse_email_address !!}</label>


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
                                                <label for="Next Of Kin First Name" class="col-sm-3 control-label">Next Of
                                                    Kin Name</label>
                                                <div class="col-sm-6">
                                                    <label for="Next Of Kin Name"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->next_of_kin_first_name !!}
                                                        {!! $clientsdata['data']->next_of_kin_middle_name !!} {!! $clientsdata['data']->next_of_kin_last_name !!}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Relationship With Next Of Kin"
                                                    class="col-sm-3 control-label">Relationship With Next Of Kin</label>
                                                <div class="col-sm-6">
                                                    <label for="Relationship With Next Of Kin"
                                                        class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['nextofkinrelationships'] as $nextofkinrelationships)
                                                            @if ($nextofkinrelationships->id == $clientsdata['data']->relationship_with_next_of_kin)
                                                                {!! $nextofkinrelationships->name !!}
                                                            @endif
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Primary Phone Number"
                                                    class="col-sm-3 control-label">Next Of Kin Primary Phone Number</label>
                                                <div class="col-sm-6">
                                                    <label for="Next Of Kin Primary Phone Number"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->next_of_kin_primary_phone_number !!}</label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Secondary Phone Number"
                                                    class="col-sm-3 control-label">Next Of Kin Secondary Phone
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <label for="Next Of Kin Secondary Phone Number"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->next_of_kin_primary_phone_number !!}</label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Email Address" class="col-sm-3 control-label">Next
                                                    Of Kin Email Address</label>
                                                <div class="col-sm-6">
                                                    <label for="Next Of Kin Email Address"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->next_of_kin_email_address !!}</label>


                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin County" class="col-sm-3 control-label">Next Of Kin
                                                    County</label>
                                                <div class="col-sm-6">
                                                    <label for="Next Of Kin County"
                                                        class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['counties'] as $counties)
                                                            @if ($counties->id == $clientsdata['data']->next_of_kin_county)
                                                                {!! $counties->name !!}
                                                            @endif
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Sub County" class="col-sm-3 control-label">Next Of
                                                    Kin Sub County</label>
                                                <div class="col-sm-6">
                                                    <label for="Next Of Kin Sub County"
                                                        class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['subcounties'] as $subcounties)
                                                            @if ($subcounties->id == $clientsdata['data']->next_of_kin_sub_county)
                                                                {!! $subcounties->name !!}
                                                            @endif
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Location" class="col-sm-3 control-label">Next Of
                                                    Kin Location</label>
                                                <div class="col-sm-6">
                                                    <label for="Next Of Kin Location"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->next_of_kin_location !!}</label>

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
                                                    <label for="Main Economic Activity"
                                                        class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['maineconomicactivities'] as $maineconomicactivities)
                                                            @if ($maineconomicactivities->id == $clientsdata['data']->main_economic_activity)
                                                                {!! $maineconomicactivities->name !!}
                                                            @endif
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Secondary Economic Activity"
                                                    class="col-sm-3 control-label">Secondary Economic Activity</label>
                                                <div class="col-sm-6">
                                                    <label for="Secondary Economic Activity"
                                                        class="col-sm-6 control-label text-left">
                                                        @foreach ($clientsdata['secondaryeconomicactivities'] as $secondaryeconomicactivities)
                                                            @if ($secondaryeconomicactivities->id == $clientsdata['data']->secondary_economic_activity)
                                                                {!! $secondaryeconomicactivities->name !!}
                                                            @endif
                                                        @endforeach
                                                    </label>
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
                                                    <img src="secure_asset('/uploads/images/{{ $clientsdata['data']->client_photo }}')"
                                                        alt="client photo" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Finger Print" class="col-sm-3 control-label">Client
                                                    Finger Print</label>
                                                <div class="col-sm-6">
                                                    <img src="secure_asset('/uploads/images/{{ $clientsdata['data']->client_finger_print }}')"
                                                        alt="client finger print photo" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Signature" class="col-sm-3 control-label">Client
                                                    Signature</label>
                                                <div class="col-sm-6">
                                                    <img src="secure_asset('/uploads/images/{{ $clientsdata['data']->client_signature }}')"
                                                        alt="client signature photo" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Photo" class="col-sm-3 control-label">Home Image
                                                    1</label>
                                                <div class="col-sm-6">
                                                    <img src="secure_asset('/uploads/images/{{ $clientsdata['data']->home_image_1 }}')"
                                                        alt="home image 1" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Finger Print" class="col-sm-3 control-label">Home Image
                                                    2</label>
                                                <div class="col-sm-6">
                                                    <img src="secure_asset('/uploads/images/{{ $clientsdata['data']->home_image_2 }}')"
                                                        alt="home image 2" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Signature" class="col-sm-3 control-label">Home Image
                                                    3</label>
                                                <div class="col-sm-6">
                                                    <img src="secure_asset('/uploads/images/{{ $clientsdata['data']->home_image_3 }}')"
                                                        alt="home image 3" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Photo" class="col-sm-3 control-label">Business Image
                                                    1</label>
                                                <div class="col-sm-6">
                                                    <img src="secure_asset('/uploads/images/{{ $clientsdata['data']->business_image_1 }}')"
                                                        alt="business image 1" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Finger Print" class="col-sm-3 control-label">Business
                                                    Image 2</label>
                                                <div class="col-sm-6">
                                                    <img src="secure_asset('/uploads/images/{{ $clientsdata['data']->business_image_2 }}')"
                                                        alt="business image 2" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Client Signature" class="col-sm-3 control-label">Business
                                                    Image 3</label>
                                                <div class="col-sm-6">
                                                    <img src="secure_asset('/uploads/images/{{ $clientsdata['data']->business_image_3 }}')"
                                                        alt="business image 3" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Comments" class="col-sm-3 control-label">Comments</label>
                                                <div class="col-sm-6">
                                                    <label for="Client Number"
                                                        class="col-sm-6 control-label text-left">{!! $clientsdata['data']->comments !!}</label>

                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if ($clientsdata['data']->client_category != $clientsdata['active'][0]['id'])
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
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                    data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">DataForm - Autofill</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="post"
                                action="{{ url('/admin/approveclient/' . $clientsdata['data']->id) }}">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="form-group">
                                        <label for="Client Category" class="col-sm-3 control-label text-right">Make
                                            Client</label>
                                        <div class="col-sm-6">
                                            <label for="Client Number" class="col-sm-6 control-label text-left">
                                                @foreach ($clientsdata['clientcategories'] as $clientcategories)
                                                    @if ($clientcategories->code == '002')
                                                        {!! $clientcategories->name !!}
                                                    @endif
                                                @endforeach
                                            </label>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Client Category" class="col-sm-3 control-label text-right">Expected
                                            Membership Fees</label>
                                        <div class="col-sm-6">
                                            <label for="Client Number" class="col-sm-6 control-label text-left">
                                                @if (isset($clientsdata['clienttypemembershipfees'][0]))
                                                    {{ $clientsdata['clienttypemembershipfees'][0]['fee'] }}
                                                @endif
                                            </label>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Client Category" class="col-sm-3 control-label text-right">Paid
                                            Membership Fees</label>
                                        <div class="col-sm-6">
                                            <label for="Client Number" class="col-sm-6 control-label text-left">
                                                {{ $clientsdata['membershipfees'] }}
                                            </label>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Client Category"
                                            class="col-sm-3 control-label text-right">Comments</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" rows="10">
                                        
                                    </textarea>

                                        </div>
                                    </div>
                                    <div class="jumbotron m-b-0 text-center">

                                        @if (isset($clientsdata['clienttypemembershipfees'][0]))
                                            @if (
                                                $clientsdata['clienttypemembershipfees'][0]['fee'] == $clientsdata['membershipfees'] &&
                                                    $clientsdata['membershipfees'] > 0)
                                                <p>Please note. After submiting the client will be approved.</p>
                                                <button class="btn-success btn-lg btn" type='submit'
                                                    id="btn-save">Approve</button>
                                            @else
                                                <p>There is an issue with membership fees!!</p>
                                            @endif
                                        @endif

                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('script')
    <script language="javascript" type="text/javascript">
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
        $("#primary_phone_number").mask("(999) 999-9999");
        $("#secondary_phone_number").mask("(999) 999-9999");
        $("#date_of_birth").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
        $("#spouse_primary_phone_number").mask("(999) 999-9999");
        $("#spouse_secondary_phone_number").mask("(999) 999-9999");
        $("#next_of_kin_primary_phone_number").mask("(999) 999-9999");
    </script>
@endsection
