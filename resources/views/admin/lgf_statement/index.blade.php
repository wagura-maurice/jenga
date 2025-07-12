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
    <div class="row">
        <div class="col-md-12">
            @if($clientsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('clients.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($clientsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/clientsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($clientsdata['usersaccountsroles'][0]->_report==1 || $clientsdata['usersaccountsroles'][0]->_list==1)
            <a href="{{url('/admin/clientssearch/')}}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-search"></i></button></a>
            @endif
<!--             @if($clientsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! url('/admin/importfromdb') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-download"></i></button></a>
            @endif            
 -->    @if($clientsdata['usersaccountsroles'][0]->_list==1)
        </div>
    </div>

<!--     <div class="row">
        <div class="col-md-12">
            <form id="search_form" method="post" action="{!! url('admin/searchclient')!!}">
                {!! csrf_field() !!}
                <div class="form-group" >
                    <div class="col-md-6 m-b-10 pull-right">
                        <input type="text" name="search_text" id="search_text" class="form-control"  placeholder="Seach Here" value="" placeholder="Enter keywords here...client number or id number or any name of fullname (last_name,middle_name,first_name)" onchange="this.form.submit();" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }">
                    </div>
                </div>        
            </form>                    
        </div>
    </div> -->
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


<script type="text/javascript">

    
</script>
@endsection
@section('script')
<script language="javascript" type="text/javascript">


$("#date_of_birthfrom").datepicker({todayHighlight:!0,autoclose:!0});
$("#date_of_birthto").datepicker({todayHighlight:!0,autoclose:!0});
function search(){
    var formData = new FormData($('#search_form')[0]);
    $.ajax({
        type:'POST',
        url: "{!! url('admin/clientssearch')!!}",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
            var obj = jQuery.parseJSON( data );
            $("#data-table tbody tr").remove();
            var list=obj.list;
            for(var c=0;c<list.length;c++){
                console.log(list[c]);
                var row=""; 
                $("data-table tbody").append(row);              
            }
            console.log(obj);
        },error: function(data){
            
        }
    });

}

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
                'url': "{!!url('/admin/getclients')!!}",
                'data': {"_token": "{{ csrf_token() }}"},
            },        
        "sServerMethod": "POST",
        // Callback settings
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

            var id=aData.id;

            var action="<a href=\"{!! url('/admin/lgfstatement') !!}/"+aData.id+"\" id='edit-clients-"+aData.id+"' class='btn btn-primary m-l-5 m-b-5'>View</a>";                

            $("td:eq(6)", nRow).html(action);

            return nRow;
        },
        "aoColumns": [
            { "mDataProp": "client_number", "sTitle": "Client Number", "bSortable": false },
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