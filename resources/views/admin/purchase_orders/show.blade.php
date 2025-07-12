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
    </style>
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Purchase Orders</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Purchase Orders Form <small>purchase orders details goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! route('purchaseorders.index') !!}"><button type="button"
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
                <img src="{!! secure_asset('uploads/images/' . $purchaseordersdata['company']->logo) !!}" style="max-height: 70px;" />
            </div>
            <!-- end invoice-company -->
            <!-- begin invoice-header -->
            <div class="invoice-header">
                <div class="invoice-from">
                    <small>Company</small>
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">{!! $purchaseordersdata['company']->name !!}</strong><br />
                        {!! $purchaseordersdata['company']->street !!}<br />
                        {!! $purchaseordersdata['company']->city !!}, {!! $purchaseordersdata['company']->zip_code !!}<br />
                        Phone: {!! $purchaseordersdata['company']->phone_number !!}<br />
                        Email: {!! $purchaseordersdata['company']->email_address !!}
                    </address>
                </div>
                <div class="invoice-to">
                    <small>Supplier</small>
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">{!! $purchaseordersdata['data']->suppliermodel->name !!}</strong><br />
                        {!! $purchaseordersdata['data']->suppliermodel->street !!}<br />
                        {!! $purchaseordersdata['data']->suppliermodel->city !!}, {!! $purchaseordersdata['data']->suppliermodel->postal_code !!}<br />
                        Phone: {!! $purchaseordersdata['data']->suppliermodel->phone_number !!}<br />
                        Email: {!! $purchaseordersdata['data']->suppliermodel->email_address !!}
                    </address>
                </div>
                <div class="invoice-date">
                    <small>purchase order</small>
                    <div class="date text-inverse m-t-5">{!! $purchaseordersdata['data']->order_date !!}</div>
                    <div class="invoice-detail">
                        {!! $purchaseordersdata['data']->order_number !!}<br />
                        {!! $purchaseordersdata['data']->orderstatusmodel->name !!}
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
                            @foreach ($purchaseordersdata['orderlines'] as $purchaseorderlines)
                                <tr>
                                    <td>
                                        <span class="text-inverse">{!! $purchaseorderlines->purchaseordermodel->order_number !!} -
                                            {!! $purchaseorderlines->productmodel->name !!}</span>
                                    </td>
                                    <td class="text-right">{!! $purchaseorderlines->quantity !!}</td>
                                    <td class="text-right">KSH.{!! $purchaseorderlines->unit_price !!}</td>
                                    <td class="text-right">KSH.{!! $purchaseorderlines->discount !!}</td>
                                    <td class="text-right">KSH.{!! $purchaseorderlines->total_price !!}</td>
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
                        <small>TOTAL</small> <span class="f-w-600">KSH.{!! $purchaseordersdata['data']->amount !!}</span>
                    </div>
                </div>
                <!-- end invoice-price -->
            </div>
            <!-- end invoice-content -->
            <!-- begin invoice-note -->
            <div class="invoice-note">
                * If you have any questions concerning this purchase order, contact [{!! $purchaseordersdata['company']->phone_number !!},
                {!! $purchaseordersdata['company']->email_address !!}]
            </div>
            <!-- end invoice-note -->
            <!-- begin invoice-footer -->
            <div class="invoice-footer">
                <p class="text-center m-b-5 f-w-600">
                    THANK YOU FOR YOUR BUSINESS
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>{!! $purchaseordersdata['company']->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:{!! $purchaseordersdata['company']->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> {!! $purchaseordersdata['company']->email_address !!}</span>
                </p>
            </div>
            <!-- end invoice-footer -->
        </div>
        <!-- end invoice -->
    </div>
