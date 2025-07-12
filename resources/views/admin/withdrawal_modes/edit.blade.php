@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Withdrawal Modes</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Withdrawal Modes Update Form <small>withdrawal modes details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('withdrawalmodes.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('withdrawalmodes.update',$withdrawalmodesdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Code" class="col-sm-3 control-label">Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="code" id="code" class="form-control" placeholder="Code" value="{!! $withdrawalmodesdata['data']->code !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{!! $withdrawalmodesdata['data']->name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Gateway" class="col-sm-3 control-label">Transaction Gateway</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="transaction_gateway" id="transaction_gateway">
                                            <option value="" >Select Transaction Gateway</option>				                                @foreach ($withdrawalmodesdata['transactiongateways'] as $transactiongateways)
				                                @if( $transactiongateways->id  ==  $withdrawalmodesdata['data']->transaction_gateway  ){
				                                <option selected value="{!! $transactiongateways->id !!}" >
								
				                                {!! $transactiongateways->short_code!!}
				                                {!! $transactiongateways->name!!}
				                                </option>@else
				                                <option value="{!! $transactiongateways->id !!}" >
								
				                                {!! $transactiongateways->short_code!!}
				                                {!! $transactiongateways->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Settlement Account" class="col-sm-3 control-label">Settlement Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="settlement_account" id="settlement_account">
                                            <option value="" >Select Settlement Account</option>				                                @foreach ($withdrawalmodesdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $withdrawalmodesdata['data']->settlement_account  ){
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
                                            <i class="fa fa-btn fa-plus"></i> Edit Withdrawal Modes
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