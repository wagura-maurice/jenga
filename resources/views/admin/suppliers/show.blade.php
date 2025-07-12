@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Suppliers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Suppliers Form <small>suppliers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('suppliers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Suppliers</td>
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
                                            {!! $suppliersdata['data']->name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Phone Number</td>
                                            <td>
                                            {!! $suppliersdata['data']->phone_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Email Address</td>
                                            <td>
                                            {!! $suppliersdata['data']->email_address !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Postal Code</td>
                                            <td>
                                            {!! $suppliersdata['data']->postal_code !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Postal Address</td>
                                            <td>
                                            {!! $suppliersdata['data']->postal_address !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Street</td>
                                            <td>
                                            {!! $suppliersdata['data']->street !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Town</td>
                                            <td>
                                            {!! $suppliersdata['data']->town !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Contact Person Name</td>
                                            <td>
                                            {!! $suppliersdata['data']->contact_person_name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Contact Person Phone Number</td>
                                            <td>
                                            {!! $suppliersdata['data']->contact_person_phone_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Contact Person Email Address</td>
                                            <td>
                                            {!! $suppliersdata['data']->contact_person_email_address !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>