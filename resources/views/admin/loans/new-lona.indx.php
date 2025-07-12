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
            <a href="{!! route('loans.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($loansdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/loansreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($loansdata['usersaccountsroles'][0]->_report==1 || $loansdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
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
                    <table class="table table-striped table-bordered" id="grid">
                        <thead>
                                    <tr>
                                        <th>Loan Number</th>
                                        <th>Loan Product</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Interest Rate Type</th>
                                        <th>Interest Rate</th>
                                        <th>Status</th>
                                        <th>Action</th>      
                                    </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    @endif
@endsection
@section('script')

<script language="javascript" type="text/javascript">

$(document).ready(function(){

    $("#grid").DataTable({
        "bretrieve": true,
        "sPaginationType": "full_numbers",
        "bProcessing": true,
        "bServerSide": true,
        destroy: true,
        "info": false,
         "ajax": {
                'type': 'POST',
                'url': "{!!url('/admin/getloans')!!}",
                'data': {"_token": "{{ csrf_token() }}"},
            },        
        "sServerMethod": "POST",
        // Callback settings
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

            var id=aData.id;

            var action='';
        

            $("td:eq(6)", nRow).html(action);

            return nRow;
        },
        "aoColumns": [
            { "mDataProp": "loan_number", "sTitle": "Client Number", "bSortable": false },
            { "mDataProp": "first_name", "sTitle": "First Name", "bSortable": false },
            { "mDataProp": "middle_name", "sTitle": "Middle Name", "bSortable": false },
            { "mDataProp": "last_name", "sTitle": "Last Name", "bSortable": false },
            { "mDataProp": "id_number", "sTitle": "Id Number", "bSortable": false },
            { "mDataProp": "primary_phone_number", "sTitle": "Primary Phone Number" },
            { "mDataProp": "created_at", "sTitle": "Action" }
        ],
        "aaSorting": [[5, "desc"]],
        "columnDefs": [{ className: "text-right", targets: [5] }],
        "responsive": true
    });    

});
</script>
@endsection