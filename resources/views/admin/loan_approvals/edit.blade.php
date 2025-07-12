@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Approvals Update Form <small>loan approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('loanapprovals.update',$loanapprovalsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="loan" id="loan">
                                            <option value="" >Select Loan</option>				                                @foreach ($loanapprovalsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $loanapprovalsdata['data']->loan  ){
				                                <option selected value="{!! $loans->id !!}" >
								
				                                {!! $loans->loan_number!!}
				                                </option>@else
				                                <option value="{!! $loans->id !!}" >
								
				                                {!! $loans->loan_number!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Level" class="col-sm-3 control-label">Level</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="level" id="level">
                                            <option value="" >Select Level</option>				                                @foreach ($loanapprovalsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $loanapprovalsdata['data']->level  ){
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
                                    <label for="User Account" class="col-sm-3 control-label">User Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="user_account" id="user_account">
                                            <option value="" >Select User Account</option>				                                @foreach ($loanapprovalsdata['usersaccounts'] as $usersaccounts)
				                                @if( $usersaccounts->id  ==  $loanapprovalsdata['data']->user_account  ){
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
                                    <label for="User" class="col-sm-3 control-label">User</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="user" id="user">
                                            <option value="" >Select User</option>				                                @foreach ($loanapprovalsdata['users'] as $users)
				                                @if( $users->id  ==  $loanapprovalsdata['data']->user  ){
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
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="date" id="date" class="form-control" placeholder="Date" value="{!! $loanapprovalsdata['data']->date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Status" class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="status" id="status">
                                            <option value="" >Select Status</option>				                                @foreach ($loanapprovalsdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $loanapprovalsdata['data']->status  ){
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
                                    <label for="Comment" class="col-sm-3 control-label">Comment</label>
                                    <div class="col-sm-6">
                                        <Textarea name="comment" id="comment" class="form-control" row="20" placeholder="Comment" value="{!! $loanapprovalsdata['data']->comment !!}">{!! $loanapprovalsdata['data']->comment !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Loan Approvals
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