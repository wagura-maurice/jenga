@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Change Group Requests</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Change Group Requests Update Form <small>change group requests details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('changegrouprequests.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('changegrouprequests.update',$changegrouprequestsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="client" id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($changegrouprequestsdata['clients'] as $clients)
				                                @if( $clients->id  ==  $changegrouprequestsdata['data']->client  ){
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
                                    <label for="Current Group" class="col-sm-3 control-label">Current Group</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="current_group" id="current_group">
                                            <option value="" >Select Current Group</option>				                                @foreach ($changegrouprequestsdata['groups'] as $groups)
				                                @if( $groups->id  ==  $changegrouprequestsdata['data']->current_group  ){
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
                                    <label for="New Group" class="col-sm-3 control-label">New Group</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="new_group" id="new_group">
                                            <option value="" >Select New Group</option>				                                @foreach ($changegrouprequestsdata['groups'] as $groups)
				                                @if( $groups->id  ==  $changegrouprequestsdata['data']->new_group  ){
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
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="date" id="date" class="form-control" placeholder="Date" value="{!! $changegrouprequestsdata['data']->date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Status" class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="status" id="status">
                                            <option value="" >Select Status</option>				                                @foreach ($changegrouprequestsdata['changegrouprequeststatuses'] as $changegrouprequeststatuses)
				                                @if( $changegrouprequeststatuses->id  ==  $changegrouprequestsdata['data']->status  ){
				                                <option selected value="{!! $changegrouprequeststatuses->id !!}" >
								
				                                {!! $changegrouprequeststatuses->name!!}
				                                </option>@else
				                                <option value="{!! $changegrouprequeststatuses->id !!}" >
								
				                                {!! $changegrouprequeststatuses->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Comments" class="col-sm-3 control-label">Comments</label>
                                    <div class="col-sm-6">
                                        <Textarea name="comments" id="comments" class="form-control" row="20" placeholder="Comments" value="{!! $changegrouprequestsdata['data']->comments !!}">{!! $changegrouprequestsdata['data']->comments !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Change Group Requests
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
<script language="javascript" type="text/javascript">
$("#date").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection