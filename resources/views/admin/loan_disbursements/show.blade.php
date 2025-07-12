@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Disbursements</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Disbursements Form <small>loan disbursements details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loandisbursements.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Disbursements</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan</td>
                                            <td>				                                @foreach ($loandisbursementsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $loandisbursementsdata['data']->loan  )
				                                {!! $loans->loan_number!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Disbursement Status</td>
                                            <td>				                                @foreach ($loandisbursementsdata['disbursementstatuses'] as $disbursementstatuses)
				                                @if( $disbursementstatuses->id  ==  $loandisbursementsdata['data']->disbursement_status  )
				                                {!! $disbursementstatuses->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Date</td>
                                            <td>
                                            {!! $loandisbursementsdata['data']->date !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>