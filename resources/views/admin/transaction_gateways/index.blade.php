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
        <li><a href="#">Transaction Gateways</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Transaction Gateways - DATA <small>transaction gateways data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($transactiongatewaysdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('transactiongateways.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($transactiongatewaysdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/transactiongatewaysreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($transactiongatewaysdata['usersaccountsroles'][0]->_report==1 || $transactiongatewaysdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($transactiongatewaysdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Name</th>
                                        <th>Short Code</th>
                                        <th>Pass Key</th>
                                        <th>Call Back Url</th>
                                        <th>Queue Time Out Url</th>
                                        <th>Result Url</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($transactiongatewaysdata['list'] as $transactiongateways)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $transactiongateways->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $transactiongateways->short_code !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $transactiongateways->pass_key !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $transactiongateways->call_back_url !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $transactiongateways->queue_time_out_url !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $transactiongateways->result_url !!}
                                </div></td>
                                <td>
                <form action="{!! route('transactiongateways.destroy',$transactiongateways->id) !!}" method="POST">
                                        @if($transactiongatewaysdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('transactiongateways.show',$transactiongateways->id) !!}" id='show-transactiongateways-{!! $transactiongateways->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($transactiongatewaysdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('transactiongateways.edit',$transactiongateways->id) !!}" id='edit-transactiongateways-{!! $transactiongateways->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($transactiongatewaysdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-transactiongateways-{!! $transactiongateways->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Transaction Gateways - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/transactiongatewaysfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name"  id="name" class="form-control" placeholder="Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Short Code" class="col-sm-3 control-label">Short Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="short_code"  id="short_code" class="form-control" placeholder="Short Code" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Pass Key" class="col-sm-3 control-label">Pass Key</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="pass_key"  id="pass_key" class="form-control" placeholder="Pass Key" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Call Back Url" class="col-sm-3 control-label">Call Back Url</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="call_back_url"  id="call_back_url" class="form-control" placeholder="Call Back Url" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Queue Time Out Url" class="col-sm-3 control-label">Queue Time Out Url</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="queue_time_out_url"  id="queue_time_out_url" class="form-control" placeholder="Queue Time Out Url" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Result Url" class="col-sm-3 control-label">Result Url</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="result_url"  id="result_url" class="form-control" placeholder="Result Url" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Transaction Gateways
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