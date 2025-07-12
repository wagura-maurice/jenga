@extends('admin.home')
@section('main_content')
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
                @if ($loansdata['usersaccountsroles'][0]->_add == 1)
                    <a href="{!! url('/admin/loanapplicationproducts') !!}"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
                @endif
                @if ($loansdata['usersaccountsroles'][0]->_report == 1)
                    <a href="{!! url('admin/loansreport') !!}"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                                class="fa fa-file-text-o"></i></button></a>
                @endif
                @if ($loansdata['usersaccountsroles'][0]->_report == 1 || $loansdata['usersaccountsroles'][0]->_list == 1)
                    <a href="#modal-dialog" data-toggle="modal"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
                @endif
                <a href="{!! url('/admin/loans') !!}"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-refresh"></i></button></a>
                @if ($loansdata['usersaccountsroles'][0]->_list == 1)
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
                        <h4 class="panel-title">DataTable - Autofill</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Client</th>
                                    <th>Product</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Interest</th>
                                    <th>Disbursement</th>
                                    <th>Mode</th>
                                    <th>Balance</th>
                                    <!-- <th>Updated</th> -->
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loansdata['list'] as $loans)
                                    <tr
                                        class="@if (!isset($loans->deleted_at) && $loans->loanstatusmodel->name == 'Approved') success @elseif(!isset($loans->deleted_at) && $loans->loanstatusmodel->name == 'Rejected') warning @elseif(!isset($loans->deleted_at) && $loans->loanstatusmodel->name == 'Pending') info @else danger @endif">
                                        <td class='table-text'>
                                            <div class="label label-info">
                                                # {!! $loans->loan_number !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                <a href="{!! isset($loans->clientmodel) ? route('clients.show', $loans->clientmodel->id) : '#' !!}">
                                                    {!! isset($loans->clientmodel)
                                                        ? $loans->clientmodel->client_number .
                                                            ' - ' .
                                                            $loans->clientmodel->first_name .
                                                            ' ' .
                                                            $loans->clientmodel->last_name
                                                        : null !!}
                                                </a>
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                <a href="{!! isset($loans->loanproductmodel) ? route('loanproducts.show', $loans->loanproductmodel->id) : '#' !!}">
                                                    {!! isset($loans->loanproductmodel)
                                                        ? $loans->loanproductmodel->code . ' - ' . $loans->loanproductmodel->name
                                                        : null !!}
                                                </a>
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! isset($loans->date) && !empty($loans->date)
                                                    ? \Carbon\Carbon::parse($loans->requested_at)->format('F dS Y')
                                                    : null !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                KES {!! number_format($loans->total_loan_amount, 2) !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                KES {!! number_format($loans->interest_charged, 2) !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                KES {!! number_format($loans->amount_to_be_disbursed, 2) !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! isset($loans->modeofdisbursementmodel)
                                                    ? strtoupper($loans->modeofdisbursementmodel->code . '-' . $loans->modeofdisbursementmodel->name)
                                                    : null !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                KES {!! number_format(getLoanBalance(['id' => $loans->id]), 2) !!}
                                            </div>
                                        </td>
                                        <!-- <td class='table-text'>
                                                                                    <div>
                                                                                        {!! \Carbon\Carbon::parse($loans->updated_at)->diffForHumans() !!}
                                                                                    </div>
                                                                                </td> -->
                                        <td class='table-text'>
                                            @if ($loans->loanstatusmodel->name == 'Approved')
                                                <div class="label label-success">
                                                    {{ strtoupper($loans->loanstatusmodel->name) }}</div>
                                            @elseif($loans->loanstatusmodel->name == 'Rejected')
                                                <div class="label label-warning">
                                                    {{ strtoupper($loans->loanstatusmodel->name) }}</div>
                                            @else
                                                <div class="label label-info">
                                                    {{ strtoupper($loans->loanstatusmodel->name) }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($loansdata['usersaccountsroles'][0]->_show == 1)
                                                <span data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="{!! ucwords(__('show')) !!}">
                                                    <a href="{!! route('loans.show', $loans->id) !!}"
                                                        id='show-loans-{!! $loans->id !!}'
                                                        class='btn btn-sm btn-circle btn-primary'>
                                                        <i class='fa fa-btn fa-eye'></i>
                                                    </a>
                                                </span>
                                            @endif
                                            @if ($loansdata['usersaccountsroles'][0]->_edit == 1)
                                                @if (!isset($loans->deleted_at) && $loans->loanstatusmodel->name != 'Approved')
                                                    <span data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="{!! ucwords(__('edit')) !!}">
                                                        <a href="{!! route('loans.edit', $loans->id) !!}"
                                                            id='edit-loans-{!! $loans->id !!}'
                                                            class='btn btn-sm btn-circle btn-info'>
                                                            <i class='fa fa-btn fa-edit'></i>
                                                        </a>
                                                    </span>
                                                @endif
                                            @endif
                                            @if (!isset($loans->deleted_at) and $loansdata['usersaccountsroles'][0]->_edit == 1)
                                                @if (!isset($loans->deleted_at) && $loans->loanstatusmodel->name != 'Approved')
                                                    <span data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="{!! ucwords(__('approve')) !!}">
                                                        <a href="{{ url('/admin/loanapproval/' . $loans->id) }}"
                                                            id='edit-loans-{!! $loans->id !!}'
                                                            class='btn btn-sm btn-circle btn-success'>
                                                            <i class='fa fa-btn fa-check-circle'></i>
                                                        </a>
                                                    </span>
                                                @endif
                                            @endif
                                            @if ($loansdata['usersaccountsroles'][0]->_edit == 1)
                                                @if (!isset($loans->deleted_at) && $loans->loanstatusmodel->name == 'Approved')
                                                    @if (getLoanBalance(['id' => $loans->id]) >= 500)
                                                        <span data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="{!! ucwords(__('reschedule')) !!}">
                                                            <a href="{!! url('/admin/loanapplicationproducts?loanNumber=' . $loans->loan_number) !!}"
                                                                id='edit-loans-{!! $loans->id !!}'
                                                                class='btn btn-sm btn-circle btn-info'>
                                                                <i class='fa fa-btn fa-hourglass-o'></i>
                                                            </a>
                                                        </span>
                                                    @endif
                                                @endif
                                            @endif
                                            @if ($loansdata['usersaccountsroles'][0]->_delete == 1)
                                                @if (isset($loans->deleted_at))
                                                    <span data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="{!! ucwords(__('Activate')) !!}"
                                                        onclick="destroy({{ $loans->id }}, 'activate')"
                                                        class='btn btn-sm btn-circle btn-success'><i
                                                            class="fa fa-btn fa-check"></i></span>
                                                @else
                                                    <span data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="{!! ucwords(__('Deactivate')) !!}"
                                                        onclick="destroy({{ $loans->id }}, 'deactivate')"
                                                        class='btn btn-sm btn-circle btn-danger'><i
                                                            class="fa fa-btn fa-trash"></i></span>
                                                @endif
                                            @endif
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
                                    <form id="form" class="form-horizontal" action="{!! url('admin/loans') !!}"
                                        method="GET">
                                        <div class="form-group">
                                            <label for="client number" class="col-sm-3 control-label">Client
                                                Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="client_number"
                                                    id="client_number" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="loan number" class="col-sm-3 control-label">Loan Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="loan_number"
                                                    id="loan_number" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Code" class="col-sm-3 control-label">Start Date</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="start_date"
                                                    id="start_date" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Code" class="col-sm-3 control-label">End Date</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="end_date"
                                                    id="end_date" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Loan Product" class="col-sm-3 control-label">Loan Product</label>
                                            <div class="col-sm-6">
                                                <select class="form-control selectpicker" data-size="100000"
                                                    data-live-search="true" data-style="btn-white" name="product">
                                                    <option value="" selected disabled>Select Loan Product</option>
                                                    @foreach ($loansdata['loanproducts'] as $product)
                                                        <option value="{!! $product->id !!}"
                                                            @if (isset($loansdata['product']) && $loansdata['product'] == $product->id) selected @endif>
                                                            {!! ucwords($product->name) !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Loan Status" class="col-sm-3 control-label">Loan Status</label>
                                            <div class="col-sm-6">
                                                <select class="form-control selectpicker" data-size="100000"
                                                    data-live-search="true" data-style="btn-white" name="status">
                                                    <option value="" selected disabled>Select Loan Status</option>
                                                    @foreach ($loansdata['loanstatuses'] as $status)
                                                        <option value="{!! $status->id !!}"
                                                            @if (isset($loansdata['status']) && $loansdata['status'] == $status->id) selected @endif>
                                                            {!! ucwords($status->name) !!}
                                                        </option>
                                                    @endforeach
                                                </select>
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
    <script language="javascript" type="text/javascript">
        function destroy(id, action) {
            // console.log(id);
            Swal.fire({
                title: 'Provide a reason to ' + action + ' this loan.',
                input: 'textarea',
                // inputLabel: 'Narrative',
                inputPlaceholder: 'Type your comment here...',
                inputAttributes: {
                    'aria-label': 'Type your comment here'
                },
                showCancelButton: true,
                confirmButtonText: action.toUpperCase(),
                showLoaderOnConfirm: true,
                preConfirm: (comment) => {
                    const formData = new FormData()
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('_method', 'DELETE');
                    formData.append('id', id);
                    formData.append('action', action);
                    formData.append('_narrative', comment);

                    axios.post(
                        '/admin/loans/' + id,
                        formData, {
                            headers: {
                                "Content-Type": "x-www-form-urlencoded",
                            }
                        }
                    ).then((response) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: response.data.icon,
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }).catch((error) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Server error encountered, please try again!',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                }
            });
        }

        $(document).ready(function() {

            $("#start_date").datepicker({
                todayHighlight: !0,
                autoclose: !0
            });

            $("#end_date").datepicker({
                todayHighlight: !0,
                autoclose: !0
            });
        });
    </script>
@endsection
