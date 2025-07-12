@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Lgf Transfer Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Lgf Transfer Approvals Update Form <small>lgf transfer approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('lgftransferapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('lgftransferapprovals.update',$lgftransferapprovalsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Lgf Transfer" class="col-sm-3 control-label">Lgf Transfer</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="lgf_transfer" id="lgf_transfer">
                                            <option value="" >Select Lgf Transfer</option>				                                @foreach ($lgftransferapprovalsdata['lgftolgftransfers'] as $lgftolgftransfers)
				                                @if( $lgftolgftransfers->id  ==  $lgftransferapprovalsdata['data']->lgf_transfer  ){
				                                <option selected value="{!! $lgftolgftransfers->id !!}" >
								
				                                {!! $lgftolgftransfers->transaction number!!}
				                                </option>@else
				                                <option value="{!! $lgftolgftransfers->id !!}" >
								
				                                {!! $lgftolgftransfers->transaction number!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_level" id="approval_level">
                                            <option value="" >Select Approval Level</option>				                                @foreach ($lgftransferapprovalsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $lgftransferapprovalsdata['data']->approval_level  ){
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
                                            <option value="" >Select Approval Status</option>				                                @foreach ($lgftransferapprovalsdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $lgftransferapprovalsdata['data']->approval_status  ){
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
                                    <label for="User Account" class="col-sm-3 control-label">User Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="user_account" id="user_account">
                                            <option value="" >Select User Account</option>				                                @foreach ($lgftransferapprovalsdata['usersaccounts'] as $usersaccounts)
				                                @if( $usersaccounts->id  ==  $lgftransferapprovalsdata['data']->user_account  ){
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
                                    <label for="Approved By" class="col-sm-3 control-label">Approved By</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approved_by" id="approved_by">
                                            <option value="" >Select Approved By</option>				                                @foreach ($lgftransferapprovalsdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $lgftransferapprovalsdata['data']->approved_by  ){
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
                                        <Textarea name="remarks" id="remarks" class="form-control" row="20" placeholder="Remarks" value="{!! $lgftransferapprovalsdata['data']->remarks !!}">{!! $lgftransferapprovalsdata['data']->remarks !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Lgf Transfer Approvals
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