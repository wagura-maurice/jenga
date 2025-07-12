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
        <li><a href="#">Defaulter Meters</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Defaulter Meters - DATA <small>defaulter meters data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($defaultermetersdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('defaultermeters.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($defaultermetersdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/defaultermetersreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($defaultermetersdata['usersaccountsroles'][0]->_report==1 || $defaultermetersdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($defaultermetersdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Number Of Days</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($defaultermetersdata['list'] as $defaultermeters)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $defaultermeters->code !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $defaultermeters->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $defaultermeters->number_of_days !!}
                                </div></td>
                                <td>
                <form action="{!! route('defaultermeters.destroy',$defaultermeters->id) !!}" method="POST">
                                        @if($defaultermetersdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('defaultermeters.show',$defaultermeters->id) !!}" id='show-defaultermeters-{!! $defaultermeters->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($defaultermetersdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('defaultermeters.edit',$defaultermeters->id) !!}" id='edit-defaultermeters-{!! $defaultermeters->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($defaultermetersdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-defaultermeters-{!! $defaultermeters->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Defaulter Meters - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/defaultermetersfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Code" class="col-sm-3 control-label">Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="code"  id="code" class="form-control" placeholder="Code" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name"  id="name" class="form-control" placeholder="Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Number Of Days" class="col-sm-3 control-label">Number Of Days</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="number_of_days"  id="number_of_days" class="form-control" placeholder="Number Of Days" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Defaulter Meters
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