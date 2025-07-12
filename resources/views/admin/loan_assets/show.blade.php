@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Assets</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Assets Form <small>loan assets details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanassets.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Assets</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan</td>
                                            <td>				                                @foreach ($loanassetsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $loanassetsdata['data']->loan  )
				                                {!! $loans->loan_number!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Asset</td>
                                            <td>				                                @foreach ($loanassetsdata['products'] as $products)
				                                @if( $products->id  ==  $loanassetsdata['data']->asset  )
				                                {!! $products->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Quantity</td>
                                            <td>
                                            {!! $loanassetsdata['data']->quantity !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>