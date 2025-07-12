@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Lgf To Bank Transfers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Lgf To Bank Transfers Approval Form <small>lgf to bank transfers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('lgftobanktransfers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('lgftobanktransfers.update',$lgftobanktransfersdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" name="transaction_number" id="transaction_number" class="form-control" placeholder="Transaction Number" value="{!! $lgftobanktransfersdata['data']->transaction_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <input type="text" readonly="" class="form-control" value="{!! $lgftobanktransfersdata['data']->clientmodel->client_number !!} {!! $lgftobanktransfersdata['data']->clientmodel->first_name !!}{!! $lgftobanktransfersdata['data']->clientmodel->middle_name !!}{!! $lgftobanktransfersdata['data']->clientmodel->last_name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Bank" class="col-sm-3 control-label">Bank</label>
                                    <div class="col-sm-6">
									    <input type="text" readonly="" class="form-control" name="" value="{!!$lgftobanktransfersdata['data']->bankmodel->code!!} {!!$lgftobanktransfersdata['data']->bankmodel->name!!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Bank Branch" class="col-sm-3 control-label">Bank Branch</label>
                                    <div class="col-sm-6">
									    <input type="text" readonly="" class="form-control" name="" value="{!!$lgftobanktransfersdata['data']->bankbranchmodel->code!!} {!!$lgftobanktransfersdata['data']->bankbranchmodel->name!!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Bank Account Number" class="col-sm-3 control-label">Bank Account Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" name="bank_account_number" id="bank_account_number" class="form-control" placeholder="Bank Account Number" value="{!! $lgftobanktransfersdata['data']->bank_account_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" name="amount" id="amount" class="form-control" placeholder="Amount" value="{!! $lgftobanktransfersdata['data']->amount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Charge" class="col-sm-3 control-label">Transaction Charge</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" name="transaction_charge" id="transaction_charge" class="form-control" placeholder="Transaction Charge" value="{!! $lgftobanktransfersdata['data']->transaction_charge !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Initiated By" class="col-sm-3 control-label">Initiated By</label>
                                    <div class="col-sm-6">
									    <input type="text" readonly="" class="form-control" value="{!! $lgftobanktransfersdata['data']->initiatedbymodel->name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Status" class="col-sm-3 control-label">Approval Status</label>
                                    <div class="col-sm-6">
									    <input type="text" readonly="" class="form-control" value="{!! $lgftobanktransfersdata['data']->approvalstatusmodel->name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Date" class="col-sm-3 control-label">Transaction Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" name="transaction_date" id="transaction_date" class="form-control" placeholder="Transaction Date" value="{!! $lgftobanktransfersdata['data']->transaction_date !!}">
                                    </div>
                                </div>
                    </form>
                </div>
                @if(isset($lgftobanktransfersdata['otherapprovals']) && count($lgftobanktransfersdata['otherapprovals'])>0)
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Approval Level</th>
                                        <th>Approval Status</th>
                                        <th>User Account</th>
                                        <th>Approved By</th>
                                        <th>Remarks</th>
                                                                           </tr>
                        </thead>
                        <tbody>
                        @foreach ($lgftobanktransfersdata['otherapprovals'] as $loantransferapprovals)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $loantransferapprovals[0]->approvallevelmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $loantransferapprovals[0]->approvalstatusmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $loantransferapprovals[0]->useraccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $loantransferapprovals[0]->approvedbymodel->name !!}
                                </div></td>
                                <td>{!! $loantransferapprovals[0]->remarks !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>  
                @endif
                @if(isset($lgftobanktransfersdata['mymapping']) && isset($lgftobanktransfersdata['myturn']) && $lgftobanktransfersdata['data']->approvalstatusmodel->code=='003')
                <div class="panel-body">
                    <form action="{!! route('lgftobanktransfers.update',$lgftobanktransfersdata['data']->id) !!}" method="POST" class="form-horizontal">
                        <input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <input type="hidden" readonly="" name="loan_transfer" id="loan_transfer" class="form-control" placeholder="Transaction Number" value="{!! $lgftobanktransfersdata['data']->id !!}">
                                <div class="form-group">
                                    <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly name="approval_level"  id="approval_level" class="form-control" placeholder="Approval Level" value="{!! $lgftobanktransfersdata['mymapping']->approvallevelmodel->name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Status" class="col-sm-3 control-label">Approval Status</label>
                                    <div class="col-sm-6">
                                        <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_status"  id="approval_status">
                                            <option value="" >Select Approval Status</option>                                               @foreach ($lgftobanktransfersdata['approvalstatuses'] as $approvalstatuses)
                                                <option value="{!! $approvalstatuses->id !!}">
                    
                                                {!! $approvalstatuses->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>                                <div class="form-group">
                                    <label for="User" class="col-sm-3 control-label">Approved By</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" class="form-control" value="{{ strtoupper(Auth::user()->name) }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Remarks" class="col-sm-3 control-label">Remarks</label>
                                    <div class="col-sm-6">
                                        <Textarea name="remarks" id="remarks"  class="form-control" row="20" placeholder="Remarks" value=""></textarea>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add Loan Transfer Approvals
                                        </button>
                                    </div>
                                </div>
                    </form>
                </div>  
                @endif                  
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#transaction_date").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection