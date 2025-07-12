@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Bank Transfer Charge Scales</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Bank Transfer Charge Scales Update Form <small>bank transfer charge scales details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('banktransferchargescales.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('banktransferchargescales.update',$banktransferchargescalesdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Bank Transfer Charge" class="col-sm-3 control-label">Bank Transfer Charge</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="bank_transfer_charge" id="bank_transfer_charge">
                                            <option value="" >Select Bank Transfer Charge</option>				                                @foreach ($banktransferchargescalesdata['banktransfercharges'] as $banktransfercharges)
				                                @if( $banktransfercharges->id  ==  $banktransferchargescalesdata['data']->bank_transfer_charge  ){
				                                <option selected value="{!! $banktransfercharges->id !!}" >
								
				                                {!! $banktransfercharges->name!!}
				                                </option>@else
				                                <option value="{!! $banktransfercharges->id !!}" >
								
				                                {!! $banktransfercharges->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Minimum Amount" class="col-sm-3 control-label">Minimum Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="minimum_amount" id="minimum_amount" class="form-control" placeholder="Minimum Amount" value="{!! $banktransferchargescalesdata['data']->minimum_amount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Maximum Amount" class="col-sm-3 control-label">Maximum Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="maximum_amount" id="maximum_amount" class="form-control" placeholder="Maximum Amount" value="{!! $banktransferchargescalesdata['data']->maximum_amount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Charge Type" class="col-sm-3 control-label">Charge Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="charge_type" id="charge_type">
                                            <option value="" >Select Charge Type</option>				                                @foreach ($banktransferchargescalesdata['feetypes'] as $feetypes)
				                                @if( $feetypes->id  ==  $banktransferchargescalesdata['data']->charge_type  ){
				                                <option selected value="{!! $feetypes->id !!}" >
								
				                                {!! $feetypes->name!!}
				                                </option>@else
				                                <option value="{!! $feetypes->id !!}" >
								
				                                {!! $feetypes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Charge" class="col-sm-3 control-label">Charge</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="charge" id="charge" class="form-control" placeholder="Charge" value="{!! $banktransferchargescalesdata['data']->charge !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Bank Transfer Charge Scales
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