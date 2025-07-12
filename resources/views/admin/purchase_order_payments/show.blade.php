@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Purchase Order Payments</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Purchase Order Payments Form <small>purchase order payments details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('purchaseorderpayments.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Purchase Order Payments</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Purchase Order</td>
                                            <td>				                                @foreach ($purchaseorderpaymentsdata['purchaseorders'] as $purchaseorders)
				                                @if( $purchaseorders->id  ==  $purchaseorderpaymentsdata['data']->purchase_order  )
				                                {!! $purchaseorders->order_number!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($purchaseorderpaymentsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $purchaseorderpaymentsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Date</td>
                                            <td>
                                            {!! $purchaseorderpaymentsdata['data']->payment_date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Amount</td>
                                            <td>
                                            {!! $purchaseorderpaymentsdata['data']->amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Reference</td>
                                            <td>
                                            {!! $purchaseorderpaymentsdata['data']->reference !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>