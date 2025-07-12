@extends('admin.home')
@section('main_content')
    <style type="text/css">
        @media print {

            a,
            h1,
            .breadcrumb {
                visibility: hidden !important;
            }
        }

        table tbody::-webkit-scrollbar {
            width: 0 !important
        }

        table tbody {
            -ms-overflow-style: none;
        }
    </style>
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">sales Orders</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">sales Orders Form <small>sales orders details goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! route('salesorders.index') !!}"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
            </div>
        </div>
        <!-- begin invoice -->
        <div class="invoice" id="invoce">
            <!-- begin invoice-company -->
            <div class="invoice-company text-inverse f-w-600">
                <span class="pull-right hidden-print">
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i
                            class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
                </span>
                <img src="{!! secure_asset('uploads/images/' . $salesordersdata['company']->logo) !!}" style="max-height: 70px;" />
            </div>
            <!-- end invoice-company -->
            <!-- begin invoice-header -->
            <div class="invoice-header">
                <div class="invoice-from">
                    <small>Company</small>
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">{!! $salesordersdata['company']->name !!}</strong><br />
                        {!! $salesordersdata['company']->street !!}<br />
                        {!! $salesordersdata['company']->city !!}, {!! $salesordersdata['company']->zip_code !!}<br />
                        Phone: {!! $salesordersdata['company']->phone_number !!}<br />
                        Email: {!! $salesordersdata['company']->email_address !!}
                    </address>
                </div>
                <div class="invoice-to">
                    <small>Customer</small>
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">{!! $salesordersdata['data']->customer_name !!}</strong><br />
                        Phone: {!! $salesordersdata['data']->customer_phone_number !!}<br />
                        Email: {!! $salesordersdata['data']->customer_email_address !!}
                    </address>
                </div>
                <div class="invoice-date">
                    <small>sales order</small>
                    <div class="date text-inverse m-t-5">{!! $salesordersdata['data']->order_date !!}</div>
                    <div class="invoice-detail">
                        {!! $salesordersdata['data']->order_number !!}<br />
                        {!! $salesordersdata['data']->orderstatusmodel->name !!}
                    </div>
                </div>
            </div>
            <!-- end invoice-header -->
            <!-- begin invoice-content -->
            <div class="invoice-content">
                <!-- begin table-responsive -->
                <div class="">
                    <table class="table table-invoice">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-right">Quantity</th>
                                <th class="text-right">Unit Price</th>
                                <th class="text-right">Discount</th>
                                <th class="text-right">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesordersdata['orderlines'] as $salesorderlines)
                                <tr>
                                    <td>
                                        <span class="text-inverse">{!! $salesorderlines->salesordermodel->order_number !!} -
                                            {!! $salesorderlines->productmodel->name !!}</span>
                                    </td>
                                    <td class="text-right">{!! $salesorderlines->quantity !!}</td>
                                    <td class="text-right">KSH.{!! $salesorderlines->unit_price !!}</td>
                                    <td class="text-right">KSH.{!! $salesorderlines->discount !!}</td>
                                    <td class="text-right">KSH.{!! $salesorderlines->total_price !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
                <!-- begin invoice-price -->
                <div class="invoice-price">
                    <div class="invoice-price-left">
                        <div class="invoice-price-row">
                        </div>
                    </div>
                    <div class="invoice-price-right">
                        <small>TOTAL</small> <span class="f-w-600">KSH.{!! $salesordersdata['data']->amount !!}</span>
                    </div>
                </div>
                <!-- end invoice-price -->
            </div>
            <!-- end invoice-content -->
            <!-- begin invoice-note -->
            <div class="invoice-note">
                * Payment is due <strong>{!! $salesordersdata['data']->due_date !!}</strong> <br />
                * If you have any questions concerning this sales order, contact
                [{!! $salesordersdata['company']->phone_number !!}, {!! $salesordersdata['company']->email_address !!}]
            </div>
            <!-- end invoice-note -->
            <!-- begin invoice-footer -->
            <div class="invoice-footer">
                <p class="text-center m-b-5 f-w-600">
                    THANK YOU FOR YOUR BUSINESS
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>{!! $salesordersdata['company']->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:{!! $salesordersdata['company']->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> {!! $salesordersdata['company']->email_address !!}</span>
                </p>
            </div>
            <!-- end invoice-footer -->
        </div>
        <!-- end invoice -->
    </div>
