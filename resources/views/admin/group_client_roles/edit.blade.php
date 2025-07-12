@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Group Client Roles</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Group Client Roles Update Form <small>group client roles details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('groupclientroles.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('groupclientroles.update',$groupclientrolesdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Client_group" class="col-sm-3 control-label">Client_group</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="client_group" id="client_group">
                                            <option value="" >Select Client_group</option>				                                @foreach ($groupclientrolesdata['groups'] as $groups)
				                                @if( $groups->id  ==  $groupclientrolesdata['data']->client_group  ){
				                                <option selected value="{!! $groups->id !!}" >
								
				                                {!! $groups->group_number!!}
				                                {!! $groups->group_name!!}
				                                </option>@else
				                                <option value="{!! $groups->id !!}" >
								
				                                {!! $groups->group_number!!}
				                                {!! $groups->group_name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Group_role" class="col-sm-3 control-label">Group_role</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="group_role" id="group_role">
                                            <option value="" >Select Group_role</option>				                                @foreach ($groupclientrolesdata['grouproles'] as $grouproles)
				                                @if( $grouproles->id  ==  $groupclientrolesdata['data']->group_role  ){
				                                <option selected value="{!! $grouproles->id !!}" >
								
				                                {!! $grouproles->name!!}
				                                </option>@else
				                                <option value="{!! $grouproles->id !!}" >
								
				                                {!! $grouproles->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="client" id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($groupclientrolesdata['clients'] as $clients)
				                                @if( $clients->id  ==  $groupclientrolesdata['data']->client  ){
				                                <option selected value="{!! $clients->id !!}" >
								
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>@else
				                                <option value="{!! $clients->id !!}" >
								
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Group Client Roles
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