@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Purchase Order Account Mappings</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Purchase Order Account Mappings Form <small>purchase order account mappings details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('purchaseorderaccountmappings.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Purchase Order Account Mappings</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Product</td>
                                            <td>				                                @foreach ($purchaseorderaccountmappingsdata['products'] as $products)
				                                @if( $products->id  ==  $purchaseorderaccountmappingsdata['data']->product  )
				                                {!! $products->product_number!!}
				                                {!! $products->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Debit Account</td>
                                            <td>				                                @foreach ($purchaseorderaccountmappingsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $purchaseorderaccountmappingsdata['data']->debit_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Credit Account</td>
                                            <td>				                                @foreach ($purchaseorderaccountmappingsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $purchaseorderaccountmappingsdata['data']->credit_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($purchaseorderaccountmappingsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $purchaseorderaccountmappingsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>