@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Clients</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Clients Form <small>clients details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('client.enquiry.catalog.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form class="form-horizontal" action="{{ route('client.enquiry.catalog.store') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="Category" class="col-sm-3 control-label">Category</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="category_id" required>
                                    <option value="" selected disabled>Select category</option>
                                    @foreach ($data['categories'] as $category)
                                        <option value="{!! $category->id !!}">
                                            {!! $category->name !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Client" class="col-sm-3 control-label">Client</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="client_id" required>
                                    <option value="" selected disabled>Select client</option>
                                    @foreach ($data['clients'] as $client)
                                        <option value="{!! $client->id !!}">
                                            {!! strtoupper($client->client_number . ' - ' . $client->first_name . ' ' . $client->last_name) !!}
                                        </option>
                                    @endforeach
                                </select>
                                <small>only use if caller is a system client.</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer name" class="col-sm-3 control-label">Customer Name</label>
                            <div class="col-sm-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control" name="customer_name"/>
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer email" class="col-sm-3 control-label">Customer Email</label>
                            <div class="col-sm-6">
                                <div class="input-group date">
                                    <input type="email" class="form-control" name="customer_email"/>
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer phone number" class="col-sm-3 control-label">Customer Phone Number</label>
                            <div class="col-sm-6">
                                <div class="input-group date">
                                    <input type="tel" class="form-control" name="customer_phone_number"/>
                                    <span class="input-group-addon">
                                        <i class="fa fa-mobile" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject matter" class="col-sm-3 control-label">Subject Matter</label>
                            <div class="col-sm-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control" name="topic" required>
                                    <span class="input-group-addon">
                                        <i class="fa fa-filter" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-sm-3 control-label">Comment</label>
                            <div class="col-sm-6">
                                    <textarea class="form-control" name="content" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Officer" class="col-sm-3 control-label">Subject Type</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="topic_type" id="topic_type" required>
                                    <option value="" selected disabled>Select subject matter type</option>
                                    <option value="enquiry">Enquiry</option>
                                    <option value="complaint">Complaint</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="occurrence date" class="col-sm-3 control-label">Occurrence Date</label>
                            <div class="col-sm-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control" name="occurrence_date" id="occurrence_date"/>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-sm-3 control-label">Initialised By</label>
                            <div class="col-sm-6">
                                @foreach ($data['users'] as $user)
                                    @if($data['user']->id == $user->id)
                                        <label for="content" class="col-sm-3 control-label">{{ ucwords($user->name) }}</label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="escalated to" class="col-sm-3 control-label">Escalated To</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="escalated_to" required>
                                    <option value="" selected disabled>Select escalated to</option>
                                    @foreach ($data['users'] as $user)
                                        <option value="{!! $user->id !!}" @if($user->id == $data['user']->id) selected @endif>
                                            {!! ucwords($user->name) !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="branch" class="col-sm-3 control-label">Branch</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="branch"
                                    id="branch" required>
                                    <option value="" selected disabled>Select branch</option>
                                    @foreach ($data['branches'] as $branch)
                                        <option value="{!! $branch->id !!}">
                                            {!! ucwords($branch->name) !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Officer" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="_status" id="_status" required>
                                    <option value="" selected disabled>Select status</option>
                                    <option value="open">Open</option>
                                    <option value="advised">Advised</option>
                                    <option value="solved">Solved</option>
                                    <option value="declined">Declined</option>
                                    <option value="pending">Pending</option>
                                    <option value="repeat">Repeat</option>
                                    <option value="re-solved">Re-solved</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fa fa-btn fa-plus"></i> Submit
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
    $("#occurrence_date").datepicker({
        todayHighlight: !0,
        autoclose: !0
    });
</script>
@endsection