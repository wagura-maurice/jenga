@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Guarantors</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Guarantors Update Form <small>guarantors details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('guarantors.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('guarantors.update',$guarantorsdata['data']->id) !!}" method="POST" class="form-horizontal">
                        <input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="First Name" class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-6">
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="{!! $guarantorsdata['data']->first_name !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Middle Name" class="col-sm-3 control-label">Middle Name</label>
                            <div class="col-sm-6">
                                <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle Name" value="{!! $guarantorsdata['data']->middle_name !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Last Name" class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-6">
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="{!! $guarantorsdata['data']->last_name !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Id Number" class="col-sm-3 control-label">Id Number</label>
                            <div class="col-sm-6">
                                <input type="text" name="id_number" id="id_number" class="form-control" placeholder="Id Number" value="{!! $guarantorsdata['data']->id_number !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Client " class="col-sm-3 control-label">Client </label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="client" id="client">
                                    <option value="">Select Client </option> @foreach ($guarantorsdata['clients'] as $clients)
                                    @if( $clients->id == $guarantorsdata['data']->client ){
                                    <option selected value="{!! $clients->id !!}">

                                        {!! $clients->client_number!!}
                                        {!! $clients->first_name!!}
                                        {!! $clients->middle_name!!}
                                        {!! $clients->last_name!!}
                                    </option>@else
                                    <option value="{!! $clients->id !!}">

                                        {!! $clients->client_number!!}
                                        {!! $clients->first_name!!}
                                        {!! $clients->middle_name!!}
                                        {!! $clients->last_name!!}
                                    </option>@endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="County" class="col-sm-3 control-label">Relationship</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="relationship" id="relationship">
                                    <option value="">Select Relationship</option> @foreach ($guarantorsdata['relationships'] as $relationship)
                                    @if( $relationship->id == $guarantorsdata['data']->relationship ){
                                    <option selected value="{!! $relationship->id !!}">

                                        {!! $relationship->name!!}
                                    </option>@else
                                    <option value="{!! $relationship->id !!}">

                                        {!! $relationship->name!!}
                                    </option>@endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="County" class="col-sm-3 control-label">County</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="county" id="county">
                                    <option value="">Select County</option> @foreach ($guarantorsdata['counties'] as $counties)
                                    @if( $counties->id == $guarantorsdata['data']->county ){
                                    <option selected value="{!! $counties->id !!}">

                                        {!! $counties->name!!}
                                    </option>@else
                                    <option value="{!! $counties->id !!}">

                                        {!! $counties->name!!}
                                    </option>@endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Sub County" class="col-sm-3 control-label">Sub County</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="sub_county" id="sub_county">
                                    <option value="">Select Sub County</option> @foreach ($guarantorsdata['subcounties'] as $subcounties)
                                    @if( $subcounties->id == $guarantorsdata['data']->sub_county ){
                                    <option selected value="{!! $subcounties->id !!}">

                                        {!! $subcounties->name!!}
                                    </option>@else
                                    <option value="{!! $subcounties->id !!}">

                                        {!! $subcounties->name!!}
                                    </option>@endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Primary Phone Number" class="col-sm-3 control-label">Primary Phone Number</label>
                            <div class="col-sm-6">
                                <input type="text" name="primary_phone_number" id="primary_phone_number" placeholder="(999) 999-9999" class="form-control" placeholder="Primary Phone Number" value="{!! $guarantorsdata['data']->primary_phone_number !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Secondary Phone Number" class="col-sm-3 control-label">Secondary Phone Number</label>
                            <div class="col-sm-6">
                                <input type="text" name="secondary_phone_number" id="secondary_phone_number" class="form-control" placeholder="Secondary Phone Number" value="{!! $guarantorsdata['data']->secondary_phone_number !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Secondary Phone Number" class="col-sm-3 control-label">Photo</label>
                            <div class="col-sm-6">
                                <input type="file" name="photo" id="photo" class="form-control" placeholder="photo" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Secondary Phone Number" class="col-sm-3 control-label">ID Copy</label>
                            <div class="col-sm-6">
                                <input type="file" name="id_copy" id="id_copy" class="form-control" placeholder="ID Copy" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Secondary Phone Number" class="col-sm-3 control-label">Occupation</label>
                            <div class="col-sm-6">
                                <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Occupation" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-btn fa-plus"></i> Edit Guarantors
                                    </button>
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
    $("#primary_phone_number").mask("(999) 999-9999");
</script>
@endsection