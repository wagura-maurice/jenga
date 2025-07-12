@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Documents</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Documents Form <small>loan documents details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loandocuments.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Documents</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan</td>
                                            <td>				                                @foreach ($loandocumentsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $loandocumentsdata['data']->loan  )
				                                {!! $loans->loan_number!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Document</td>
                                            <td><img src="{!!asset('uploads/images/'.$loandocumentsdata['data']->document)!!}" width='164' height='164'/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>