@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Banking Modes</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Banking Modes Form <small>banking modes details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('bankingmodes.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Banking Modes</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Code</td>
                                            <td>
                                            {!! $bankingmodesdata['data']->code !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Name</td>
                                            <td>
                                            {!! $bankingmodesdata['data']->name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Description</td>
                                            <td>
                                            {!! $bankingmodesdata['data']->description !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>