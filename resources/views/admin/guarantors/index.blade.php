@extends('admin.home')
@section('main_content')
    <style type="text/css">
        td div img {
            max-width: 64px;
        }
    </style>
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">Public</a></li>
            <li><a href="#">Guarantors</a></li>
            <li class="active">Table</li>
        </ol>
        <h1 class="page-header">Guarantors - DATA <small>guarantors data goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                @if ($guarantorsdata['usersaccountsroles'][0]->_add == 1)
                    <a href="{!! route('guarantors.create') !!}"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
                @endif
                @if ($guarantorsdata['usersaccountsroles'][0]->_report == 1)
                    <a href="{!! url('admin/guarantorsreport') !!}"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                                class="fa fa-file-text-o"></i></button></a>
                @endif
                @if ($guarantorsdata['usersaccountsroles'][0]->_report == 1 ||
                    $guarantorsdata['usersaccountsroles'][0]->_list == 1)
                    <a href="#modal-dialog" data-toggle="modal"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
                @endif
            </div>
        </div>
        @if ($guarantorsdata['usersaccountsroles'][0]->_list == 1)
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
                            <h4 class="panel-title">DataTable - Autofill</h4>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id Number</th>
                                        <th>Name</th>
                                        <th>Client</th>
                                        <th>Relationship</th>
                                        <th>County</th>
                                        <th>Sub County</th>
                                        <th>Primary Phone Number</th>
                                        <th>Secondary Phone Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guarantorsdata['list'] as $guarantors)
                                        <tr>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $guarantors->id_number !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $guarantors->first_name !!} {!! $guarantors->middle_name !!} {!! $guarantors->last_name !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    @if (isset($guarantors->client))
                                                        {!! $guarantors->clientmodel->client_number !!}
                                                        {!! $guarantors->clientmodel->first_name !!}
                                                        {!! $guarantors->clientmodel->middle_name !!}
                                                        {!! $guarantors->clientmodel->last_name !!}
                                                    @endif
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $guarantors->relationshipmodel->name !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $guarantors->countymodel->name !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $guarantors->subcountymodel->name !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $guarantors->primary_phone_number !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $guarantors->secondary_phone_number !!}
                                                </div>
                                            </td>
                                            <td>
                                                <form action="{!! route('guarantors.destroy', $guarantors->id) !!}" method="POST">
                                                    @if ($guarantorsdata['usersaccountsroles'][0]->_show == 1)
                                                        <a href="{!! route('guarantors.show', $guarantors->id) !!}"
                                                            id='show-guarantors-{!! $guarantors->id !!}'
                                                            class='btn btn-sm btn-circle btn-inverse'>
                                                            <i class='fa fa-btn fa-eye'></i>
                                                        </a>
                                                    @endif
                                                    @if ($guarantorsdata['usersaccountsroles'][0]->_edit == 1)
                                                        <a href="{!! route('guarantors.edit', $guarantors->id) !!}"
                                                            id='edit-guarantors-{!! $guarantors->id !!}'
                                                            class='btn btn-sm btn-circle btn-warning'>
                                                            <i class='fa fa-btn fa-edit'></i>
                                                        </a>
                                                    @endif
                                                    @if ($guarantorsdata['usersaccountsroles'][0]->_delete == 1)
                                                        <input type="hidden" name="_method" value="delete" />
                                                        {!! csrf_field() !!}
                                                        {!! method_field('DELETE') !!}
                                                        <button type='submit'
                                                            id='delete-guarantors-{!! $guarantors->id !!}'
                                                            class='btn btn-sm btn-circle btn-danger'>
                                                            <i class='fa fa-btn fa-trash'></i>
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endif
    <div class="modal fade modal-message" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                    <h4 class="modal-title">Guarantors - Filter Dialog</h4>
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
                                    <form id="form" class="form-horizontal" action="{!! url('admin/guarantorsfilter') !!}"
                                        method="POST">
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label for="First Name" class="col-sm-3 control-label">First Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="first_name" id="first_name"
                                                    class="form-control" placeholder="First Name" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Middle Name" class="col-sm-3 control-label">Middle Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="middle_name" id="middle_name"
                                                    class="form-control" placeholder="Middle Name" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Last Name" class="col-sm-3 control-label">Last Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="last_name" id="last_name"
                                                    class="form-control" placeholder="Last Name" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Id Number" class="col-sm-3 control-label">Id Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="id_number" id="id_number"
                                                    class="form-control" placeholder="Id Number" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="County" class="col-sm-3 control-label">County</label>
                                            <div class="col-sm-6">
                                                <select class="form-control selectpicker" data-size="100000"
                                                    data-live-search="true" data-style="btn-white" name="county"
                                                    id="county">
                                                    <option value="">Select County</option>
                                                    @foreach ($guarantorsdata['counties'] as $counties)
                                                        <option value="{!! $counties->id !!}">

                                                            {!! $counties->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Sub County" class="col-sm-3 control-label">Sub County</label>
                                            <div class="col-sm-6">
                                                <select class="form-control selectpicker" data-size="100000"
                                                    data-live-search="true" data-style="btn-white" name="sub_county"
                                                    id="sub_county">
                                                    <option value="">Select Sub County</option>
                                                    @foreach ($guarantorsdata['subcounties'] as $subcounties)
                                                        <option value="{!! $subcounties->id !!}">

                                                            {!! $subcounties->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Primary Phone Number" class="col-sm-3 control-label">Primary Phone
                                                Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="primary_phone_number" id="masked-input-phone"
                                                    placeholder="(999) 999-9999" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Secondary Phone Number" class="col-sm-3 control-label">Secondary
                                                Phone Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="secondary_phone_number"
                                                    id="secondary_phone_number" class="form-control"
                                                    placeholder="Secondary Phone Number" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <div class="col-sm-offset-3 col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-inverse">
                                                        <i class="fa fa-btn fa-search"></i> Search Guarantors
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
@endsection
