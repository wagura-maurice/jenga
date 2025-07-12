@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Grace Periods</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Grace Periods Form <small>grace periods details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('graceperiods.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Grace Periods</td>
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
                                            {!! $graceperiodsdata['data']->name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Number Of Days</td>
                                            <td>
                                            {!! $graceperiodsdata['data']->number_of_days !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>