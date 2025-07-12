@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Membership Fee Configurations</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Membership Fee Configurations Update Form <small>membership fee configurations details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('membershipfeeconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('membershipfeeconfigurations.update',$membershipfeeconfigurationsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Client Type" class="col-sm-3 control-label">Client Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="client_type" id="client_type">
                                            <option value="" >Select Client Type</option>				                                @foreach ($membershipfeeconfigurationsdata['clienttypes'] as $clienttypes)
				                                @if( $clienttypes->id  ==  $membershipfeeconfigurationsdata['data']->client_type  ){
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
                                    <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="payment_mode" id="payment_mode">
                                            <option value="" >Select Payment Mode</option>				                                @foreach ($membershipfeeconfigurationsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $membershipfeeconfigurationsdata['data']->payment_mode  ){
				                                <option selected value="{!! $paymentmodes->id !!}" >
								
				                                {!! $paymentmodes->name!!}
				                                </option>@else
				                                <option value="{!! $paymentmodes->id !!}" >
								
				                                {!! $paymentmodes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Debit Account" class="col-sm-3 control-label">Debit Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="debit_account" id="debit_account">
                                            <option value="" >Select Debit Account</option>				                                @foreach ($membershipfeeconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $membershipfeeconfigurationsdata['data']->debit_account  ){
				                                <option selected value="{!! $accounts->id !!}" >
								
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@else
				                                <option value="{!! $accounts->id !!}" >
								
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Credit Account" class="col-sm-3 control-label">Credit Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="credit_account" id="credit_account">
                                            <option value="" >Select Credit Account</option>				                                @foreach ($membershipfeeconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $membershipfeeconfigurationsdata['data']->credit_account  ){
				                                <option selected value="{!! $accounts->id !!}" >
								
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@else
				                                <option value="{!! $accounts->id !!}" >
								
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Membership Fee Configurations
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
@endsection