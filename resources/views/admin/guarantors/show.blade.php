@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Guarantors</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Guarantors Form <small>guarantors details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('guarantors.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Guarantors</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">First Name</td>
                                            <td>
                                            {!! $guarantorsdata['data']->first_name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Middle Name</td>
                                            <td>
                                            {!! $guarantorsdata['data']->middle_name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Last Name</td>
                                            <td>
                                            {!! $guarantorsdata['data']->last_name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Id Number</td>
                                            <td>
                                            {!! $guarantorsdata['data']->id_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">County</td>
                                            <td>				                                @foreach ($guarantorsdata['counties'] as $counties)
				                                @if( $counties->id  ==  $guarantorsdata['data']->county  )
				                                {!! $counties->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Sub County</td>
                                            <td>				                                @foreach ($guarantorsdata['subcounties'] as $subcounties)
				                                @if( $subcounties->id  ==  $guarantorsdata['data']->sub_county  )
				                                {!! $subcounties->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Primary Phone Number</td>
                                            <td>
                                            {!! $guarantorsdata['data']->primary_phone_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Secondary Phone Number</td>
                                            <td>
                                            {!! $guarantorsdata['data']->secondary_phone_number !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>