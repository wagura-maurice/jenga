@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Lgf To Lgf Transfers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Lgf To Lgf Transfers Approve Form <small>lgf to lgf transfers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('lgftolgftransfers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form class="form-horizontal">
<input type="hidden" name="_method" value="put" />

                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Transaction Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" name="transaction_number" id="transaction_number" class="form-control" placeholder="Transaction Number" value="{!! $lgftolgftransfersdata['data']->transaction_number !!}">
                                    </div>
                                </div>                          
                                <div class="form-group">
                                    <label for="Client From" class="col-sm-3 control-label">Client From</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" class="form-control" value="{!! $lgftolgftransfersdata['data']->clientfrommodel->client_number !!} {!! $lgftolgftransfersdata['data']->clientfrommodel->first_name !!} {!! $lgftolgftransfersdata['data']->clientfrommodel->middle_name !!} {!! $lgftolgftransfersdata['data']->clientfrommodel->last_name !!}">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client To" class="col-sm-3 control-label">Client To</label>
                                    <div class="col-sm-6">
                                        <input type="text"  class="form-control" readonly="" value="{!! $lgftolgftransfersdata['data']->clienttomodel->client_number !!} {!! $lgftolgftransfersdata['data']->clienttomodel->first_name !!} {!! $lgftolgftransfersdata['data']->clienttomodel->middle_name !!} {!! $lgftolgftransfersdata['data']->clienttomodel->last_name !!}">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" name="amount" id="amount" class="form-control" placeholder="Amount" value="{!! $lgftolgftransfersdata['data']->amount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Date" class="col-sm-3 control-label">Transaction Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" name="transaction_date" id="transaction_date" class="form-control" placeholder="Transaction Date" value="{!! $lgftolgftransfersdata['data']->transaction_date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transacted By" class="col-sm-3 control-label">Transacted By</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" class="form-control" placeholder="Transaction Date" value="{!! $lgftolgftransfersdata['data']->transactedbymodel->name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Status" class="col-sm-3 control-label">Approval Status</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" class="form-control" value="{!! $lgftolgftransfersdata['data']->approvalstatusmodel->name !!}">
                                    </div>
                                </div>
                    </form>
                </div>

                @if(isset($lgftolgftransfersdata['otherapprovals']) && count($lgftolgftransfersdata['otherapprovals'])>0)
              
                <div class="panel-body m-b-10">
                    <div class="col-lg-12">
                        <table class="table">
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
                            @foreach ($lgftolgftransfersdata['otherapprovals'] as $lgftransferapprovals)
                                <tr>
                                    <td class='table-text'><div>
                                        {!! $lgftransferapprovals[0]->approvallevelmodel->name !!}
                                    </div></td>
                                    <td class='table-text'><div>
                                        {!! $lgftransferapprovals[0]->approvalstatusmodel->name !!}
                                    </div></td>
                                    <td class='table-text'><div>
                                        {!! $lgftransferapprovals[0]->useraccountmodel->name !!}
                                    </div></td>
                                    <td class='table-text'><div>
                                        {!! $lgftransferapprovals[0]->approvedbymodel->name !!}
                                    </div></td>
                                    <td class='table-text'><div>
                                        {!! $lgftransferapprovals[0]->remarks !!}
                                    </div></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div> 
                @endif 

                @if(isset($lgftolgftransfersdata['mymapping']) && isset($lgftolgftransfersdata['myturn']) && $lgftolgftransfersdata['data']->approvalstatusmodel->code=='003')
                <div class="panel-body m-b-10">
                    <div class="col-lg-12">
                        <form action="{!! route('lgftolgftransfers.update',$lgftolgftransfersdata['data']->id) !!}" method="POST" class="form-horizontal">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="put" />
                            <input type="hidden" readonly="" name="lgf_transfer" id="lgf_transfer" class="form-control" placeholder="Transaction Number" value="{!! $lgftolgftransfersdata['data']->id !!}">
                                    <div class="form-group">
                                        <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                        <div class="col-sm-6">
                                            <input type="text" readonly name="approval_level"  id="approval_level" class="form-control" placeholder="Approval Level" value="{!! $lgftolgftransfersdata['mymapping']->approvallevelmodel->name !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Approval Status" class="col-sm-3 control-label">Approval Status</label>
                                        <div class="col-sm-6">
                                            <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_status"  id="approval_status">
                                                <option value="" >Select Approval Status</option>                                               @foreach ($lgftolgftransfersdata['approvalstatuses'] as $approvalstatuses)
                                                    <option value="{!! $approvalstatuses->id !!}">
                        
                                                    {!! $approvalstatuses->name!!}
                                                    </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Approved By" class="col-sm-3 control-label">Approved By</label>
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
                                                <i class="fa fa-btn fa-plus"></i> Add  Approval
                                            </button>
                                        </div>
                                    </div>
                        </form>
                        
                    </div>
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