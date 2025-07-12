@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Users Accounts Roles</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Users Accounts Roles - DATA <small>users accounts roles data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('usersaccountsroles.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            <a href="{!! url('usersaccountsrolesreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
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
                                        <th>User Account</th>
                                        <th>Module</th>
                                        <th>_add</th>
                                        <th>_list</th>
                                        <th>_edit</th>
                                        <th>_delete</th>
                                        <th>_show</th>
                                        <th>_report</th>
                                        <th>Action</th>
                                                                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($usersaccountsrolesdata['list'] as $usersaccountsroles)
                            <tr>
                                <form action="{!! route('usersaccountsroles.update',$usersaccountsroles->id) !!}" method="POST" class="form-horizontal">
                                    <input type="hidden" name="_method" value="put" />
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="user_account" value="{{$usersaccountsroles->user_account}}">
                                    <input type="hidden" name="module" value="{{$usersaccountsroles->module}}">

                                <td class='table-text'><div>
                                    {!! $usersaccountsroles->useraccountmodel->name !!}

                                </div></td>
                                <td class='table-text'><div>
                                    {!! $usersaccountsroles->modulemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    @if($usersaccountsroles->_add=='1') 
                                        <input type="checkbox" name="_add" value="1" checked /> 
                                    @else 
                                        <input type="checkbox" name="_add" value="1" /> 
                                    @endif
                                </div></td>
                                <td class='table-text'><div>
                                    @if($usersaccountsroles->_list=='1') 
                                    <input type="checkbox" name="_list" value="1"  checked /> 
                                    @else
                                    <input type="checkbox" name="_list" value="1" /> 
                                    @endif
                                </div></td>
                                <td class='table-text'><div>
                                    @if($usersaccountsroles->_edit=='1')
                                    <input type="checkbox" name="_edit" value="1" checked/> 
                                    @else
                                    <input type="checkbox" name="_edit" value="1" /> 
                                    @endif
                                </div></td>
                                <td class='table-text'><div>
                                    @if($usersaccountsroles->_delete=='1')
                                    <input type="checkbox" name="_delete" value="1" checked/>
                                    @else
                                    <input type="checkbox" name="_delete" value="1" />
                                    @endif
                                </div></td>
                                <td class='table-text'><div>
                                    @if($usersaccountsroles->_show=='1')
                                    <input type="checkbox" name="_show" value="1" checked/>
                                    @else
                                    <input type="checkbox" name="_show" value="1" />
                                    @endif
                                </div></td>
                                <td class='table-text'><div>
                                    @if($usersaccountsroles->_report=='1')
                                    <input type="checkbox" name="_report" value="1" checked/>
                                    @else
                                    <input type="checkbox" name="_report" value="1"/>
                                    @endif
                                </div></td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-save"></i>
                                        </button>
                                </td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-message" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                <h4 class="modal-title">Users Accounts Roles - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('usersaccountsrolesfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="User Account" class="col-sm-3 control-label">User Account</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="user_account"  id="user_account">
                                            <option value="" >Select User Account</option>                                              @foreach ($usersaccountsrolesdata['usersaccounts'] as $usersaccounts)
                                                <option value="{!! $usersaccounts->id !!}">
                    
                                                {!! $usersaccounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Module" class="col-sm-3 control-label">Module</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="module"  id="module">
                                            <option value="" >Select Module</option>                                                @foreach ($usersaccountsrolesdata['modules'] as $modules)
                                                <option value="{!! $modules->id !!}">
                    
                                                {!! $modules->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_add" class="col-sm-3 control-label">_add</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_add"  id="_add" class="form-control" placeholder="_add" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_list" class="col-sm-3 control-label">_list</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_list"  id="_list" class="form-control" placeholder="_list" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_edit" class="col-sm-3 control-label">_edit</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_edit"  id="_edit" class="form-control" placeholder="_edit" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_delete" class="col-sm-3 control-label">_delete</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_delete"  id="_delete" class="form-control" placeholder="_delete" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_show" class="col-sm-3 control-label">_show</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_show"  id="_show" class="form-control" placeholder="_show" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="_report" class="col-sm-3 control-label">_report</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="_report"  id="_report" class="form-control" placeholder="_report" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Users Accounts Roles
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