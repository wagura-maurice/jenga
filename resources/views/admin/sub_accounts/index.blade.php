@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Sub Accounts</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Sub Accounts - DATA <small>sub accounts data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($subaccountsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('subaccounts.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($subaccountsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/subaccountsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($subaccountsdata['usersaccountsroles'][0]->_report==1 || $subaccountsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
    @if($subaccountsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Account</th>
                                        <th>Sub Account</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($subaccountsdata['list'] as $subaccounts)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $subaccounts->accountmodel->code !!}
                                	{!! $subaccounts->accountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $subaccounts->subaccountmodel->code !!}
                                	{!! $subaccounts->subaccountmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('subaccounts.destroy',$subaccounts->id) !!}" method="POST">
                                        @if($subaccountsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('subaccounts.show',$subaccounts->id) !!}" id='show-subaccounts-{!! $subaccounts->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($subaccountsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('subaccounts.edit',$subaccounts->id) !!}" id='edit-subaccounts-{!! $subaccounts->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($subaccountsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-subaccounts-{!! $subaccounts->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Sub Accounts - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/subaccountsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Account" class="col-sm-3 control-label">Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="account"  id="account">
                                            <option value="" >Select Account</option>				                                @foreach ($subaccountsdata['accounts'] as $accounts)
				                                <option value="{!! $accounts->id !!}">
					
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Sub Account" class="col-sm-3 control-label">Sub Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="sub_account"  id="sub_account">
                                            <option value="" >Select Sub Account</option>				                                @foreach ($subaccountsdata['accounts'] as $accounts)
				                                <option value="{!! $accounts->id !!}">
					
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Sub Accounts
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