@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Stores</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Stores Form <small>stores details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('stores.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Stores</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Number</td>
                                            <td>
                                            {!! $storesdata['data']->number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Name</td>
                                            <td>
                                            {!! $storesdata['data']->name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Staff</td>
                                            <td>				                                @foreach ($storesdata['users'] as $users)
				                                @if( $users->id  ==  $storesdata['data']->staff  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Branch</td>
                                            <td>				                                @foreach ($storesdata['branches'] as $branches)
				                                @if( $branches->id  ==  $storesdata['data']->branch  )
				                                {!! $branches->name!!}
				                                @endif
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