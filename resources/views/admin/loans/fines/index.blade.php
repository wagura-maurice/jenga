@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">Public</a></li>
            <li><a href="#">loans</a></li>
            <li class="active">Table</li>
        </ol>
        <h1 class="page-header">Loan Fines - DATA <small>loan fines data goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="#modal-dialog" data-toggle="modal">
                    <button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                            class="fa fa-filter"></i></button>
                </a>
                <a href="{!! url('/admin/loanfine') !!}">
                    <button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                            class="fa fa-refresh"></i></button>
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
                        <h4 class="panel-title">DataTable - Autofill</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Loan Number</th>
                                    <th>Loan Product</th>
                                    <th>Client</th>
                                    <th>Fine Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['list'] as $fine)
                                    <tr>
                                        <td class='table-text'>
                                            <div class="label label-info">
                                                # {!! $fine->id !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                <a href="{!! isset($fine->loan) ? route('loans.show', $fine->loan->id) : '#' !!}">
                                                    {!! isset($fine->loan) ? $fine->loan->loan_number : null !!}
                                                </a>
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                <a href="{!! isset($fine->product) ? route('loanproducts.show', $fine->product->id) : '#' !!}">
                                                    {!! isset($fine->product) ? $fine->product->code . ' - ' . $fine->product->name : null !!}
                                                </a>
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                <a href="{!! isset($fine->client) ? route('clients.show', $fine->client->id) : '#' !!}">
                                                    {!! isset($fine->client)
                                                        ? $fine->client->client_number . ' - ' . $fine->client->first_name . ' ' . $fine->client->last_name
                                                        : null !!}
                                                </a>
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! isset($fine->fine_date) ? \Carbon\Carbon::parse($fine->fine_date)->format('F dS Y') : null !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                KES {!! number_format($fine->amount, 2) !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            @if ($fine->_status == 'settled')
                                                <div class="label label-success">SETTLED</div>
                                            @elseif($fine->_status == 'unpaid')
                                                <div class="label label-warning">UNPAID</div>
                                            @elseif($fine->_status == 'waive')
                                                <div class="label label-info">WAIVE</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($fine->_status == 'unpaid')
                                                <a href="{{ route('loanfine.edit', $fine->id) }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="{!! ucwords(__('ACCEPT SETTLEMENT PAYMENT')) !!}"
                                                    class='btn btn-sm btn-circle btn-success'>
                                                    <i class="fa fa-btn fa-check"></i>
                                                </a>
                                                <span data-bs-toggle="tooltip" data-bs-placement="left" title="{!! ucwords(__('WAIVE SETTLEMENT PAYMENT')) !!}" onclick="updateStatus({{ $fine->id }}, 'waive')" class='btn btn-sm btn-circle btn-info'><i class="fa fa-btn fa-archive"></i></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $data['list']->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-message" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                    <h4 class="modal-title">loan fines - Filter Dialog</h4>
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
                                    <form id="form" class="form-horizontal" action="{!! url('admin/loanfine') !!}"
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
                                            <label for="Loan Product" class="col-sm-3 control-label">Loan Product</label>
                                            <div class="col-sm-6">
                                                <select class="form-control selectpicker" data-size="100000"
                                                    data-live-search="true" data-style="btn-white" name="product">
                                                    <option value="" selected disabled>Select Loan Product</option>
                                                    @foreach ($data['products'] as $product)
                                                        <option value="{!! $product->id !!}"
                                                            @if (isset($data['product']) && $data['product'] == $product->id) selected @endif>
                                                            {!! ucwords($product->name) !!}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                            <label for="Status" class="col-sm-3 control-label">Status</label>
                                            <div class="col-sm-6">
                                                <select class="form-control selectpicker" data-size="100000"
                                                    data-live-search="true" data-style="btn-white" name="_status">
                                                    <option value="" selected disabled>Select Status</option>
                                                    <option value="unpaid">UNPAID</option>
                                                    <option value="paid">PAID</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <div class="col-sm-offset-3 col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-inverse">
                                                        <i class="fa fa-btn fa-search"></i> Search
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
        function updateStatus(id, action) {
            // console.log(id);
            Swal.fire({
                title: 'Provide a reason to ' + action + ' this loan fine.',
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
                    formData.append('_method', 'PATCH');
                    formData.append('id', id);
                    formData.append('_status', action);
                    formData.append('_narrative', comment);

                    axios.post(
                        '/admin/loanfine/' + id,
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
    </script>
@endsection
