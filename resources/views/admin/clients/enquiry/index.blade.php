@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">Public</a></li>
            <li><a href="#">Enquiry</a></li>
            <li class="active">Table</li>
        </ol>
        <h1 class="page-header">Customer Enquiry - DATA <small>clients data goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! route('client.enquiry.catalog.create') !!}">
                    <button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                            class="fa fa-plus"></i></button>
                </a>
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
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th># Number</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Topic</th>
                                    <th>Content</th>
                                    <th>Occurrence</th>
                                    <th>Initiated By</th>
                                    <th>Escalated To</th>
                                    <th>Branch</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['lists'] as $list)
                                    <tr>
                                        <td class='table-text'>
                                            <div class="label label-info">
                                                # {!! $list->_pid !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! isset($list->category) ? ucwords($list->category->name) : null !!}
                                            </div>
                                            <div class="label label-info">
                                                # {!! isset($list->topic_type) ? strtoupper($list->topic_type) : null !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! isset($list->client_id) ? ucwords($list->client->first_name . ' ' . $list->client->last_name) : null !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                <a href="tel:{!! strtoupper($list->customer_phone_number) !!}">{!! strtoupper($list->customer_phone_number) !!}</a>
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! strtoupper($list->topic) !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $list->content !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! \Carbon\Carbon::parse($list->occurrence_date)->diffForHumans() !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! isset($list->by) ? ucwords($list->by->name) : null !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! isset($list->to) ? ucwords($list->to->name) : null !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! strtoupper($list->location->name) !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div class="label label-info">
                                                {!! strtoupper($list->_status) !!}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{!! route('client.enquiry.catalog.show', $list->id) !!}"
                                                id='show-client-enquiry-{!! $list->id !!}'
                                                class='btn btn-sm btn-circle btn-info' data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="{!! ucwords(__('Show')) !!}">
                                                <i class='fa fa-btn fa-eye'></i>
                                            </a>
                                            <a href="{!! route('client.enquiry.catalog.edit', $list->id) !!}"
                                                id='edit-client-enquiry-{!! $list->id !!}'
                                                class='btn btn-sm btn-circle btn-inverse' data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="{!! ucwords(__('Edit')) !!}">
                                                <i class='fa fa-btn fa-edit'></i>
                                            </a>
                                            <a href="{!! route('client.enquiry.catalog.destroy', $list->id) !!}" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="{!! ucwords(__('Exit')) !!}"
                                                onclick="if (confirm('{!! __('Are you sure? This can not be undone!!') !!}')) { event.preventDefault(); document.getElementById('destroy-client-enquiry-{!! $list->id !!}').submit(); } else { return false }"
                                                class='btn btn-sm btn-circle btn-danger'><i
                                                    class="fa fa-btn fa-trash"></i></a>
                                            <form id="destroy-client-enquiry-{!! $list->id !!}"
                                                action="{!! route('client.enquiry.catalog.destroy', $list->id) !!}" method="POST" style="display: none;">
                                                {!! csrf_field() !!}
                                                {!! method_field('DELETE') !!}
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="col-md-12">
                                        <div class="alert alert-light-primary">
                                            {!! __('no client enquiries found...') !!}
                                        </div>
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script language="javascript" type="text/javascript">
        // 
    </script>
@endsection
