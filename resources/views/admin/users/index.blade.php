@extends('admin.home')
@section('main_content')

    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">Public</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Table</li>
        </ol>
        <h1 class="page-header">Users - DATA <small>users data goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <!-- @if ($usersdata['usersaccountsroles'][0]->_add == 1)
                    <a href="{!! route('users.create') !!}"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
                @endif -->
                @if ($usersdata['usersaccountsroles'][0]->_report == 1)
                    <a href="{!! url('usersreport') !!}"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                                class="fa fa-file-text-o"></i></button></a>
                @endif
                @if ($usersdata['usersaccountsroles'][0]->_report == 1 || $usersdata['usersaccountsroles'][0]->_list == 1)
                    <a href="#modal-dialog" data-toggle="modal"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
                @endif
            </div>
        </div>
        @if ($usersdata['usersaccountsroles'][0]->_list == 1)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                                    data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-success"
                                    data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning"
                                    data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                    data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">DataTable - Autofill</h4>
                        </div>

                        <div class="panel-body">

                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Account</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersdata['list'] as $users)
                                        <tr>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $users->name !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $users->email !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $users->useraccountmodel->name !!}
                                                </div>
                                            </td>
                                            <td>
                                                <form action="{!! route('users.destroy', $users->id) !!}" method="POST">
                                                    @if ($usersdata['usersaccountsroles'][0]->_show == 1)
                                                        <a href="{!! route('users.show', $users->id) !!}"
                                                            id='show-users-{!! $users->id !!}'
                                                            class='btn btn-sm btn-circle btn-inverse'>
                                                            <i class='fa fa-btn fa-eye'></i>
                                                        </a>
                                                    @endif
                                                    <!-- @if ($usersdata['usersaccountsroles'][0]->_edit == 1)
                                                        <a href="{!! route('users.edit', $users->id) !!}"
                                                            id='edit-users-{!! $users->id !!}'
                                                            class='btn btn-sm btn-circle btn-warning'>
                                                            <i class='fa fa-btn fa-edit'></i>
                                                        </a>
                                                    @endif
                                                    @if ($usersdata['usersaccountsroles'][0]->_delete == 1)
                                                        <input type="hidden" name="_method" value="delete" />
                                                        {!! csrf_field() !!}
                                                        {!! method_field('DELETE') !!}
                                                        <button type='submit' id='delete-users-{!! $users->id !!}'
                                                            class='btn btn-sm btn-circle btn-danger'>
                                                            <i class='fa fa-btn fa-trash'></i>
                                                        </button>
                                                    @endif -->
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
        @endif
    </div>
    <div class="modal fade modal-message" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                    <h4 class="modal-title">Users - Filter Dialog</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-inverse">
                                <div class="panel-heading">
                                    <div class="panel-heading-btn">
                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success"
                                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning"
                                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                                    </div>
                                    <h4 class="panel-title">DataForm - Autofill</h4>
                                </div>
                                <div class="panel-body">
                                    <form id="form" class="form-horizontal" action="{!! url('usersfilter') !!}"
                                        method="POST">
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label for="Name" class="col-sm-3 control-label">Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="Name" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Email" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="email" id="email" class="form-control"
                                                    placeholder="Email" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="User Account" class="col-sm-3 control-label">User Account</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="user_account" id="user_account">
                                                    <option value="">Select User Account</option>
                                                    @foreach ($usersdata['usersaccounts'] as $usersaccounts)
                                                        <option value="{!! $usersaccounts->id !!}">

                                                            {!! $usersaccounts->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Password" class="col-sm-3 control-label">Password</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="password" id="password"
                                                    class="form-control" placeholder="Password" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Remember_token"
                                                class="col-sm-3 control-label">Remember_token</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="remember_token" id="remember_token"
                                                    class="form-control" placeholder="Remember_token" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Created At" class="col-sm-3 control-label">Created At</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="created_at" id="created_at"
                                                    class="form-control" placeholder="Created At" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Updated At" class="col-sm-3 control-label">Updated At</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="updated_at" id="updated_at"
                                                    class="form-control" placeholder="Updated At" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <div class="col-sm-offset-3 col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-inverse">
                                                        <i class="fa fa-btn fa-search"></i> Search Users
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
