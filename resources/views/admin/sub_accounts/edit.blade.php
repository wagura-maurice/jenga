@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Sub Accounts</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Sub Accounts Update Form <small>sub accounts details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('subaccounts.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <h4 class="panel-title">DataForm - Autofill</h4>
                </div>
                <div class="panel-body">
                    <form action="{!! route('subaccounts.update',$subaccountsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Account" class="col-sm-3 control-label">Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="account" id="account">
                                            <option value="" >Select Account</option>				                                @foreach ($subaccountsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $subaccountsdata['data']->account  ){
				                                <option selected value="{!! $accounts->id !!}" >
								
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@else
				                                <option value="{!! $accounts->id !!}" >
								
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Sub Account" class="col-sm-3 control-label">Sub Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="sub_account" id="sub_account">
                                            <option value="" >Select Sub Account</option>				                                @foreach ($subaccountsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $subaccountsdata['data']->sub_account  ){
				                                <option selected value="{!! $accounts->id !!}" >
								
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@else
				                                <option value="{!! $accounts->id !!}" >
								
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Sub Accounts
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