@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Clients</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Clients Profile <small>account details goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! route('client.enquiry.catalog.index') !!}"><button type="button"
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
                        <form id="form" class="form-horizontal" enctype="multipart/form-data"
                            action="{{ route('client.enquiry.catalog.store') }}" method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="Enquiry Category" class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">
                                        @foreach ($data['categories'] as $category)
                                            @if ($data['enquiry']->category_id == $category->id)
                                                {{ ucwords($category->name) }}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Client" class="col-sm-3 control-label">Client</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">
                                        @foreach ($data['clients'] as $client)
                                            @if ($data['enquiry']->client_id == $client->id)
                                                {{ ucwords($client->client_number) }} -
                                                {{ ucwords($client->first_name . ' ' . $client->last_name) }}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer name" class="col-sm-3 control-label">Customer Name</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">{!! $data['enquiry']->customer_name !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer email" class="col-sm-3 control-label">Customer Email</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">{!! $data['enquiry']->customer_email !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer phone number" class="col-sm-3 control-label">Customer Phone
                                    Number</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">{!! $data['enquiry']->customer_phone_number !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject matter" class="col-sm-3 control-label">Subject Matter</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">{!! $data['enquiry']->topic !!}</label>
                                </div>
                            </div>
                            <div class="form-group">

                                <label for="content" class="col-sm-3 control-label">Content</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">{!! $data['enquiry']->content !!}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="escalated by" class="col-sm-3 control-label">escalated by</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">
                                        @foreach ($data['users'] as $user)
                                            @if ($data['enquiry']->escalated_by == $user->id)
                                                {{ ucwords($user->name) }}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="escalated to" class="col-sm-3 control-label">escalated to</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">
                                        @foreach ($data['users'] as $user)
                                            @if ($data['enquiry']->escalated_to == $user->id)
                                                {{ ucwords($user->name) }}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="branch" class="col-sm-3 control-label">branch</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">
                                        @foreach ($data['branches'] as $branch)
                                            @if ($data['enquiry']->branch == $branch->id)
                                                {{ ucwords($branch->name) }}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Officer" class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-6">
                                    <label class="col-sm-6 control-label text-left">{!! $data['enquiry']->_status !!}</label>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Add Enquiry
                                        </button>
                                    </div>
                                </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
