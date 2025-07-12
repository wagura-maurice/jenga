@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Product Stocks</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Product Stocks Form <small>product stocks details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('productstocks.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Product Stocks</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Product</td>
                                            <td>				                                @foreach ($productstocksdata['products'] as $products)
				                                @if( $products->id  ==  $productstocksdata['data']->product  )
				                                {!! $products->product_number!!}
				                                {!! $products->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Store</td>
                                            <td>				                                @foreach ($productstocksdata['stores'] as $stores)
				                                @if( $stores->id  ==  $productstocksdata['data']->store  )
				                                {!! $stores->number!!}
				                                {!! $stores->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Size</td>
                                            <td>
                                            {!! $productstocksdata['data']->size !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>