@extends("admin.home")
@section("main_content")
<style type="text/css">
    td div img{
        max-width: 64px;
    }
</style>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Product Client Types</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Product Client Types - DATA <small>product client types data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! url('/admin/loanapplicationproducts') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>    
    @if($loansdata['usersaccountsroles'][0]->_list==1)
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">DataTable - Autofill</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>    
                                <th>Client Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($loansdata['list'] as $productclienttypes)
                            <tr>
                                <td class='table-text'>
                                    <div>
                                        {!! $productclienttypes->clienttypemodel->name !!}
                                    </div>
                                </td>
                                <td>
                                    @if($loansdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! url('/admin/loanapplicationclients/'.$productclienttypes->loan_product.'/'.$productclienttypes->client_type) !!}" id='show-productclienttypes-{!! $productclienttypes->id !!}' class='btn btn-sm btn-circle btn-primary'>
                                            <i class='fa fa-btn fa-arrow-right'></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    @endif
@endsection
@section('script')
@endsection