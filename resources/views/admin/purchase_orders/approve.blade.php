@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Purchase Orders</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Purchase Orders Update Form <small>purchase orders details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('purchaseorders.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('purchaseorders.update',$purchaseordersdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                        <div class="col-lg-12">
                                <div class="form-group row m-b-10">
                                    <label for="Order Number" class="col-sm-3 control-label text-right">Order Number</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="order_number"  id="order_number" class="form-control" readonly placeholder="Order Number" value="{!! $purchaseordersdata['data']->order_number !!}">
                                    </div>
                                    <label for="Supplier" class="col-sm-3 control-label text-right">Supplier</label>
                                    <div class="col-sm-3">
                                        <select class="form-control selectpicker" disabled data-size="100000" data-live-search="true" data-style="btn-white" name="supplier"  id="supplier">
                                            <option value="" >Select Supplier</option>
                                            @foreach ($purchaseordersdata['suppliers'] as $suppliers)
                                                @if( $suppliers->id  ==  $purchaseordersdata['data']->supplier  ){
                                                <option selected value="{!! $suppliers->id !!}" >
                                
                                                {!! $suppliers->name!!}
                                                </option>@else
                                                <option value="{!! $suppliers->id !!}" >
                                
                                                {!! $suppliers->name!!}
                                                </option>@endif
                                                @endforeach
                                            </select>
                                    </div>
                                </div>                                
                                <div class="form-group row m-b-10">
                                    <label for="Order Date" class="col-sm-3 control-label text-right">Order Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="order_date"  id="order_date" class="form-control" placeholder="Order Date" readonly  value="{!! $purchaseordersdata['data']->order_date !!}">
                                    </div>
                                    <label for="Due Date" class="col-sm-3 control-label text-right">Due Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="due_date"  id="due_date" class="form-control" placeholder="Due Date" readonly  value="{!! $purchaseordersdata['data']->due_date !!}">
                                    </div>
                                </div>
                                <div class="form-group row m-b-10">
                                    <label for="Store" class="col-sm-3 control-label text-right">Store</label>
                                    <div class="col-sm-3">
                                        <select class="form-control selectpicker" disabled data-size="100000" data-live-search="true" data-style="btn-white" name="store"  id="store">
                                            <option value="" >Select Store</option>                                             @foreach ($purchaseordersdata['stores'] as $stores)

                                                @if( $stores->id  ==  $purchaseordersdata['data']->store  ){
                                                <option selected value="{!! $suppliers->id !!}" >
                            
                                                {!! $stores->number!!} - 
                                                {!! $stores->name!!}
                                                </option>@else
                                                <option value="{!! $stores->id !!}" >
                                                {!! $stores->number!!} - 
                                                {!! $stores->name!!}
                                                </option>@endif                                                
                                                @endforeach
                                        </select>
                                    </div>                                   
                                    <label for="Due Date" class="col-sm-3 control-label text-right">Initiated By</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="initiated_by" id="initiated_by" placeholder="InitiatedBy" readonly value="{!! $purchaseordersdata['data']->initiatedBy !!}">
                                    </div>                                          
                                </div>
                                <div class="form-group row m-b-20">
                                    <label for="Notes" class="col-sm-3 control-label text-right">Order Status</label>
                                    <div class="col-sm-3">
                                        <input type="text" readonly="" name="notes"  readonly  id="notes"  class="form-control" row="20" placeholder="Notes" value="{!! $purchaseordersdata['data']->orderstatusmodel->name !!}"/>
                                    </div>    
                                    <label for="Notes" class="col-sm-3 control-label text-right">Approval Status</label>
                                    <div class="col-sm-3">
                                        <input type="text" readonly="" name="notes"  readonly  id="notes"  class="form-control" row="20" placeholder="Notes" value="{!! $purchaseordersdata['data']->approvalstatusmodel->name !!}"/>
                                    </div>    
                                </div>
                                <div class="form-group row m-b-20">                                                                     
                                    <label for="Notes" class="col-sm-3 control-label text-right">Notes</label>
                                    <div class="col-sm-3">
                                        <Textarea name="notes"  readonly  id="notes"  class="form-control" row="20" placeholder="Notes" value="">{!! $purchaseordersdata['data']->notes !!}</textarea>
                                    </div>                               
                                </div>                            
                        </div>
                    </form>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Discount</th>
                                        <th>Total Price</th>
                                                                         </tr>
                        </thead>
                        <tbody>
                        @foreach ($purchaseordersdata['orderlines'] as $purchaseorderlines)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $purchaseorderlines->productmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $purchaseorderlines->quantity !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $purchaseorderlines->unit_price !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $purchaseorderlines->discount !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $purchaseorderlines->total_price !!}
                                </div></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        
                    </div>

                </div>     
                @if(isset($purchaseordersdata['otherapprovals']) && count($purchaseordersdata['otherapprovals'])>0)
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Approval Level</th>
                                        <th>User</th>
                                        <th>Approval Status</th>
                                        <th>Remarks</th>
                                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($purchaseordersdata['otherapprovals'] as $purchaseorderapprovals)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $purchaseorderapprovals[0]->approvallevelmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $purchaseorderapprovals[0]->usermodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $purchaseorderapprovals[0]->approvalstatusmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $purchaseorderapprovals[0]->remarks !!}
                                </div></td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>                 
                @endif                          

                @if(isset($purchaseordersdata['mymapping']) && isset($purchaseordersdata['myturn']) && $purchaseordersdata['data']->approvalstatusmodel->code=='003')
                <div class="panel-body">
                    <form id="form"  class="form-horizontal" enctype="multipart/form-data" method="post" action="{!! url('/admin/purchaseorderapproval') !!}/{!! $purchaseordersdata['data']->id!!}">
                        {!! csrf_field() !!}
                                <input type="hidden" name="purchase_order" value="{!! $purchaseordersdata['data']->id !!}">
                                <div class="form-group">
                                    <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly name="approval_level"  id="approval_level" class="form-control" placeholder="Approval Level" value="{!! $purchaseordersdata['mymapping']->approvallevelmodel->name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="User" class="col-sm-3 control-label">User</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly name="user"  id="user" class="form-control" placeholder="User" value="{{ strtoupper(Auth::user()->name) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="User" class="col-sm-3 control-label">Remarks</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" name="remarks">
                                            
                                        </textarea>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label for="Approval Status" class="col-sm-3 control-label">Approval Status</label>
                                    <div class="col-sm-6">
                                        <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_status"  id="approval_status">
                                            <option value="" >Select Approval Status</option>                                               @foreach ($purchaseordersdata['approvalstatuses'] as $approvalstatuses)
                                                <option value="{!! $approvalstatuses->id !!}">
                    
                                                {!! $approvalstatuses->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add Purchase Order Approvals
                                        </button>
                                    </div>
                                </div>
                    </form>
                </div>                
                @endif 

            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#order_date").datepicker({todayHighlight:!0,autoclose:!0});
$("#due_date").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection