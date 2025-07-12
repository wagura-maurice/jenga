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
                        <form id="form" class="form-horizontal">
                            <div class="form-group">
                                <label for="Standing Order Category" class="col-sm-3 control-label">Standing Order
                                    Category:</label>
                                <div class="col-sm-6">
                                    @foreach ($data['categories'] as $category)
                                        @if($category->id == $data['order']->category_id)
                                        <label for="Client" class="col-sm-3 control-label">{{ strtoupper($category->name) }}</label>
                                        @endif
                                    @endforeach
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Client" class="col-sm-3 control-label">Client:</label>
                                <div class="col-sm-6">
                                    <label for="Client"
                                        class="col-sm-3 control-label">{{ $data['client']->client_number . ' - ' . $data['client']->first_name . ' ' . $data['client']->last_name }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Source Account" class="col-sm-3 control-label">LGF Account Balance:</label>
                                <div class="col-sm-6">
                                    <label for="Source Account" class="col-sm-3 control-label">KSH
                                        {{ isset($data['balance']) ? $data['balance']->balance : 0 }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Client" class="col-sm-3 control-label">Loan Account:</label>
                                <div class="col-sm-6">
                                    @foreach ($data['loans'] as $loan)
                                        @if($loan->id == $data['order']->destination_account)
                                            <label for="Source Account" class="col-sm-3 control-label">{!! $loan->loan_number . ' - ' . $loan->amount !!}</label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Frequency" class="col-sm-3 control-label">Frequency:</label>
                                <div class="col-sm-6">
                                    <label for="Source Account" class="col-sm-3 control-label">{{ $data['order']->frequency }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Date Of Birth" class="col-sm-3 control-label">Start Date:</label>
                                <div class="col-sm-6">
                                    <label for="Date Of Birth" class="col-sm-3 control-label">{{ $data['order']->start_date }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Date Of Birth" class="col-sm-3 control-label">End Date:</label>
                                <div class="col-sm-6">
                                    <label for="Date Of Birth" class="col-sm-3 control-label">{{ $data['order']->end_date }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="col-sm-3 control-label">Amount:</label>
                                <div class="col-sm-6">
                                    <label for="Date Of Birth" class="col-sm-3 control-label">KSH{{ number_format((int) $data['order']->amount, 2) }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reason" class="col-sm-3 control-label">Comment:</label>
                                <div class="col-sm-6">
                                    <label for="reason" class="col-sm-3 control-label">{{ $data['order']->reason }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="escalated by" class="col-sm-3 control-label">escalated by:</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">
                                        @foreach ($data['users'] as $user)
                                            @if ($data['order']->escalated_by == $user->id)
                                                {{ ucwords($user->name) }}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Officer" class="col-sm-3 control-label">Status:</label>
                                <div class="col-sm-6">
                                    <label for="Source Account" class="col-sm-3 control-label">{{ $data['order']->_status }}</label>s
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
:@endsection
