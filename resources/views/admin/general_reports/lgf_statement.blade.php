@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">General Ledgers</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">General Ledgers - DATA <small>general ledgers data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($generalledgersdata['usersaccountsroles'][0]->_report==1)
                <a href="{!! url('admin/generalledgersreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($generalledgersdata['usersaccountsroles'][0]->_report==1 || $generalledgersdata['usersaccountsroles'][0]->_list==1)
                <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
            @if($generalledgersdata['usersaccountsroles'][0]->_list==1)    
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
                            <div class="panel-body generalledgersdata">
                                @include('admin.general_ledgers.presult')
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="modal fade modal-message" id="modal-dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                        <h4 class="modal-title">General Ledgers - Filter Dialog</h4>
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
                                        <form id="form"  class="form-horizontal" action="{!! url('admin/generalledgersfilter') !!}" method="POST">
                                            {!! csrf_field() !!}
                                            <div class="form-group">
                                                <label for="Account" class="col-sm-3 control-label">Account</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="account"  id="account">
                                                        <option value="" >Select Account</option>				                                @foreach ($generalledgersdata['accounts'] as $accounts)
                                                        <option value="{!! $accounts->id !!}">

                                                            {!! $accounts->code!!}
                                                            {!! $accounts->name!!}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Entry Type" class="col-sm-3 control-label">Entry Type</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="entry_type"  id="entry_type">
                                                        <option value="" >Select Entry Type</option>				                                @foreach ($generalledgersdata['entrytypes'] as $entrytypes)
                                                        <option value="{!! $entrytypes->id !!}">

                                                            {!! $entrytypes->name!!}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="transaction_number"  id="transaction_number" class="form-control" placeholder="Transaction Number" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="amount"  id="amount" class="form-control" placeholder="Amount" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Date" class="col-sm-3 control-label">Date</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="datefrom" id="datefrom" class="form-control m-b-5" placeholder="Date From" value="">
                                                    <input type="text" name="dateto" id="dateto" class="form-control" placeholder="Date To" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-6">
                                                    <div class="col-sm-offset-3 col-sm-6">
                                                        <button type="submit" class="btn btn-sm btn-inverse">
                                                            <i class="fa fa-btn fa-search"></i> Search General Ledgers
                                                        </button>
                                                    </div>
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
</div>
@endsection

@section('script')
<script language="javascript" type="text/javascript">
    $("#datefrom").datepicker({todayHighlight:!0,autoclose:!0});
    $("#dateto").datepicker({todayHighlight:!0,autoclose:!0});

    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getPosts(page);
            }
        }
    });
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getPosts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
    function getPosts(page) {
        $.ajax({
            url : '?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.generalledgersdata').html(data);
            location.hash = page;
        }).fail(function () {
            alert('general ledgers data could not be loaded.');
        });
    }
</script>
@endsection