@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Group Client Roles</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Group Client Roles - DATA <small>group client roles data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($groupclientrolesdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('groupclientroles.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($groupclientrolesdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/groupclientrolesreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($groupclientrolesdata['usersaccountsroles'][0]->_report==1 || $groupclientrolesdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
    @if($groupclientrolesdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Client_group</th>
                                        <th>Group_role</th>
                                        <th>Client</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($groupclientrolesdata['list'] as $groupclientroles)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $groupclientroles->client_groupmodel->group_number !!}
                                	{!! $groupclientroles->client_groupmodel->group_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $groupclientroles->group_rolemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $groupclientroles->clientmodel->client_number !!}
                                	{!! $groupclientroles->clientmodel->first_name !!}
                                	{!! $groupclientroles->clientmodel->middle_name !!}
                                	{!! $groupclientroles->clientmodel->last_name !!}
                                </div></td>
                                <td>
                <form action="{!! route('groupclientroles.destroy',$groupclientroles->id) !!}" method="POST">
                                        @if($groupclientrolesdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('groupclientroles.show',$groupclientroles->id) !!}" id='show-groupclientroles-{!! $groupclientroles->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($groupclientrolesdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('groupclientroles.edit',$groupclientroles->id) !!}" id='edit-groupclientroles-{!! $groupclientroles->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($groupclientrolesdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-groupclientroles-{!! $groupclientroles->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Group Client Roles - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/groupclientrolesfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Client_group" class="col-sm-3 control-label">Client_group</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="client_group"  id="client_group">
                                            <option value="" >Select Client_group</option>				                                @foreach ($groupclientrolesdata['groups'] as $groups)
				                                <option value="{!! $groups->id !!}">
					
				                                {!! $groups->group_number!!}
				                                {!! $groups->group_name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Group_role" class="col-sm-3 control-label">Group_role</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="group_role"  id="group_role">
                                            <option value="" >Select Group_role</option>				                                @foreach ($groupclientrolesdata['grouproles'] as $grouproles)
				                                <option value="{!! $grouproles->id !!}">
					
				                                {!! $grouproles->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="client"  id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($groupclientrolesdata['clients'] as $clients)
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
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Group Client Roles
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
@endsection