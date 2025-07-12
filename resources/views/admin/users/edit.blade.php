@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Users Update Form <small>users details goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! route('users.index') !!}"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
            </div>
        </div>
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
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                                    class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">DataForm - Autofill</h4>
                    </div>
                    <div class="panel-body">
                        <form action="{!! route('users.update', $usersdata['data']->id) !!}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_method" value="put" />
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="Name" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" value="{!! $usersdata['data']->name !!}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Email" value="{!! $usersdata['data']->email !!}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="User Account" class="col-sm-3 control-label">User Account</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="user_account" id="user_account">
                                        <option value="">Select User Account</option>
                                        @foreach ($usersdata['usersaccounts'] as $usersaccounts)
                                            @if ($usersaccounts->id == $usersdata['data']->user_account)
                                                <option selected value="{!! $usersaccounts->id !!}">

                                                    {!! $usersaccounts->name !!}
                                                </option>
                                            @else
                                                <option value="{!! $usersaccounts->id !!}">

                                                    {!! $usersaccounts->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="User Branch" class="col-sm-3 control-label">User Branch</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="branch" id="branch">
                                        <option value="">Select User Branch</option>
                                        @foreach ($usersdata['branches'] as $branch)
                                            <option value="{!! $branch->id !!}" {{ $branch->id == $usersdata['data']->branch_id ? 'selected' : NULL }}>
                                                {!! $branch->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Password" class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-6">
                                    <input type="text" name="password" id="password" class="form-control"
                                        placeholder="Password" required="">
                                </div>
                            </div>
                            <!--                                 <div class="form-group">
                                        <label for="Remember_token" class="col-sm-3 control-label">Remember_token</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="remember_token" id="remember_token" class="form-control" placeholder="Remember_token" value="{!! $usersdata['data']->remember_token !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Created At" class="col-sm-3 control-label">Created At</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="created_at" id="created_at" class="form-control" placeholder="Created At" value="{!! $usersdata['data']->created_at !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Updated At" class="col-sm-3 control-label">Updated At</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="updated_at" id="updated_at" class="form-control" placeholder="Updated At" value="{!! $usersdata['data']->updated_at !!}">
                                        </div>
                                    </div>
     -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Users
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
