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
        <li><a href="#">Suppliers</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Suppliers - DATA <small>suppliers data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($suppliersdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('suppliers.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($suppliersdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/suppliersreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($suppliersdata['usersaccountsroles'][0]->_report==1 || $suppliersdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($suppliersdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Phone Number</th>
                                        <th>Email Address</th>
                                        <th>Postal Code</th>
                                        <th>Postal Address</th>
                                        <th>Street</th>
                                        <th>Town</th>
                                        <th>Contact Person Name</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($suppliersdata['list'] as $suppliers)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $suppliers->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $suppliers->phone_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $suppliers->email_address !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $suppliers->postal_code !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $suppliers->postal_address !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $suppliers->street !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $suppliers->town !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $suppliers->contact_person_name !!}
                                </div></td>
                                <td>
                <form action="{!! route('suppliers.destroy',$suppliers->id) !!}" method="POST">
                                        @if($suppliersdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('suppliers.show',$suppliers->id) !!}" id='show-suppliers-{!! $suppliers->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($suppliersdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('suppliers.edit',$suppliers->id) !!}" id='edit-suppliers-{!! $suppliers->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($suppliersdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-suppliers-{!! $suppliers->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Suppliers - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/suppliersfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name"  id="name" class="form-control" placeholder="Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Phone Number" class="col-sm-3 control-label">Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone_number"  id="masked-input-phone" placeholder="(999) 999-9999"  class="form-control"  value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Email Address" class="col-sm-3 control-label">Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email_address"    class="form-control" placeholder="Email Address" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Code" class="col-sm-3 control-label">Postal Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_code"  id="postal_code" class="form-control" placeholder="Postal Code" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Address" class="col-sm-3 control-label">Postal Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_address"  id="postal_address" class="form-control" placeholder="Postal Address" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Street" class="col-sm-3 control-label">Street</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="street"  id="street" class="form-control" placeholder="Street" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Town" class="col-sm-3 control-label">Town</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="town"  id="town" class="form-control" placeholder="Town" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Contact Person Name" class="col-sm-3 control-label">Contact Person Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="contact_person_name"  id="contact_person_name" class="form-control" placeholder="Contact Person Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Contact Person Phone Number" class="col-sm-3 control-label">Contact Person Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="contact_person_phone_number"  id="contact_person_phone_number" class="form-control" placeholder="Contact Person Phone Number" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Contact Person Email Address" class="col-sm-3 control-label">Contact Person Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="contact_person_email_address"  id="contact_person_email_address" class="form-control" placeholder="Contact Person Email Address" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Suppliers
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