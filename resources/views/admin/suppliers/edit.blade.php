@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Suppliers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Suppliers Update Form <small>suppliers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('suppliers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('suppliers.update',$suppliersdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{!! $suppliersdata['data']->name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Phone Number" class="col-sm-3 control-label">Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone_number" id="phone_number"  placeholder="(999) 999-9999" class="form-control" placeholder="Phone Number" value="{!! $suppliersdata['data']->phone_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Email Address" class="col-sm-3 control-label">Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email_address"  class="form-control" placeholder="Email Address" value="{!! $suppliersdata['data']->email_address !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Code" class="col-sm-3 control-label">Postal Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Postal Code" value="{!! $suppliersdata['data']->postal_code !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Postal Address" class="col-sm-3 control-label">Postal Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="postal_address" id="postal_address" class="form-control" placeholder="Postal Address" value="{!! $suppliersdata['data']->postal_address !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Street" class="col-sm-3 control-label">Street</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="street" id="street" class="form-control" placeholder="Street" value="{!! $suppliersdata['data']->street !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Town" class="col-sm-3 control-label">Town</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="town" id="town" class="form-control" placeholder="Town" value="{!! $suppliersdata['data']->town !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Contact Person Name" class="col-sm-3 control-label">Contact Person Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="contact_person_name" id="contact_person_name" class="form-control" placeholder="Contact Person Name" value="{!! $suppliersdata['data']->contact_person_name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Contact Person Phone Number" class="col-sm-3 control-label">Contact Person Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="contact_person_phone_number" id="contact_person_phone_number" class="form-control" placeholder="Contact Person Phone Number" value="{!! $suppliersdata['data']->contact_person_phone_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Contact Person Email Address" class="col-sm-3 control-label">Contact Person Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="contact_person_email_address" id="contact_person_email_address" class="form-control" placeholder="Contact Person Email Address" value="{!! $suppliersdata['data']->contact_person_email_address !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Suppliers
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
$("#phone_number").mask("(999) 999-9999");
</script>
@endsection