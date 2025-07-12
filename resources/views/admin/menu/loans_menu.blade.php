    @extends("admin.home")
    @section("main_content")
    <div id="content" class="content">
        <!--     <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Users</a></li>
        <li class="active">form</li>
    </ol>
 -->
        <!--     <h1 class="page-header">Users Update Form <small>users details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('users.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
 -->
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled text-white" href="{!! route('loans.index') !!}">
                                    <em class="fa fa-4x fa-bank m-b-5"></em>
                                    <br />
                                    <span class="h4">Loans</span>
                                    <br />
                                    <small class="text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel b  bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled text-white" href="{!! route('loanproducts.index') !!}">
                                    <em class="fa fa-4x fa-truck m-b-5"></em>
                                    <br />
                                    <span class="h4">Loan Products</span>
                                    <br />
                                    <small class="text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel b  bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled text-white" href="{!! route('guarantors.index') !!}">
                                    <em class="fa fa-4x fa-users m-b-5"></em>
                                    <br />
                                    <span class="h4">Guarantors</span>
                                    <br />
                                    <small class="text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel b  bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled text-white" href="{!! route('loanfine.index') !!}">
                                    <em class="fa fa-4x fa-map-o m-b-5"></em>
                                    <br />
                                    <span class="h4">Loan Fines</span>
                                    <br />
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