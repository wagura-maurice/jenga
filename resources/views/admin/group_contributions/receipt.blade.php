@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Group Contribution Receipt</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Group Contribution Receipt <small>group Contribution Receipt details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('groupcashbooks.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Date</td>
                                        <td>{!!$groupcashbooksdata['date']!!}</td>
                                        <td>Group</td>
                                        <td>{!!$groupcashbooksdata['group']!!}</td>
                                    </tr>
                                    <tr>
                                        <td>Officer</td>
                                        <td>{!!$groupcashbooksdata['bdo']!!}</td>
                                        <td>Client</td>
                                    </tr>
                                    <tr>
                                        <td>Trans ID</td>
                                        <td>{!!$groupcashbooksdata['transactionid']!!}</td>
                                        <td>Amount</td>
                                        <td>{!!$groupcashbooksdata['amount']!!}</td>
                                    </tr>
                                    <tr>
                                        <td>Mode Of Payment</td>
                                        <td>{!!$groupcashbooksdata['modeofpayment']!!}</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    	<tr class="highlight">
                                    		<th>Name</th>
                                    		<th>LGF</th>
                                            <th>LOAN</th>
                                            <th>OTHERs</th>
                                    	</tr>
                                    </thead>
                                    <tbody>
                                        @foreach($groupcashbooksdata['clients'] as $client)
                                        <tr>
                                            <td>{!!$client->first_name!!} {!!$client->middle_name!!} {!!$client->last_name!!}</td>
                                            <td>{!!$client->lgf!!}</td>
                                            <td>{!!$client->loan!!}</td>
                                            <td>{!!$client->others!!}</td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Totals</th>
                                            <th>{!!$groupcashbooksdata['totallgf']!!}</th>
                                            <th>{!!$groupcashbooksdata['totalloan']!!}</th>
                                            <th>{!!$groupcashbooksdata['totalothers']!!}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>