@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Sales Order Payments</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Sales Order Payments Form <small>sales order payments details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('salesorderpayments.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Sales Order Payments</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Sales Order</td>
                                            <td>				                                @foreach ($salesorderpaymentsdata['salesorders'] as $salesorders)
				                                @if( $salesorders->id  ==  $salesorderpaymentsdata['data']->sales_order  )
				                                {!! $salesorders->order_number!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($salesorderpaymentsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $salesorderpaymentsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Date</td>
                                            <td>
                                            {!! $salesorderpaymentsdata['data']->payment_date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Reference</td>
                                            <td>
                                            {!! $salesorderpaymentsdata['data']->reference !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Amount</td>
                                            <td>
                                            {!! $salesorderpaymentsdata['data']->amount !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>