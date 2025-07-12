@extends('admin.home')
@section('main_content')
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
                <a href="{!! route('standing.order.index') !!}"><button type="button"
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
                        <form id="form" class="form-horizontal" action="{{ route('standing.order.store') }}"
                            method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="Standing Order Category" class="col-sm-3 control-label">Standing Order
                                    Category</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="category_id" id="category_id" required>
                                        <option value="" selected disabled>Select Standing Order Category</option>
                                        @foreach ($data['categories'] as $category)
                                            <option value="{!! $category->id !!}">
                                                {!! strtoupper($category->name) !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Client" class="col-sm-3 control-label">Client</label>
                                <div class="col-sm-6">
                                    <label for="Client"
                                        class="col-sm-3 control-label">{{ $data['client']->client_number . ' - ' . $data['client']->first_name . ' ' . $data['client']->last_name }}</label>
                                    <input type="hidden" name="client_id" id="client_id" class="form-control"
                                        value="{{ $data['client']->id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Source Account" class="col-sm-3 control-label">LGF Account Balance</label>
                                <div class="col-sm-6">
                                    <label for="Source Account" class="col-sm-3 control-label">KSH
                                        {{ isset($data['balance']) ? $data['balance']->balance : 0 }}</label>
                                    <input type="hidden" name="source_account" id="source_account" class="form-control"
                                        value="{{ isset($data['balance']) ? $data['balance']->id : null }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Client" class="col-sm-3 control-label">Loan Account</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="destination_account" id="destination_account" required>
                                        <option value="" selected disabled>Select Destination Account</option>
                                        @foreach ($data['loans'] as $loan)
                                            @if (isset($data['balance']) && $data['balance']->balance >= getLoanBalance(['id' => $loan->id]) && getLoanBalance(['id' => $loan->id]) > 0)
                                                <option value="{!! $loan->id !!}">
                                                    {!! $loan->loan_number . ' - ' . number_format(getLoanBalance(['id' => $loan->id]), 2) !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Frequency" class="col-sm-3 control-label">Frequency</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="frequency" id="frequency" required>
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="quarterly">Quarterly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Date Of Birth" class="col-sm-3 control-label">Start Date</label>
                                <div class="col-sm-6">
                                    <input type="text" name="start_date" id="start_date" class="form-control"
                                        placeholder="Start Date" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Date Of Birth" class="col-sm-3 control-label">End Date</label>
                                <div class="col-sm-6">
                                    <input type="text" name="end_date" id="end_date" class="form-control"
                                        placeholder="End Date" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="col-sm-3 control-label">Amount</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="amount" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reason" class="col-sm-3 control-label">Comment</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="reason" id="reason" rows="5" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="escalated by" class="col-sm-3 control-label">escalated by</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="escalated_by" id="escalated_by" required>
                                        <option value="" selected disabled>Select escalated by</option>
                                        @foreach ($data['users'] as $user)
                                            <option value="{!! $user->id !!}">
                                                {!! $user->name !!}
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
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-btn fa-plus"></i> Add Standing Order
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
        $("#start_date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });

        $("#end_date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
    </script>
@endsection
