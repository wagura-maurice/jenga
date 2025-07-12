@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Products</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Products Form <small>products details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('products.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                                    <label for="Product Number" class="col-sm-3 control-label">Product Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" required name="product_number" id="product_number" class="form-control" placeholder="Product Number">
                                    </div>
                                </div>                                                
                                <div class="form-group">
                                    <label for="Name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" required  id="name" class="form-control" placeholder="Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Category" class="col-sm-3 control-label">Category</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" required data-size="100000" data-live-search="true" data-style="btn-white" name="category"  id="category">
                                            <option value="" >Select Category</option>				                                @foreach ($productsdata['productcategories'] as $productcategories)
				                                <option value="{!! $productcategories->id !!}">
					
				                                {!! $productcategories->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Brand" class="col-sm-3 control-label">Brand</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" required data-size="100000" data-live-search="true" data-style="btn-white" name="brand"  id="brand">
                                            <option value="" >Select Brand</option>				                                @foreach ($productsdata['productbrands'] as $productbrands)
				                                <option value="{!! $productbrands->id !!}">
					
				                                {!! $productbrands->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Description" class="col-sm-3 control-label">Description</label>
                                    <div class="col-sm-6">
                                        <Textarea name="description" id="description"  class="form-control" row="20" placeholder="Description" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Buying Price" class="col-sm-3 control-label">Buying Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="buying_price" onchange="getMargin()" required  id="buying_price" class="form-control" placeholder="Buying Price" value="">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label for="Selling Price" class="col-sm-3 control-label">Selling Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="selling_price" onchange="getMargin()" required  id="selling_price" class="form-control" placeholder="Price" value="">
                                    </div>
                                </div>  

                                <div class="form-group">
                                    <label for="Margin" class="col-sm-3 control-label">Margin</label>
                                    <div class="col-sm-6">
                                        <input type="text"  readonly id="_margin" class="form-control" placeholder="margin" value="">
                                        <input type="hidden" name="margin" required  id="margin" class="form-control" placeholder="margin" value="">
                                    </div>
                                </div>                                                                                               
                                <div class="form-group">
                                    <label for="Reproduct Level" class="col-sm-3 control-label">Reorder Level</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="reorder_level"  id="reproduct_level" class="form-control" placeholder="Reorder Level" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Reproduct Quantity" class="col-sm-3 control-label">Reorder Quantity</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="reorder_quantity"  id="reproduct_quantity" class="form-control" placeholder="Reorder Quantity" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Other Details" class="col-sm-3 control-label">Other Details</label>
                                    <div class="col-sm-6">
                                        <Textarea name="other_details" id="other_details"  class="form-control" row="20" placeholder="Other Details" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="button" onclick="save()" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add Products
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
function save(){

	$("#btn-save").attr("disable",true);

	var formData = new FormData($('#form')[0]);

	$.ajax({
		type:'POST',
		url: "{!! route('products.store')!!}",
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

function getMargin(){
    var buyingPrice=Number($("#buying_price").val());
    var sellingPrice=Number($("#selling_price").val());

    $("#_margin").val(sellingPrice-buyingPrice);
    $("#margin").val(sellingPrice-buyingPrice);
}

</script>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$(document).ready(function(){
        function getproductNumber(){
        $.get("{!!url('/admin/getproductnumber')!!}", function (data) {
            
            $("#product_number").val(data);

        });
    }    

    getproductNumber(); 
});

</script>
@endsection