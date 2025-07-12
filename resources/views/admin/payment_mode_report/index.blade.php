@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Accounts</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Accounts - DATA <small>accounts data goes here...</small></h1>
    @if($accountsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Financial Category</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($accountsdata['list'] as $accounts)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $accounts->financialcategorymodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $accounts->code !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $accounts->name !!}
                                </div></td>

                                <td>
                
                                        @if($accountsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('paymentmodesreport.show',$accounts->id) !!}" id='show-paymentmodesdata-{!! $accounts->id !!}' class='btn btn-sm btn-circle btn-icon btn-inverse'>
                                        <i class='fa fa-btn fa-arrow-right'></i>
                                    </a>
                                        @endif
                
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
                <h4 class="modal-title">Accounts - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/accountsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Financial Category" class="col-sm-3 control-label">Financial Category</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="financial_category"  id="financial_category">
                                            <option value="" >Select Financial Category</option>                                                @foreach ($accountsdata['financialcategories'] as $financialcategories)
                                                <option value="{!! $financialcategories->id !!}">
                    
                                                {!! $financialcategories->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
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
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Accounts
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