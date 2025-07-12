@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">Public</a></li>
            <li><a href="#">Clients</a></li>
            <li class="active">Table</li>
        </ol>
        <h1 class="page-header">Clients - DATA <small>clients data goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                @if ($clientsdata['usersaccountsroles'][0]->_add == 1)
                    <a href="{!! route('clients.create') !!}">
                        <button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                                class="fa fa-plus"></i></button>
                    </a>
                @endif
                @if ($clientsdata['usersaccountsroles'][0]->_report == 1)
                    <a href="{!! url('admin/clientsreport') !!}">
                        <button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                                class="fa fa-file-text-o"></i></button>
                    </a>
                @endif
                @if ($clientsdata['usersaccountsroles'][0]->_report == 1 || $clientsdata['usersaccountsroles'][0]->_list == 1)
                    <a href="{{ url('/admin/clientssearch/') }}">
                        <button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                                class="fa fa-search"></i></button>
                    </a>
                @endif
                <!-- @if ($clientsdata['usersaccountsroles'][0]->_add == 1)
    <a href="{!! url('/admin/importfromdb') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-download"></i></button></a>
    @endif -->
                <a href="#modal-dialog" data-toggle="modal"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
                @if ($clientsdata['usersaccountsroles'][0]->_list == 1)
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
                        <h4 class="panel-title">Members</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th># NUMBER</th>
                                    <th>FIRST NAME</th>
                                    <th>MIDDLE NAME</th>
                                    <th>LAST NAME</th>
                                    <th>PHONE NUMBER</th>
                                    <th>NATIONAL ID</th>
                                    <th>GENDER</th>
                                    <th>AGE</th>
                                    <th>REGISTERED</th>
                                    <th>TYPE</th>
                                    <th>CATEGORY</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientsdata['list'] as $client)
                                    <tr>
                                        <td class='table-text'>
                                            <div class="label label-info">
                                                # {!! $client->client_number !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $client->first_name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $client->middle_name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $client->last_name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                <a href="tel:{!! $client->primary_phone_number !!}">{!! $client->primary_phone_number !!}</a>
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $client->id_number !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $client->gender ? 'Male' : 'Female' !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $client->date_of_birth
                                                    ? \Carbon\Carbon::parse(date('Y-m-d', strtotime($client->date_of_birth)))->age . ' years'
                                                    : null !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! \Carbon\Carbon::parse($client->created_at)->diffForHumans() !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! isset($client->clienttypemodel) ? $client->clienttypemodel->name : null !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div class="label label-info">
                                                {!! isset($client->clientcategorymodel) ? $client->clientcategorymodel->name : null !!}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($clientsdata['active'][0]['id'] != $client->client_category)
                                                <a href="{!! url('/admin/clientapproval/' . $client->id) !!}"
                                                    id='approve-client-{!! $client->id !!}'
                                                    class='btn btn-sm btn-circle btn-success' data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="{!! ucwords(__('Approve')) !!}">
                                                    <i class='fa fa-btn fa-check'></i>
                                                </a>
                                            @endif
                                            <a href="{!! route('clients.show', $client->id) !!}" id='show-client-{!! $client->id !!}'
                                                class='btn btn-sm btn-circle btn-info' data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="{!! ucwords(__('Show')) !!}">
                                                <i class='fa fa-btn fa-eye'></i>
                                            </a>
                                            <a href="{!! route('clients.edit', $client->id) !!}" id='edit-client-{!! $client->id !!}'
                                                class='btn btn-sm btn-circle btn-inverse' data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="{!! ucwords(__('Edit')) !!}">
                                                <i class='fa fa-btn fa-edit'></i>
                                            </a>
                                            @if (isset($client->clienttypemodel) && $client->clienttypemodel->code !== '002')
                                                <a href="{!! route('client.individualize', $client->id) !!}" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="{!! ucwords(__('Go Individual')) !!}"
                                                    onclick="if (confirm('{!! __('Are you sure? This can not be undone!!') !!}')) { event.preventDefault(); document.getElementById('individualize-client-{!! $client->id !!}').submit(); } else { return false }"
                                                    class='btn btn-sm btn-circle btn-warning'><i
                                                        class="fa fa-btn fa-minus-circle"></i></a>
                                                <form id="individualize-client-{!! $client->id !!}"
                                                    action="{!! route('client.individualize', $client->id) !!}" method="POST"
                                                    style="display: none;">
                                                    {!! csrf_field() !!}
                                                </form>
                                            @endif
                                            <a href="{!! route('clients.destroy', $client->id) !!}" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="{!! ucwords(__('Exit')) !!}"
                                                onclick="if (confirm('{!! __('Are you sure? This can not be undone!!') !!}')) { event.preventDefault(); document.getElementById('destroy-client-{!! $client->id !!}').submit(); } else { return false }"
                                                class='btn btn-sm btn-circle btn-danger'><i
                                                    class="fa fa-btn fa-trash"></i></a>
                                            <form id="destroy-client-{!! $client->id !!}"
                                                action="{!! route('clients.destroy', $client->id) !!}" method="POST" style="display: none;">
                                                {!! csrf_field() !!}
                                                {!! method_field('DELETE') !!}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $clientsdata['list']->links() !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-inverse">
                                                <div class="panel-heading">
                                                    <div class="panel-heading-btn">
                                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                                                class="fa fa-expand"></i></a>
                                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                                                                class="fa fa-repeat"></i></a>
                                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                                                                class="fa fa-minus"></i></a>
                                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                                                                class="fa fa-times"></i></a>
                                                    </div>
                                                    <h4 class="panel-title">DataTable - Autofill</h4>
                                                </div>

                                                <div class="panel-body">
                                                    <table id="grid" class="table table-striped table-bordered">
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
    </div>
    @endif
    <div class="modal fade modal-message" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                    <h4 class="modal-title">Clients - Filter Dialog</h4>
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
                                    <form id="form" class="form-horizontal" action="{!! url('admin/clients') !!}"
                                        method="GET">
                                        <div class="form-group">
                                            <label for="client number" class="col-sm-3 control-label">Client
                                                Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="client_number"
                                                    id="client_number"
                                                    value="{{ isset($clientsdata['client_number']) ? $clientsdata['client_number'] : null }}" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Phone Number" class="col-sm-3 control-label">Phone Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="primary_phone_number"
                                                    id="primary_phone_number"
                                                    value="{{ isset($clientsdata['primary_phone_number']) ? $clientsdata['primary_phone_number'] : null }}" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="National ID Number" class="col-sm-3 control-label">National ID
                                                Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="national_id_number"
                                                    id="national_id_number"
                                                    value="{{ isset($clientsdata['national_id_number']) ? $clientsdata['national_id_number'] : null }}" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <div class="col-sm-offset-3 col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-inverse">
                                                        <i class="fa fa-btn fa-search"></i> Search Clients
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
    <script language="javascript" type="text/javascript">
        $("#date_of_birthfrom").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
        $("#date_of_birthto").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });

        $(document).ready(function() {
            // 
        });
    </script>
@endsection
