@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Next Of Kin Relationships</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Next Of Kin Relationships Form <small>next of kin relationships details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('nextofkinrelationships.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Next Of Kin Relationships</td>
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
                                            {!! $nextofkinrelationshipsdata['data']->code !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Name</td>
                                            <td>
                                            {!! $nextofkinrelationshipsdata['data']->name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Description</td>
                                            <td>
                                            {!! $nextofkinrelationshipsdata['data']->description !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>