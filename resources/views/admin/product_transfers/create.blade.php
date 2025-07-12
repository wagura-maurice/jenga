@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Product Transfers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Product Transfers Form <small>product transfers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('producttransfers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form id="form"  class="form-horizontal" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Store From" class="col-sm-3 control-label">Store From</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" onchange="getStock()" required="required" name="store_from"  id="store_from">
                                            <option value="" >Select Store From</option>                
                                            @foreach ($producttransfersdata['storesfrom'] as $stores)
                                                <option value="{!! $stores->id !!}">
                    
                                                {!! $stores->number!!}
                                                {!! $stores->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>                        
                                <div class="form-group">
                                    <label for="Product" class="col-sm-3 control-label">Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control"onchange=" getStoreStock()" required="required" name="product"  id="product">
                                            <option value="" >Select Product</option>				
                                            @foreach ($producttransfersdata['products'] as $products)
				                                <option value="{!! $products->id !!}">
					
				                                {!! $products->product_number!!}
				                                {!! $products->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Size" class="col-sm-3 control-label">Available Quantity</label>
                                    <div class="col-sm-6">
                                        <input type="text"  id="available_stock" class="form-control" placeholder="Available Size" value="" readonly="">
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label for="Store To" class="col-sm-3 control-label">Store To</label>
                                    <div class="col-sm-6">
									    <select class="form-control" required="required" name="store_to"  id="store_to">
                                            <option value="" >Select Store To</option>				                                @foreach ($producttransfersdata['storesto'] as $stores)
				                                <option value="{!! $stores->id !!}">
					
				                                {!! $stores->number!!}
				                                {!! $stores->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Size" class="col-sm-3 control-label">Size</label>
                                    <div class="col-sm-6">
                                        <input type="text" required="required" name="size"onkeyup="getProductSock()" id="size" class="form-control" placeholder="Size" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="button" onclick="save()" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add Product Transfers
                                        </button>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="javascript" type="text/javascript">

function getStock(){

    var storeId=$("#store_from").val();

    $.get("{!!url('/admin/getstockbystoreid')!!}/"+storeId, function (data) {

        var product=$("#product");

        product.find("option").remove();

        var defaultOption=$("<option selected>Select Product</option>");

        product.append(defaultOption);

        for(var r=0;r<data.length; r++){

            var option=$("<option value='"+data[r].productdata.id+"'>"+data[r].productdata.name+"</option>");

            product.append(option);
            
        } 

    })   

    getStoreStock();
}      

function getStoreStock(){

    var storeId=$("#store_from").val();
    var productId=$("#product").val();

    $.get("{!!url('/admin/getstockbyproductidandstoreid')!!}/"+productId+"/"+storeId, function (data) {

        $("#available_stock").val(data.size);

        var defaultOption=$("<option selected>Select Product</option>");

        $(this).append(defaultOption);

        for(var r=0;r<data.length; r++){

            var option=$("<option value='"+data[r].productdata.id+"'>"+data[r].productdata.name+"</option>");

            $(this).append(option);
            
        } 


    })   
}    

function getProductSock(){

    var productId=$("#product").val();
    var storeId=$("#store_from").val();
    var size=Number($("#size").val());

    $.get("{!!url('/admin/getstockbyproductidandstoreid')!!}/"+productId+"/"+storeId, function (data) {

        if(size>Number(data.size)){
            alert("Sorry given size is less than available stock : "+data.size);
            $("#size").val(data.size);
        }

    });          
}

function save(){
	$("#btn-save").attr("disable",true);
	var formData = new FormData($('#form')[0]);
	$.ajax({
		type:'POST',
		url: "{!! route('producttransfers.store')!!}",
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
</script>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
</script>
@endsection