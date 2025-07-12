@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Mobile Money Charge Configurations</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Mobile Money Charge Configurations Update Form <small>mobile money charge configurations details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('mobilemoneychargeconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('mobilemoneychargeconfigurations.update',$mobilemoneychargeconfigurationsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Value" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{!! $mobilemoneychargeconfigurationsdata['data']->name !!}">
                                    </div>
                                </div>                        
                                <div class="form-group">
                                    <label for="Client Type" class="col-sm-3 control-label">Client Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="client_type" id="client_type">
                                            <option value="" >Select Client Type</option>				                                @foreach ($mobilemoneychargeconfigurationsdata['clienttypes'] as $clienttypes)
				                                @if( $clienttypes->id  ==  $mobilemoneychargeconfigurationsdata['data']->client_type  ){
				                                <option selected value="{!! $clienttypes->id !!}" >
								
				                                {!! $clienttypes->name!!}
				                                </option>@else
				                                <option value="{!! $clienttypes->id !!}" >
								
				                                {!! $clienttypes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Mobile Money Modes" class="col-sm-3 control-label">Mobile Money Modes</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="mobile_money_modes" id="mobile_money_modes">
                                            <option value="" >Select Mobile Money Modes</option>				                                @foreach ($mobilemoneychargeconfigurationsdata['mobilemoneymodes'] as $mobilemoneymodes)
				                                @if( $mobilemoneymodes->id  ==  $mobilemoneychargeconfigurationsdata['data']->mobile_money_modes  ){
				                                <option selected value="{!! $mobilemoneymodes->id !!}" >
								
				                                {!! $mobilemoneymodes->name!!}
				                                </option>@else
				                                <option value="{!! $mobilemoneymodes->id !!}" >
								
				                                {!! $mobilemoneymodes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Charge Type" class="col-sm-3 control-label">Charge Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="charge_type" id="charge_type">
                                            <option value="" >Select Charge Type</option>				                                @foreach ($mobilemoneychargeconfigurationsdata['feetypes'] as $feetypes)
				                                @if( $feetypes->id  ==  $mobilemoneychargeconfigurationsdata['data']->charge_type  ){
				                                <option selected value="{!! $feetypes->id !!}" >
								
				                                {!! $feetypes->name!!}
				                                </option>@else
				                                <option value="{!! $feetypes->id !!}" >
								
				                                {!! $feetypes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Mobile Money Charge Configurations
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
</script>
@endsection