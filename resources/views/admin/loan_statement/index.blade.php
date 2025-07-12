@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">loans</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">loans - DATA <small>loans data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($loansdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! url('/admin/loanapplicationproducts') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($loansdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/loansreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($loansdata['usersaccountsroles'][0]->_report==1 || $loansdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog" data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
            @if($loansdata['usersaccountsroles'][0]->_list==1)
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
                                <form id="form" class="form-horizontal" action="{!! url('admin/loansfilter') !!}" method="POST">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="Code" class="col-sm-3 control-label">Code</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="code" id="code" class="form-control" placeholder="Code" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Name" class="col-sm-3 control-label">Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Description" class="col-sm-3 control-label">Description</label>
                                        <div class="col-sm-6">
                                            <Textarea name="description" id="description" class="form-control" row="5" placeholder="Description" value=""></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-6">
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <button type="submit" class="btn btn-sm btn-inverse">
                                                    <i class="fa fa-btn fa-search"></i> Search loans
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
<script>
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
                'url': "{!!url('/admin/getloanlist')!!}",
                'data': {
                    "_token": "{{ csrf_token() }}"
                },
            },
            "sServerMethod": "POST",
            // Callback settings
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                var action = "<a href=\"{!! url('/admin/loanstatement') !!}/"+aData.loanId+"\" id='edit-clients-" + aData.id + "' class='btn btn-primary m-l-5 m-b-5 btn-xs'>View</a>";


                $("td:eq(7)", nRow).html(action);

                var status = '';

                if ("001" == aData.loanStatusCode) {

                    status = "<span class='label label-warning'>Pending</span>";

                } else if ("002" == aData.loanStatusCode) {

                    status = "<span class='label label-success'>Approved</span>";

                } else if ("003" == aData.loanStatusCode) {

                    status = "<span class='label label-danger'>Rejected</span>";

                }

                $("td:eq(6)", nRow).html(status);


                return nRow;
            },
            "aoColumns": [{
                    "mDataProp": "loanNumber",
                    "sTitle": "Loan Number",
                    "bSortable": false
                },
                {
                    "mDataProp": "clientName",
                    "sTitle": "Client Name",
                    "bSortable": false
                },
                {
                    "mDataProp": "loanProductName",
                    "sTitle": "Loan Product",
                    "bSortable": false
                },                
                {
                    "mDataProp": "loanDate",
                    "sTitle": "Date",
                    "bSortable": false
                },
                {
                    "mDataProp": "loanAmount",
                    "sTitle": "Loan Amount",
                    "bSortable": false
                },
                {
                    "mDataProp": "disbursementAmount",
                    "sTitle": "Disbursement Amount",
                    "bSortable": false
                },
                {
                    "mDataProp": "loanStatusName",
                    "sTitle": "Status",
                    "bSortable": false
                },
                {
                    "mDataProp": "loanStatusName",
                    "sTitle": "Action",
                    "bSortable": false
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