@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Processing Fee Payments</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Processing Fee Payments Form <small>processing fee payments details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('processingfeepayments.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <h4 class="panel-title">DataForm - Autofill</h4>
                </div>
                <div class="panel-body">
                    <form id="form" class="form-horizontal" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="Loan Number" class="col-sm-3 control-label">Loan Number</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="loan_number" id="loan_number" onchange='getprocessingfeebalance()'>
                                    <option value="">Select Loan Number</option> @foreach ($processingfeepaymentsdata['loans'] as $loans)
                                    <option value="{!! $loans->id !!}">

                                        {!! $loans->loan_number!!} - ({!! $loans->clientmodel->client_number!!} {!! $loans->clientmodel->first_name!!} {!! $loans->clientmodel->middle_name!!} {!! $loans->clientmodel->last_name!!})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="payment_mode" id="payment_mode">
                                    <option value="">Select Payment Mode</option> @foreach ($processingfeepaymentsdata['paymentmodes'] as $paymentmodes)
                                    <option value="{!! $paymentmodes->id !!}">

                                        {!! $paymentmodes->name!!}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                            <div class="col-sm-6">
                                <input type="text" name="transaction_number" id="transaction_number" class="form-control" placeholder="Transaction Number" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Amount" class="col-sm-3 control-label">Balance</label>
                            <div class="col-sm-6">
                                <input type="text" disabled name="balance" id="balance" class="form-control" placeholder="Balance" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Amount" class="col-sm-3 control-label">Amount</label>
                            <div class="col-sm-6">
                                <input type="text" onkeyup="amountChange()" name="amount" id="amount" class="form-control" placeholder="Amount" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Date" class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-6">
                                <input type="text" name="date" id="date" class="form-control" placeholder="Date" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="button" disabled="disabled" onclick="save()" class="btn btn-sm btn-primary" id="btn-save">
                                    <i class="fa fa-btn fa-plus"></i> Add Processing Fee Payments
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="javascript" type="text/javascript">
    // function getloanprocessingfee() {
    //     var loan_number = $("#loan_number").val();
    //     // var token=$("input[name=_token]").val();
    //     $.ajax({
    //         type: 'POST',
    //         url: "{!! url('/admin/getloanprocessingfee/')!!}",
    //         data: JSON.stringify({
    //             'loan_number': loan_number,
    //             '_token': "{{ csrf_token() }}"
    //         }),
    //         contentType: 'application/json',
    //         processData: false,
    //         success: function(data) {
    //             var obj = jQuery.parseJSON(data);
    //             console.log(data);
    //             $("#amount").val(data);
    //             $("#_amount").val(data);
    //         }
    //     });

    // }


    function save() {
        $("#btn-save").attr("disable", true);
        var formData = new FormData($('#form')[0]);
        $.ajax({
            type: 'POST',
            url: "{!! route('processingfeepayments.store')!!}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#btn-save").attr("disable", false);
                var obj = jQuery.parseJSON(data);
                if (obj.status == '1') {
                    $.gritter.add({
                        title: 'Success',
                        text: obj.message,
                        sticky: false,
                        time: '1000',
                    });
                    $("#form")[0].reset();
                } else {
                    $.gritter.add({
                        title: 'Fail',
                        text: obj.message,
                        sticky: false,
                        time: '5000',
                    });
                }
            },
            error: function(data) {
                console.log(data)
                $.gritter.add({
                    title: 'Error',
                    text: 'An Error occured. Please review your data then submit again!!',
                    sticky: false,
                    time: '5000',
                });
            }
        });
        return false;
    }

    function getprocessingfeebalance() {

        $("#balance").val("");

        $("#amount").val("");

        var loanid = $("#loan_number").val();

        $.get("{!!url('/admin/getprocessingfeebalance')!!}/" + loanid, function(data) {

            $("#balance").val(data);

            $("#amount").val(data);

            amountChange();

        });

    }

    function amountChange() {

        var balance = Number($("#balance").val());

        var amount = Number($("#amount").val());

        if ($("#loan_number").val()) {

            if (amount > balance) {

                $("#btn-save").attr("disabled", true);

            } else {

                $("#btn-save").attr("disabled", false);

            }
        }else{

            $("#btn-save").attr("disabled", false);
            
        }


    }
</script>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
    $("#date").datepicker({
        todayHighlight: !0,
        autoclose: !0
    });
</script>
@endsection