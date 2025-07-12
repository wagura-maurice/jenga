@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Sales Order Account Mappings</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Sales Order Account Mappings Form <small>sales order account mappings details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('salesorderaccountmappings.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Sales Order Account Mappings</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Product</td>
                                            <td>				                                @foreach ($salesorderaccountmappingsdata['products'] as $products)
				                                @if( $products->id  ==  $salesorderaccountmappingsdata['data']->product  )
				                                {!! $products->product_number!!}
				                                {!! $products->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($salesorderaccountmappingsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $salesorderaccountmappingsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Debit Account</td>
                                            <td>				                                @foreach ($salesorderaccountmappingsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $salesorderaccountmappingsdata['data']->debit_account  )
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Credit Account</td>
                                            <td>				                                @foreach ($salesorderaccountmappingsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $salesorderaccountmappingsdata['data']->credit_account  )
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
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