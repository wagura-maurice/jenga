    
@extends("admin.home")
@section("main_content")
<div id="content" class="content">
  <div class="row">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled text-white" href="{!! route('lgftomobilemoneytransfers.index') !!}">
                                    <em class="fa fa-4x fa-mobile m-b-5"></em>
                                    <br/>
                                    <span class="h4">LGF To Mobile Money</span>
                                    <br/>
                                    <small class="text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel b  bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled text-white" href="{!! route('lgftobanktransfers.index') !!}">
                                    <em class="fa fa-4x fa-university m-b-5"></em>
                                    <br/>
                                    <span class="h4">LGF To Bank</span>
                                    <br/>
                                    <small class="text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>  
                    <div class="col-lg-4">
                        <div class="panel b  bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled text-white" href="{!! route('lgftoinventorytransfers.index') !!}">
                                    <em class="fa fa-4x fa-shopping-cart m-b-5"></em>
                                    <br/>
                                    <span class="h4">LGF To Inventory</span>
                                    <br/>
                                    <small class="text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>  
                </div>
        </div>
</div>
@endsection
@section('script')
@endsection
