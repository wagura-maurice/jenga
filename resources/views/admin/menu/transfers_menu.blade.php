    
@extends("admin.home")
@section("main_content")
<div id="content" class="content">
  <div class="row">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled text-white" href="{!! route('lgftolgftransfers.index') !!}">
                                    <em class="fa fa-4x fa-briefcase m-b-5"></em>
                                    <br/>
                                    <span class="h4">LGF To LGF Transfers</span>
                                    <br/>
                                    <small class="text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel b  bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled text-white" href="{!! route('lgftoloantransfers.index') !!}">
                                    <em class="fa fa-4x fa-balance-scale m-b-5"></em>
                                    <br/>
                                    <span class="h4">LGF To Loan Transfers</span>
                                    <br/>
                                    <small class="text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>  
                    <div class="col-lg-4">
                        <div class="panel b  bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled text-white" href="{!! route('lgftofinetransfers.index') !!}">
                                    <em class="fa fa-4x fa-gavel m-b-5"></em>
                                    <br/>
                                    <span class="h4">LGF To Fine</span>
                                    <br/>
                                    <small class="text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div> 

                    <div class="col-lg-4">
                        <div class="panel b  bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled text-white" href="{!! route('accounttoaccounttransfers.index') !!}">
                                    <em class="fa fa-4x fa-cubes m-b-5"></em>
                                    <br/>
                                    <span class="h4">Account To Account Transfers</span>
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
