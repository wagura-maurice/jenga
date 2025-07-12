@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Interest Periods</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Interest Periods Form <small>interest periods details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('interestperiods.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Interest Periods</td>
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
                                            {!! $interestperiodsdata['data']->code !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Name</td>
                                            <td>
                                            {!! $interestperiodsdata['data']->name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Number Of Days</td>
                                            <td>
                                            {!! $interestperiodsdata['data']->number_of_days !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>