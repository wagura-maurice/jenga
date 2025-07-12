@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Product Approval Levels</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Product Approval Levels Form <small>loan product approval levels details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanproductapprovallevels.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Product Approval Levels</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan Product</td>
                                            <td>				                                @foreach ($loanproductapprovallevelsdata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $loanproductapprovallevelsdata['data']->loan_product  )
				                                {!! $loanproducts->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Level</td>
                                            <td>				                                @foreach ($loanproductapprovallevelsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $loanproductapprovallevelsdata['data']->level  )
				                                {!! $approvallevels->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">User Account</td>
                                            <td>				                                @foreach ($loanproductapprovallevelsdata['usersaccounts'] as $usersaccounts)
				                                @if( $usersaccounts->id  ==  $loanproductapprovallevelsdata['data']->user_account  )
				                                {!! $usersaccounts->name!!}
				                                </option>@endif
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