@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Products</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Products Form <small>products details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('products.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Products</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Name</td>
                                            <td>
                                            {!! $productsdata['data']->name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Category</td>
                                            <td>				                                @foreach ($productsdata['productcategories'] as $productcategories)
				                                @if( $productcategories->id  ==  $productsdata['data']->category  )
				                                {!! $productcategories->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Brand</td>
                                            <td>				                                @foreach ($productsdata['productbrands'] as $productbrands)
				                                @if( $productbrands->id  ==  $productsdata['data']->brand  )
				                                {!! $productbrands->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Description</td>
                                            <td>
                                            {!! $productsdata['data']->description !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Reorder Level</td>
                                            <td>
                                            {!! $productsdata['data']->reorder_level !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Reorder Quantity</td>
                                            <td>
                                            {!! $productsdata['data']->reorder_quantity !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Other Details</td>
                                            <td>
                                            {!! $productsdata['data']->other_details !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>