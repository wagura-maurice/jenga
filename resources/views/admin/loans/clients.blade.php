@extends("admin.home")
@section("main_content")

<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Clients</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Clients - DATA <small>clients data goes here...</small></h1>

    @if($loansdata['usersaccountsroles'][0]->_list==1)
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
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

    <div class="row">
        <div class="col-md-12">
            <a href="#modal-dialog" data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
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
                    <h4 class="panel-title">Members</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th># NUMBER</th>
                                <th>FIRST NAME</th>
                                <th>MIDDLE NAME</th>
                                <th>LAST NAME</th>
                                <th>PHONE NUMBER</th>
                                <th>NATIONAL ID</th>
                                <th>GENDER</th>
                                <th>DATE OF BIRTH</th>
                                <th>CREATED</th>
                                <th>TYPE</th>
                                <th>CATEGORY</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loansdata['list'] as $client)
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
                                        <a href="tel:{!! $client->primary_phone_number !!}">{!!
                                            $client->primary_phone_number !!}</a>
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
                                        {!! $client->date_of_birth !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! \Carbon\Carbon::parse($client->created_at)->diffForHumans() !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! isset($client->clienttypemodel) ? $client->clienttypemodel->name : NULL !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div class="label label-info">
                                        {!! isset($client->clientcategorymodel) ? $client->clientcategorymodel->name : NULL !!}
                                    </div>
                                </td>
                                <td>
                                    <a href="{!! url('/admin/loanapplication/' . $loansdata['loanproduct']->id) . '/' . $client->id !!}" class='btn btn-primary m-l-5 m-b-5'><i class='fa fa-btn fa-arrow-right '></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $loansdata['list']->links() !!}
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
                    <h4 class="modal-title">loans - Filter Dialog</h4>
                </div>
                <div class="modal-body">
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
                                    <form id="form" class="form-horizontal" action="{!! route('loanapplicationclients', [$loansdata['productId'], $loansdata['clientTypeId']]) !!}" method="GET">
                                        <div class="form-group">
                                            <label for="client number" class="col-sm-3 control-label">Client Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="client_number" id="client_number" value="{{ isset($loansdata['client_number']) ? $loansdata['client_number'] : NULL }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Phone Number" class="col-sm-3 control-label">Phone Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="primary_phone_number" id="primary_phone_number" value="{{ isset($loansdata['primary_phone_number']) ? $loansdata['primary_phone_number'] : NULL }}"/>
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

    function search() {
        var formData = new FormData($('#search_form')[0]);
        $.ajax({
            type: 'POST',
            url: "{!! url('admin/clientssearch')!!}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                $("#data-table tbody tr").remove();
                var list = obj.list;
                for (var c = 0; c < list.length; c++) {
                    console.log(list[c]);
                    var row = "";
                    $("data-table tbody").append(row);
                }
                console.log(obj);
            },
            error: function(data) {

            }
        });


    }
    $(document).ready(function() {

        $("#grid").DataTable({
            "bretrieve": true,
            "sPaginationType": "full_numbers",
            "bProcessing": true,
            "bServerSide": true,
            destroy: true,
            "info": false,
            "ajax": {
                'type': 'POST',
                'url': "{!!url('/admin/getclients')!!}",
                'data': {
                    "_token": "{{ csrf_token() }}"
                },
            },
            "sServerMethod": "POST",
            // Callback settings
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                var id = aData.id;

                console.log(aData.id);

                var action = "<a href=\"{!! url('/admin/loanapplication/'.$loansdata['loanproduct']->id) !!}/" + aData.id + "\" class='btn btn-primary m-l-5 m-b-5'><i class='fa fa-btn fa-arrow-right '></i></a>";

                $("td:eq(6)", nRow).html(action);

                return nRow;
            },
            "aoColumns": [{
                    "mDataProp": "client_number",
                    "sTitle": "Client Number",
                    "bSortable": false
                },
                {
                    "mDataProp": "first_name",
                    "sTitle": "First Name",
                    "bSortable": false
                },
                {
                    "mDataProp": "middle_name",
                    "sTitle": "Middle Name",
                    "bSortable": false
                },
                {
                    "mDataProp": "last_name",
                    "sTitle": "Last Name",
                    "bSortable": false
                },
                {
                    "mDataProp": "id_number",
                    "sTitle": "Id Number",
                    "bSortable": false
                },
                {
                    "mDataProp": "primary_phone_number",
                    "sTitle": "Primary Phone Number"
                },
                {
                    "mDataProp": "created_at",
                    "sTitle": "Action"
                }
            ],
            "aaSorting": [
                [5, "desc"]
            ],
            "columnDefs": [{
                className: "text-right",
                targets: [5]
            }],
            "responsive": true
        });

    });
</script>
@endsection