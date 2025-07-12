@extends('admin.home')
@section('main_content')
    <div id='content' class='content'>
        <ol class="breadcrumb hidden-print pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li class="active">Loan Guarantors</li>
        </ol>
        <h1 class="page-header hidden-print">Loan Guarantors <small>loan guarantors report goes here...</small></h1>
        <div class="row no-print">
            <div class="col-md-12 hidden-print">
                <a href="{!! route('loanguarantors.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                            class="fa fa-arrow-left"></i></button></a>
            </div>
        </div>
        <div class="invoice">
            <div class="invoice-company">
                <span class="pull-right hidden-print">
                    <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export
                        as PDF</a>
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i
                            class="fa fa-print m-r-5"></i> Print</a>
                </span>
            </div>
            <div class="invoice-header">
                <div class="invoice-from">
                    <address class="m-t-5 m-b-5">
                        <strong>{!! $loanguarantorsdata['company'][0]->name !!}</strong><br />
                        {!! $loanguarantorsdata['company'][0]->street !!} {!! $loanguarantorsdata['company'][0]->address !!}<br />
                        {!! $loanguarantorsdata['company'][0]->city !!}, {!! $loanguarantorsdata['company'][0]->zip_code !!}<br />
                        Phone: {!! $loanguarantorsdata['company'][0]->phone_number !!}<br />
                    </address>
                </div>
                <div class="invoice-date">
                    <img src="{!! secure_asset('uploads/images/' . $loanguarantorsdata['company'][0]->logo) !!}" width='100' height='100' />
                </div>
            </div>
            <div class="invoice-content">
                <div class="table-responsive">
                    <table class="table table-invoice">
                        <thead>
                            <tr>
                                <th>Loan</th>
                                <th>Guarantor</th>
                                <th>Relationship With Guarantor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loanguarantorsdata['list'] as $loanguarantors)
                                <tr>
                                    <td class='table-text'>
                                        <div>
                                            {!! $loanguarantors->loanmodel->loan_number !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $loanguarantors->guarantormodel->id_number !!}
                                            {!! $loanguarantors->guarantormodel->first_name !!}
                                            {!! $loanguarantors->guarantormodel->middle_name !!}
                                            {!! $loanguarantors->guarantormodel->last_name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $loanguarantors->relationshipwithguarantormodel->name !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="invoice-price">
                    <div class="invoice-price-left">
                        <div class="invoice-price-row">
                        </div>
                    </div>
                    <div class="invoice-price-right">
                        <small>TOTAL COUNT</small> {!! count($loanguarantorsdata['list']) !!}
                    </div>
                </div>
            </div>
            <div class="invoice-footer text-muted">
                <p class="text-center m-b-5">
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-globe"></i> {!! $loanguarantorsdata['company'][0]->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $loanguarantorsdata['company'][0]->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $loanguarantorsdata['company'][0]->email_address !!}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
