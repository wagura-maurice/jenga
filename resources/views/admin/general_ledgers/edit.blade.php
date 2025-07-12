@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">General Ledgers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">General Ledgers Update Form <small>general ledgers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('generalledgers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('generalledgers.update',$generalledgersdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Account" class="col-sm-3 control-label">Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="account" id="account">
                                            <option value="" >Select Account</option>				                                @foreach ($generalledgersdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $generalledgersdata['data']->account  ){
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
                                    <label for="Entry Type" class="col-sm-3 control-label">Entry Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="entry_type" id="entry_type">
                                            <option value="" >Select Entry Type</option>				                                @foreach ($generalledgersdata['entrytypes'] as $entrytypes)
				                                @if( $entrytypes->id  ==  $generalledgersdata['data']->entry_type  ){
				                                <option selected value="{!! $entrytypes->id !!}" >
								
				                                {!! $entrytypes->name!!}
				                                </option>@else
				                                <option value="{!! $entrytypes->id !!}" >
								
				                                {!! $entrytypes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="transaction_number" id="transaction_number" class="form-control" placeholder="Transaction Number" value="{!! $generalledgersdata['data']->transaction_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" value="{!! $generalledgersdata['data']->amount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="date" id="date" class="form-control" placeholder="Date" value="{!! $generalledgersdata['data']->date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit General Ledgers
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
$("#date").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection