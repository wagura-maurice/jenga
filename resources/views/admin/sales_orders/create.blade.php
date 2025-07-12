@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Sales Orders</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Sales Orders Form <small>sales orders details goes here...</small></h1>
    <div class="row m-b-10">
        <div class="col-md-12">
            <a href="{!! route('salesorders.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
    <div class="row m-b-10">
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
                    <form id="form"  class="form-horizontal" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="col-lg-12">
                                <div class="form-group row m-b-10">
                                    <label for="Order Date" class="col-sm-3 control-label">Order Date *</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="order_date"  id="order_date" class="form-control" placeholder="Order Date" value=""  data-date-end-date="Date.default">
                                    </div>
                                    <label for="Customer Name" class="col-sm-3 control-label">Customer Name *</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="customer_name"  id="customer_name" class="form-control" placeholder="Customer Name" value="">
                                    </div>
                                </div>
                                <div class="form-group row m-b-10">                                    
                                    <label for="Customer Phone Number" class="col-sm-3 control-label">Customer Phone Number *</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="customer_phone_number"  id="customer_phone_number" class="form-control" placeholder="Customer Phone Number" value="">
                                    </div>
                                    <label for="Customer Email Address" class="col-sm-3 control-label">Customer Email Address</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="customer_email_address"  id="customer_email_address" class="form-control" placeholder="Customer Email Address" value="">
                                    </div>
                                </div>
                                <div class="form-group row m-b-10">

                                    <label for="Order Number" class="col-sm-3 control-label">Order Number *</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="order_number"  id="order_number" class="form-control" placeholder="Order Number" value="">
                                    </div>
                                    <label for="Due Date" class="col-sm-3 control-label">Due Date *</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="due_date"  id="due_date" class="form-control" placeholder="Due Date" value="">
                                    </div>
                                </div>
                                <div class="form-group row m-b-10">
                                    <label for="Store" class="col-sm-3 control-label text-right">Store *</label>
                                    <div class="col-sm-3">
                                        <select class="form-control selectpicker" onchange="getStock(this)" data-size="100000" data-live-search="true" data-style="btn-white" name="store"  id="store">
                                            <option value="" >Select Store</option>
                                            @foreach ($salesordersdata['stores'] as $stores)
                                                <option value="{!! $stores->id !!}">
                    
                                                {!! $stores->number!!}
                                                {!! $stores->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>                                      
                                    <label for="Due Date" class="col-sm-3 control-label text-right">Initiated By</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="initiated_by" id="initiated_by" placeholder="InitiatedBy" readonly value="{{ strtoupper(Auth::user()->name) }}">
                                    </div>  

                                </div>
                                <div class="form-group row m-b-10">
                                    <label for="Notes" class="col-sm-3 control-label">Notes</label>
                                    <div class="col-sm-3">
                                        <Textarea name="notes" id="notes"  class="form-control" row m-b-10="20" placeholder="Notes" value=""></textarea>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-stripped" id="orderLinesGrid">
                                        <thead>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Discount</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <td>
                                                <select class="form-control" onchange="getUnitPrice(this)" data-style="btn-white" name="product[]">
                                                    <option value="" >Select Product</option>
                                                </select>                                                
                                            </td>
                                            <td>
                                                <input type="text" name="quantity[]" onkeyup="getTotalPrice(this)" class="form-control" placeholder="Quantity" value="">                                                
                                            </td>
                                            <td>
                                                <input type="text" name="unit_price[]" class="form-control" placeholder="Unit Price" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="discount[]"  onkeyup="getTotalPrice(this)" class="form-control" placeholder="Discount" value="0">
                                            </td>
                                            <td class="text-right">
                                                <input type="hidden" name="total_price[]" class="form-control" placeholder="Total Price" value="">
                                                <strong></strong>
                                            </td>
                                            <td><button type="button" class="btn btn-primary btn-icon btn-circle" onclick="addOrderLine(this)"><i class="fa fa-plus"></i></button></td>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><strong>Totals</strong></td>
                                                <td></td>
                                                <td class="text-left" id="totalUnitPriceCell"></td>
                                                <td class="text-left" id="totalDiscountCell"></td>
                                                <td class="text-right" id="totalPriceCell"></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>                                              
                                    </table>
                                </div>                                
                                <div class="form-group row m-b-10">
                                    <div class="col-sm-offset-9 col-sm-3">
                                        <button type="button" onclick="save()" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add Sales Orders
                                        </button>
                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="javascript" type="text/javascript">
function save(){
	$("#btn-save").attr("disable",true);
	var formData = new FormData($('#form')[0]);

    if(!("#order_date") || $("#order_date").val()=='' || !$("#order_number") || $("#order_number").val()=='' || !$("#customer_name") || $("#customer_name").val()=='' || !$("#store") || $("#store").val()=='' || !$("#due_date") || $("#due_date").val()=='' || !$('#customer_phone_number') || $('#customer_phone_number').val()==''){
            $.gritter.add({
                title: 'Not allowed',
                text: 'Some of the required field are empty!!',
                sticky: false,
                time: '5000',
            });

            return false;

    }

	$.ajax({
		type:'POST',
		url: "{!! route('salesorders.store')!!}",
		data:formData,
		cache:false,
		contentType: false,
		processData: false,
		success:function(data){
		$("#btn-save").attr("disable",false);
			var obj = jQuery.parseJSON( data );
			if(obj.status=='1'){
				$.gritter.add({
					title: 'Success',
					text: obj.message,
					sticky: false,
					time: '1000',
				});
				$("#form")[0].reset();
			}else{
				$.gritter.add({
					title: 'Fail',
					text: obj.message,
					sticky: false,
					time: '5000',
				});
			}
		},error: function(data){
console.log(data)
			$.gritter.add({
				title: 'Error',
				text: 'An Error occured. Please review your data then submit again!!',
				sticky: false,
				time: '5000',
			});
		}
	});
	return false;
}

function addOrderLine(e){

    var product=$(e).closest("tr").find("select[name='product[]']").val();

    if(!product)
    {
        alert("cannot add order line! Products missing. Please select store!");
        return false;
    }


    var orderLine=$("<tr>"+
        "<td>"+
        "<select class='form-control' onchange='getUnitPrice(this)' data-style='btn-white' name='product[]' > <option value='' >Select Product</option>                                               @foreach ($salesordersdata['products'] as $products) <option value='{!! $products->id !!}'> {!! $products->name!!} </option> @endforeach </select>"+        
        "</td>"+
        "<td>"+
        "<input type='text' name='quantity[]' onkeyup='getTotalPrice(this)' class='form-control' placeholder='Quantity' value=''> "+
        "</td>"+
        "<td>"+
        "<input type='text' name='unit_price[]' class='form-control' placeholder='Unit Price' value=''>"+
        "</td>"+
        "<td>"+
        "<input type='text' name='discount[]' onkeyup='getTotalPrice(this)' class='form-control' placeholder='Discount' value='0'>"+
        "</td>"+
        "<td class='text-right'>"+
        "<input type='hidden' name='total_price[]' class='form-control' placeholder='Total Price' value=''>"+
        "<strong></strong>"+
        "</td>"+
        "<td><button type='button' onclick='removeOrderLine(this)' class='btn btn-danger btn-icon btn-circle m-b-2 m-r-2'><i class='fa fa-trash'></i></button><button type='button' class='btn btn-primary btn-icon btn-circle' onclick='addOrderLine(this)'><i class='fa fa-plus'></i></button></td>"+
        "</tr>");

    $("#orderLinesGrid tbody").append(orderLine);

}

function removeOrderLine(e){

    if($(e).closest("tr").is(":last-child")){

        $(e).closest("tr").remove();

    }else{
            $.gritter.add({
                title: 'Not allowed',
                text: 'you can only remove the last row!!',
                sticky: false,
                time: '5000',
            });        
    }

}

function getUnitPrice(e){

    var productId=$(e).val();

    $.get("{!!url('/admin/getproductbyid')!!}/"+productId, function (data) {

        var unitPrice=$(e).closest("tr").find("input[name='unit_price[]']");

        unitPrice.val(data.selling_price);

        getTotalPrice(e)

    });
}

function getStock(e){

    var storeId=$("#store").val();

    $.get("{!!url('/admin/getstockbystoreid')!!}/"+storeId, function (data) {


        $("#orderLinesGrid tbody").find("select[name='product[]']").each(function(){

            $(this).find("option").remove();

            var defaultOption=$("<option selected>Select Product</option>");

            $(this).append(defaultOption);

            for(var r=0;r<data.length; r++){

                var option=$("<option value='"+data[r].productdata.id+"'>"+data[r].productdata.name+"</option>");

                $(this).append(option);
                
            }            

        });


    });

}

    function getTotalPrice(e){

        var storeId=$("#store").val();

        var productInput=$(e).closest("tr").find("select[name='product[]']");

        var quantityInput=$(e).closest("tr").find("input[name='quantity[]']");

        var unitPriceInput=$(e).closest("tr").find("input[name='unit_price[]']");

        var discountInput=$(e).closest("tr").find("input[name='discount[]']");

        var totalPriceInput=$(e).closest("tr").find("input[name='total_price[]']");

        var quantity=Number(quantityInput.val());        

        var productId=productInput.val();

        if(quantity<=0)
        {
            return false;
        }

        $.get("{!!url('/admin/getstockbyproductidandstoreid')!!}/"+productId+"/"+storeId, function (data) {      

            if(data.size<quantity){

                alert("Available stock is less than given quantity. Please enter quantity equal to or below : "+data.size);
                $(e).val(data.size);
                quantity=Number(data.size);
            }


            var unitPrice=Number(unitPriceInput.val());

            var discount=Number(discountInput.val());

            var totalPrice=Number(totalPriceInput.val());

            totalPrice=(quantity*unitPrice)-discount;

            totalPriceInput.val(totalPrice);

            totalPriceInput.closest("td").find("strong").html(parseFloat(totalPrice).toFixed(2));

            getTotals();

        });        

    }   

    function getTotals(){

        var totalUnitAmount=0;

        var totalDiscountAmount=0;

        var totalAmount=0;

        $("#orderLinesGrid tbody tr").each(function(){
            
            var unitPriceInput=$("td:eq(2)",$(this));

            totalUnitAmount=totalUnitAmount+Number(unitPriceInput.find("input").val());

            var discountInput=$("td:eq(3)",$(this));

            totalDiscountAmount=totalDiscountAmount+Number(discountInput.find("input").val());

            var totalPriceInput=$("td:eq(4)",$(this));

            totalAmount=totalAmount+Number(totalPriceInput.find("input").val());

        });

        $("#totalDiscountCell").html("<input type='text' class='form-control' readonly value='"+totalDiscountAmount+"'/>");
        $("#totalPriceCell").html("<strong>"+parseFloat(totalAmount).toFixed(2)+"</strong>");
    }  

    function getOrderNumber(){
        
    }  




</script>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#order_date").datepicker({todayHighlight:!0,autoclose:!0}).datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", new Date());;
$("#due_date").datepicker({todayHighlight:!0,autoclose:!0}).datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", new Date());


$(document).ready(function(){
        function getOrderNumber(){
        $.get("{!!url('/admin/getsalesordernumber')!!}", function (data) {
            
            $("#order_number").val(data);

        });
    }    

    getOrderNumber(); 
});

</script>
@endsection