@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Disbursement Charges Configurations </a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Disbursement Charges Configurations  Update Form <small>disbursement charges configurations  details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('disbursementchargesconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('disbursementchargesconfigurations.update',$disbursementchargesconfigurationsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan Product" class="col-sm-3 control-label">Loan Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="loan_product" id="loan_product">
                                            <option value="" >Select Loan Product</option>				                                @foreach ($disbursementchargesconfigurationsdata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $disbursementchargesconfigurationsdata['data']->loan_product  ){
				                                <option selected value="{!! $loanproducts->id !!}" >
								
				                                {!! $loanproducts->name!!}
				                                </option>@else
				                                <option value="{!! $loanproducts->id !!}" >
								
				                                {!! $loanproducts->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Disbursement Charge" class="col-sm-3 control-label">Disbursement Charge</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="disbursement_charge" id="disbursement_charge">
                                            <option value="" >Select Disbursement Charge</option>				                                @foreach ($disbursementchargesconfigurationsdata['disbursementcharges'] as $disbursementcharges)
				                                @if( $disbursementcharges->id  ==  $disbursementchargesconfigurationsdata['data']->disbursement_charge  ){
				                                <option selected value="{!! $disbursementcharges->id !!}" >
								
				                                {!! $disbursementcharges->name!!}
				                                </option>@else
				                                <option value="{!! $disbursementcharges->id !!}" >
								
				                                {!! $disbursementcharges->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Disbursement Mode" class="col-sm-3 control-label">Disbursement Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="disbursement_mode" id="disbursement_mode">
                                            <option value="" >Select Disbursement Mode</option>				                                @foreach ($disbursementchargesconfigurationsdata['disbursementmodes'] as $disbursementmodes)
				                                @if( $disbursementmodes->id  ==  $disbursementchargesconfigurationsdata['data']->disbursement_mode  ){
				                                <option selected value="{!! $disbursementmodes->id !!}" >
								
				                                {!! $disbursementmodes->name!!}
				                                </option>@else
				                                <option value="{!! $disbursementmodes->id !!}" >
								
				                                {!! $disbursementmodes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Debit Account" class="col-sm-3 control-label">Debit Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="debit_account" id="debit_account">
                                            <option value="" >Select Debit Account</option>				                                @foreach ($disbursementchargesconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $disbursementchargesconfigurationsdata['data']->debit_account  ){
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
                                            <option value="" >Select Credit Account</option>				                                @foreach ($disbursementchargesconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $disbursementchargesconfigurationsdata['data']->credit_account  ){
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
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" value="{!! $disbursementchargesconfigurationsdata['data']->amount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Disbursement Charges Configurations 
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