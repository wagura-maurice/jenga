@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Transaction Gateways</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Transaction Gateways Update Form <small>transaction gateways details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('transactiongateways.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
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
                    <h4 class="panel-title">DataForm - Autofill</h4>
                </div>
                <div class="panel-body">
                    <form action="{!! route('transactiongateways.update',$transactiongatewaysdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{!! $transactiongatewaysdata['data']->name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Short Code" class="col-sm-3 control-label">Short Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="short_code" id="short_code" class="form-control" placeholder="Short Code" value="{!! $transactiongatewaysdata['data']->short_code !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Pass Key" class="col-sm-3 control-label">Pass Key</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="pass_key" id="pass_key" class="form-control" placeholder="Pass Key" value="{!! $transactiongatewaysdata['data']->pass_key !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Call Back Url" class="col-sm-3 control-label">Call Back Url</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="call_back_url" id="call_back_url" class="form-control" placeholder="Call Back Url" value="{!! $transactiongatewaysdata['data']->call_back_url !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Queue Time Out Url" class="col-sm-3 control-label">Queue Time Out Url</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="queue_time_out_url" id="queue_time_out_url" class="form-control" placeholder="Queue Time Out Url" value="{!! $transactiongatewaysdata['data']->queue_time_out_url !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Result Url" class="col-sm-3 control-label">Result Url</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="result_url" id="result_url" class="form-control" placeholder="Result Url" value="{!! $transactiongatewaysdata['data']->result_url !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Transaction Gateways
                                        </button>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
</script>
@endsection