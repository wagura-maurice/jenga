@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Other Payment Type Account Mappings</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Other Payment Type Account Mappings Update Form <small>other payment type account mappings details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('otherpaymenttypeaccountmappings.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('otherpaymenttypeaccountmappings.update',$otherpaymenttypeaccountmappingsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Other Payment Type" class="col-sm-3 control-label">Other Payment Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="other_payment_type" id="other_payment_type">
                                            <option value="" >Select Other Payment Type</option>				                                @foreach ($otherpaymenttypeaccountmappingsdata['otherpaymenttypes'] as $otherpaymenttypes)
				                                @if( $otherpaymenttypes->id  ==  $otherpaymenttypeaccountmappingsdata['data']->other_payment_type  ){
				                                <option selected value="{!! $otherpaymenttypes->id !!}" >
								
				                                {!! $otherpaymenttypes->name!!}
				                                </option>@else
				                                <option value="{!! $otherpaymenttypes->id !!}" >
								
				                                {!! $otherpaymenttypes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="payment_mode" id="payment_mode">
                                            <option value="" >Select Payment Mode</option>				                                @foreach ($otherpaymenttypeaccountmappingsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $otherpaymenttypeaccountmappingsdata['data']->payment_mode  ){
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
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="debit_account" id="debit_account">
                                            <option value="" >Select Debit Account</option>				                                @foreach ($otherpaymenttypeaccountmappingsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $otherpaymenttypeaccountmappingsdata['data']->debit_account  ){
				                                <option selected value="{!! $accounts->id !!}" >
								
				                                {!! $accounts->name!!}
				                                </option>@else
				                                <option value="{!! $accounts->id !!}" >
								
				                                {!! $accounts->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Credit Account" class="col-sm-3 control-label">Credit Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="credit_account" id="credit_account">
                                            <option value="" >Select Credit Account</option>				                                @foreach ($otherpaymenttypeaccountmappingsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $otherpaymenttypeaccountmappingsdata['data']->credit_account  ){
				                                <option selected value="{!! $accounts->id !!}" >
								
				                                {!! $accounts->name!!}
				                                </option>@else
				                                <option value="{!! $accounts->id !!}" >
								
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
                                            <i class="fa fa-btn fa-plus"></i> Edit Other Payment Type Account Mappings
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