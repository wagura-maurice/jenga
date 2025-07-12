@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Purchase Order Lines</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Purchase Order Lines Form <small>purchase order lines details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('purchaseorderlines.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Purchase Order Lines</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Purchase Order</td>
                                            <td>				                                @foreach ($purchaseorderlinesdata['purchaseorders'] as $purchaseorders)
				                                @if( $purchaseorders->id  ==  $purchaseorderlinesdata['data']->purchase_order  )
				                                {!! $purchaseorders->order_number!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Product</td>
                                            <td>				                                @foreach ($purchaseorderlinesdata['products'] as $products)
				                                @if( $products->id  ==  $purchaseorderlinesdata['data']->product  )
				                                {!! $products->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Quantity</td>
                                            <td>
                                            {!! $purchaseorderlinesdata['data']->quantity !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Unit Price</td>
                                            <td>
                                            {!! $purchaseorderlinesdata['data']->unit_price !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Discount</td>
                                            <td>
                                            {!! $purchaseorderlinesdata['data']->discount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Total Price</td>
                                            <td>
                                            {!! $purchaseorderlinesdata['data']->total_price !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>