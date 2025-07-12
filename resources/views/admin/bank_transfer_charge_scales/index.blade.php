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
        <li><a href="#">Bank Transfer Charge Scales</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Bank Transfer Charge Scales - DATA <small>bank transfer charge scales data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($banktransferchargescalesdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('banktransferchargescales.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($banktransferchargescalesdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/banktransferchargescalesreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($banktransferchargescalesdata['usersaccountsroles'][0]->_report==1 || $banktransferchargescalesdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($banktransferchargescalesdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Bank Transfer Charge</th>
                                        <th>Minimum Amount</th>
                                        <th>Maximum Amount</th>
                                        <th>Charge Type</th>
                                        <th>Charge</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($banktransferchargescalesdata['list'] as $banktransferchargescales)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $banktransferchargescales->banktransferchargemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $banktransferchargescales->minimum_amount !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $banktransferchargescales->maximum_amount !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $banktransferchargescales->chargetypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $banktransferchargescales->charge !!}
                                </div></td>
                                <td>
                <form action="{!! route('banktransferchargescales.destroy',$banktransferchargescales->id) !!}" method="POST">
                                        @if($banktransferchargescalesdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('banktransferchargescales.show',$banktransferchargescales->id) !!}" id='show-banktransferchargescales-{!! $banktransferchargescales->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($banktransferchargescalesdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('banktransferchargescales.edit',$banktransferchargescales->id) !!}" id='edit-banktransferchargescales-{!! $banktransferchargescales->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($banktransferchargescalesdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-banktransferchargescales-{!! $banktransferchargescales->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Bank Transfer Charge Scales - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/banktransferchargescalesfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Bank Transfer Charge" class="col-sm-3 control-label">Bank Transfer Charge</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="bank_transfer_charge"  id="bank_transfer_charge">
                                            <option value="" >Select Bank Transfer Charge</option>				                                @foreach ($banktransferchargescalesdata['banktransfercharges'] as $banktransfercharges)
				                                <option value="{!! $banktransfercharges->id !!}">
					
				                                {!! $banktransfercharges->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Minimum Amount" class="col-sm-3 control-label">Minimum Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="minimum_amount"  id="minimum_amount" class="form-control" placeholder="Minimum Amount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Maximum Amount" class="col-sm-3 control-label">Maximum Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="maximum_amount"  id="maximum_amount" class="form-control" placeholder="Maximum Amount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Charge Type" class="col-sm-3 control-label">Charge Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="charge_type"  id="charge_type">
                                            <option value="" >Select Charge Type</option>				                                @foreach ($banktransferchargescalesdata['feetypes'] as $feetypes)
				                                <option value="{!! $feetypes->id !!}">
					
				                                {!! $feetypes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Charge" class="col-sm-3 control-label">Charge</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="charge"  id="charge" class="form-control" placeholder="Charge" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Bank Transfer Charge Scales
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