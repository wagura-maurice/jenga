@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Product Client Type Configurations</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Product Client Type Configurations Form <small>product client type configurations details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('productclienttypeconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Product Client Type Configurations</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan Product</td>
                                            <td>				                                @foreach ($productclienttypeconfigurationsdata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $productclienttypeconfigurationsdata['data']->loan_product  )
				                                {!! $loanproducts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Client Type</td>
                                            <td>				                                @foreach ($productclienttypeconfigurationsdata['clienttypes'] as $clienttypes)
				                                @if( $clienttypes->id  ==  $productclienttypeconfigurationsdata['data']->client_type  )
				                                {!! $clienttypes->name!!}
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