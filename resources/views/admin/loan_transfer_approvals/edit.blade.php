@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Transfer Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Transfer Approvals Update Form <small>loan transfer approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loantransferapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('loantransferapprovals.update',$loantransferapprovalsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan Transfer" class="col-sm-3 control-label">Loan Transfer</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="loan_transfer" id="loan_transfer">
                                            <option value="" >Select Loan Transfer</option>				                                @foreach ($loantransferapprovalsdata['lgftoloantransfers'] as $lgftoloantransfers)
				                                @if( $lgftoloantransfers->id  ==  $loantransferapprovalsdata['data']->loan_transfer  ){
				                                <option selected value="{!! $lgftoloantransfers->id !!}" >
								
				                                {!! $lgftoloantransfers->transaction_number!!}
				                                </option>@else
				                                <option value="{!! $lgftoloantransfers->id !!}" >
								
				                                {!! $lgftoloantransfers->transaction_number!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_level" id="approval_level">
                                            <option value="" >Select Approval Level</option>				                                @foreach ($loantransferapprovalsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $loantransferapprovalsdata['data']->approval_level  ){
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
                                    <label for="Approval Status" class="col-sm-3 control-label">Approval Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_status" id="approval_status">
                                            <option value="" >Select Approval Status</option>				                                @foreach ($loantransferapprovalsdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $loantransferapprovalsdata['data']->approval_status  ){
				                                <option selected value="{!! $approvalstatuses->id !!}" >
								
				                                {!! $approvalstatuses->name!!}
				                                </option>@else
				                                <option value="{!! $approvalstatuses->id !!}" >
								
				                                {!! $approvalstatuses->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Remarks" class="col-sm-3 control-label">Remarks</label>
                                    <div class="col-sm-6">
                                        <Textarea name="remarks" id="remarks" class="form-control" row="20" placeholder="Remarks" value="{!! $loantransferapprovalsdata['data']->remarks !!}">{!! $loantransferapprovalsdata['data']->remarks !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approved By" class="col-sm-3 control-label">Approved By</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approved_by" id="approved_by">
                                            <option value="" >Select Approved By</option>				                                @foreach ($loantransferapprovalsdata['users'] as $users)
				                                @if( $users->id  ==  $loantransferapprovalsdata['data']->approved_by  ){
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
                                    <label for="Users_accounts" class="col-sm-3 control-label">Users_accounts</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="users_accounts" id="users_accounts">
                                            <option value="" >Select Users_accounts</option>				                                @foreach ($loantransferapprovalsdata['usersaccounts'] as $usersaccounts)
				                                @if( $usersaccounts->id  ==  $loantransferapprovalsdata['data']->users_accounts  ){
				                                <option selected value="{!! $usersaccounts->id !!}" >
								
				                                {!! $usersaccounts->name!!}
				                                </option>@else
				                                <option value="{!! $usersaccounts->id !!}" >
								
				                                {!! $usersaccounts->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Loan Transfer Approvals
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