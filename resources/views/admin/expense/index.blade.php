@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">Public</a></li>
            <li><a href="#">Expense</a></li>
            <li class="active">Table</li>
        </ol>
        <h1 class="page-header">Expense - DATA <small>expense fee data goes
                here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                    <a href="{!! route('expense.create') !!}"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
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
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Expense Type</th>
                                    <th>Payment Mode</th>
                                    <th>Transaction Code</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['list'] as $expense)
                                    <tr>
                                        <td class='table-text'>
                                            <div>
                                                {!! $expense->id !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $expense->usermodel->name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $expense->expensetypemodel->name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $expense->paymentmodemodel->name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $expense->transaction_code !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $expense->date !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! number_format((int) $expense->amount ?? 0, 2) !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $expense->transactionstatusmodel->name !!}
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{!! route('expense.destroy', $expense->id) !!}" method="POST">
                                                    <input type="hidden" name="_method" value="delete" />
                                                    {!! csrf_field() !!}
                                                    {!! method_field('DELETE') !!}
                                                    <button type='submit'
                                                        id='delete-configuration-{!! $expense->id !!}'
                                                        class='btn btn-sm btn-circle btn-danger'>
                                                        <i class='fa fa-btn fa-trash'></i>
                                                    </button>
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
@endsection
@section('script')
@endsection
