@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Purchases</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Purchases Form <small>purchases details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('purchases.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Purchases</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Supplier</td>
                                            <td>				                                @foreach ($purchasesdata['suppliers'] as $suppliers)
				                                @if( $suppliers->id  ==  $purchasesdata['data']->supplier  )
				                                {!! $suppliers->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Product</td>
                                            <td>				                                @foreach ($purchasesdata['products'] as $products)
				                                @if( $products->id  ==  $purchasesdata['data']->product  )
				                                {!! $products->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Quantity</td>
                                            <td>
                                            {!! $purchasesdata['data']->quantity !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Purchase Date</td>
                                            <td>
                                            {!! $purchasesdata['data']->purchase_date !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>