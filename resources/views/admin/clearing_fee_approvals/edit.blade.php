@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Clearing Fee Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Clearing Fee Approvals Update Form <small>clearing fee approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('clearingfeeapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('clearingfeeapprovals.update',$clearingfeeapprovalsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Transaction Reference" class="col-sm-3 control-label">Transaction Reference</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="transaction_reference" id="transaction_reference">
                                            <option value="" >Select Transaction Reference</option>				                                @foreach ($clearingfeeapprovalsdata['clearingfeepayments'] as $clearingfeepayments)
				                                @if( $clearingfeepayments->id  ==  $clearingfeeapprovalsdata['data']->transaction_reference  ){
				                                <option selected value="{!! $clearingfeepayments->id !!}" >
								
				                                {!! $clearingfeepayments->transaction_reference!!}
				                                </option>@else
				                                <option value="{!! $clearingfeepayments->id !!}" >
								
				                                {!! $clearingfeepayments->transaction_reference!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_level" id="approval_level">
                                            <option value="" >Select Approval Level</option>				                                @foreach ($clearingfeeapprovalsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $clearingfeeapprovalsdata['data']->approval_level  ){
				                                <option selected value="{!! $approvallevels->id !!}" >
								
				                                {!! $approvallevels->name!!}
				                                </option>@else
				                                <option value="{!! $approvallevels->id !!}" >
								
				                                {!! $approvallevels->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approved By" class="col-sm-3 control-label">Approved By</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approved_by" id="approved_by">
                                            <option value="" >Select Approved By</option>				                                @foreach ($clearingfeeapprovalsdata['users'] as $users)
				                                @if( $users->id  ==  $clearingfeeapprovalsdata['data']->approved_by  ){
				                                <option selected value="{!! $users->id !!}" >
								
				                                {!! $users->name!!}
				                                </option>@else
				                                <option value="{!! $users->id !!}" >
								
				                                {!! $users->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Status" class="col-sm-3 control-label">Approval Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_status" id="approval_status">
                                            <option value="" >Select Approval Status</option>				                                @foreach ($clearingfeeapprovalsdata['transactionstatuses'] as $transactionstatuses)
				                                @if( $transactionstatuses->id  ==  $clearingfeeapprovalsdata['data']->approval_status  ){
				                                <option selected value="{!! $transactionstatuses->id !!}" >
								
				                                {!! $transactionstatuses->name!!}
				                                </option>@else
				                                <option value="{!! $transactionstatuses->id !!}" >
								
				                                {!! $transactionstatuses->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="date" id="date" class="form-control" placeholder="Date" value="{!! $clearingfeeapprovalsdata['data']->date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Clearing Fee Approvals
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