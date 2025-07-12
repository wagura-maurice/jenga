@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Guarantors</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Guarantors Form <small>loan guarantors details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanguarantors.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Guarantors</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan</td>
                                            <td>				                                @foreach ($loanguarantorsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $loanguarantorsdata['data']->loan  )
				                                {!! $loans->loan_number!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Guarantor</td>
                                            <td>				                                @foreach ($loanguarantorsdata['guarantors'] as $guarantors)
				                                @if( $guarantors->id  ==  $loanguarantorsdata['data']->guarantor  )
				                                {!! $guarantors->id_number!!}
				                                {!! $guarantors->first_name!!}
				                                {!! $guarantors->middle_name!!}
				                                {!! $guarantors->last_name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Relationship With Guarantor</td>
                                            <td>				                                @foreach ($loanguarantorsdata['guarantorrelationships'] as $guarantorrelationships)
				                                @if( $guarantorrelationships->id  ==  $loanguarantorsdata['data']->relationship_with_guarantor  )
				                                {!! $guarantorrelationships->name!!}
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