@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Change Group Requests</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Change Group Requests - DATA <small>change group requests data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($changegrouprequestsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('changegrouprequests.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($changegrouprequestsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/changegrouprequestsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($changegrouprequestsdata['usersaccountsroles'][0]->_report==1 || $changegrouprequestsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
    @if($changegrouprequestsdata['usersaccountsroles'][0]->_list==1)
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
                    <h4 class="panel-title">DataTable - Autofill</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Current Group</th>
                                        <th>New Group</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Comments</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($changegrouprequestsdata['list'] as $changegrouprequests)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $changegrouprequests->clientmodel->client_number !!}
                                	{!! $changegrouprequests->clientmodel->first_name !!}
                                	{!! $changegrouprequests->clientmodel->middle_name !!}
                                	{!! $changegrouprequests->clientmodel->last_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $changegrouprequests->currentgroupmodel->group_number !!}
                                	{!! $changegrouprequests->currentgroupmodel->group_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $changegrouprequests->newgroupmodel->group_number !!}
                                	{!! $changegrouprequests->newgroupmodel->group_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $changegrouprequests->date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $changegrouprequests->statusmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $changegrouprequests->comments !!}
                                </div></td>
                                <td>
                <form action="{!! route('changegrouprequests.destroy',$changegrouprequests->id) !!}" method="POST">
                                        @if($changegrouprequestsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('changegrouprequests.show',$changegrouprequests->id) !!}" id='show-changegrouprequests-{!! $changegrouprequests->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($changegrouprequestsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('changegrouprequests.edit',$changegrouprequests->id) !!}" id='edit-changegrouprequests-{!! $changegrouprequests->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($changegrouprequestsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-changegrouprequests-{!! $changegrouprequests->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Change Group Requests - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/changegrouprequestsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="client"  id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($changegrouprequestsdata['clients'] as $clients)
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
                                    <label for="Current Group" class="col-sm-3 control-label">Current Group</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="current_group"  id="current_group">
                                            <option value="" >Select Current Group</option>				                                @foreach ($changegrouprequestsdata['groups'] as $groups)
				                                <option value="{!! $groups->id !!}">
					
				                                {!! $groups->group_number!!}
				                                {!! $groups->group_name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="New Group" class="col-sm-3 control-label">New Group</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="new_group"  id="new_group">
                                            <option value="" >Select New Group</option>				                                @foreach ($changegrouprequestsdata['groups'] as $groups)
				                                <option value="{!! $groups->id !!}">
					
				                                {!! $groups->group_number!!}
				                                {!! $groups->group_name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="datefrom" id="datefrom" class="form-control m-b-5" placeholder="Date From" value="">
                                        <input type="text" name="dateto" id="dateto" class="form-control" placeholder="Date To" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Status" class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="status"  id="status">
                                            <option value="" >Select Status</option>				                                @foreach ($changegrouprequestsdata['changegrouprequeststatuses'] as $changegrouprequeststatuses)
				                                <option value="{!! $changegrouprequeststatuses->id !!}">
					
				                                {!! $changegrouprequeststatuses->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Comments" class="col-sm-3 control-label">Comments</label>
                                    <div class="col-sm-6">
                                        <Textarea name="comments" id="comments"  class="form-control" row="5" placeholder="Comments" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Change Group Requests
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
$("#datefrom").datepicker({todayHighlight:!0,autoclose:!0});
$("#dateto").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection