@extends("admin.home")
@section("main_content")
<style type="text/css">
	td div img{
		max-width: 64px;
	}
</style>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Client Exits</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Client Exits - DATA <small>client exits data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($clientexitsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('clientexits.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($clientexitsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/clientexitsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($clientexitsdata['usersaccountsroles'][0]->_report==1 || $clientexitsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($clientexitsdata['usersaccountsroles'][0]->_list==1)
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
                    <h4 class="panel-title">DataTable - Autofill</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Exit Number</th>
                                        <th>Client</th>
                                        <th>Request Date</th>
                                        <th>Approved Date</th>
                                        <th>Initiated By</th>
                                        <th>Reason</th>
                                        <th>Remarks</th>
                                        <th>Action</th>         
                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($clientexitsdata['list'] as $clientexits)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $clientexits->exit_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clientexits->clientmodel->client_number !!}
                                	{!! $clientexits->clientmodel->first_name !!}
                                	{!! $clientexits->clientmodel->middle_name !!}
                                	{!! $clientexits->clientmodel->last_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clientexits->request_date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clientexits->approved_date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clientexits->initiatedbymodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clientexits->reason !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clientexits->remarks !!}
                                </div></td>
                                <td>
                <form action="{!! route('clientexits.destroy',$clientexits->id) !!}" method="POST">
                                        @if($clientexitsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('clientexits.show',$clientexits->id) !!}" id='show-clientexits-{!! $clientexits->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($clientexitsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('clientexits.edit',$clientexits->id) !!}" id='edit-clientexits-{!! $clientexits->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-check'></i>
                                        </a>
                                        @endif
                                        @if($clientexitsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-clientexits-{!! $clientexits->id !!}' class='btn btn-sm btn-circle btn-danger'>
                                            <i class='fa fa-btn fa-trash'></i>
                                        </button>
                                        @endif
                </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    @endif
<div class="modal fade modal-message" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                <h4 class="modal-title">Client Exits - Filter Dialog</h4>
            </div>
            <div class="modal-body">
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/clientexitsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="client"  id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($clientexitsdata['clients'] as $clients)
				                                <option value="{!! $clients->id !!}">
					
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Request Date" class="col-sm-3 control-label">Request Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="request_datefrom" id="request_datefrom" class="form-control m-b-5" placeholder="Request Date From" value="">
                                        <input type="text" name="request_dateto" id="request_dateto" class="form-control" placeholder="Request Date To" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approved Date" class="col-sm-3 control-label">Approved Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="approved_datefrom" id="approved_datefrom" class="form-control m-b-5" placeholder="Approved Date From" value="">
                                        <input type="text" name="approved_dateto" id="approved_dateto" class="form-control" placeholder="Approved Date To" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Initiated By" class="col-sm-3 control-label">Initiated By</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="initiated_by"  id="initiated_by">
                                            <option value="" >Select Initiated By</option>				                                @foreach ($clientexitsdata['users'] as $users)
				                                <option value="{!! $users->id !!}">
					
				                                {!! $users->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Reason" class="col-sm-3 control-label">Reason</label>
                                    <div class="col-sm-6">
                                        <Textarea name="reason" id="reason"  class="form-control" row="5" placeholder="Reason" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Remarks" class="col-sm-3 control-label">Remarks</label>
                                    <div class="col-sm-6">
                                        <Textarea name="remarks" id="remarks"  class="form-control" row="5" placeholder="Remarks" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Client Exits
                                        </button>
                                    </div>
                                </div>
                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#request_datefrom").datepicker({todayHighlight:!0,autoclose:!0});
$("#request_dateto").datepicker({todayHighlight:!0,autoclose:!0});
</script>
<script language="javascript" type="text/javascript">
$("#approved_datefrom").datepicker({todayHighlight:!0,autoclose:!0});
$("#approved_dateto").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection