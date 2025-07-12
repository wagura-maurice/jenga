@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Loan Guarantors</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Loan Guarantors - DATA <small>loan guarantors data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($loanguarantorsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('loanguarantors.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($loanguarantorsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/loanguarantorsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($loanguarantorsdata['usersaccountsroles'][0]->_report==1 || $loanguarantorsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
    @if($loanguarantorsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Loan</th>
                                        <th>Guarantor</th>
                                        <th>Relationship With Guarantor</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanguarantorsdata['list'] as $loanguarantors)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $loanguarantors->loanmodel->loan_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loanguarantors->guarantormodel->id_number !!}
                                	{!! $loanguarantors->guarantormodel->first_name !!}
                                	{!! $loanguarantors->guarantormodel->middle_name !!}
                                	{!! $loanguarantors->guarantormodel->last_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loanguarantors->relationshipwithguarantormodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('loanguarantors.destroy',$loanguarantors->id) !!}" method="POST">
                                        @if($loanguarantorsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('loanguarantors.show',$loanguarantors->id) !!}" id='show-loanguarantors-{!! $loanguarantors->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($loanguarantorsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('loanguarantors.edit',$loanguarantors->id) !!}" id='edit-loanguarantors-{!! $loanguarantors->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($loanguarantorsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-loanguarantors-{!! $loanguarantors->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Loan Guarantors - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/loanguarantorsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="loan"  id="loan">
                                            <option value="" >Select Loan</option>				                                @foreach ($loanguarantorsdata['loans'] as $loans)
				                                <option value="{!! $loans->id !!}">
					
				                                {!! $loans->loan_number!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Guarantor" class="col-sm-3 control-label">Guarantor</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="guarantor"  id="guarantor">
                                            <option value="" >Select Guarantor</option>				                                @foreach ($loanguarantorsdata['guarantors'] as $guarantors)
				                                <option value="{!! $guarantors->id !!}">
					
				                                {!! $guarantors->id_number!!}
				                                {!! $guarantors->first_name!!}
				                                {!! $guarantors->middle_name!!}
				                                {!! $guarantors->last_name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Relationship With Guarantor" class="col-sm-3 control-label">Relationship With Guarantor</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="relationship_with_guarantor"  id="relationship_with_guarantor">
                                            <option value="" >Select Relationship With Guarantor</option>				                                @foreach ($loanguarantorsdata['guarantorrelationships'] as $guarantorrelationships)
				                                <option value="{!! $guarantorrelationships->id !!}">
					
				                                {!! $guarantorrelationships->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Loan Guarantors
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