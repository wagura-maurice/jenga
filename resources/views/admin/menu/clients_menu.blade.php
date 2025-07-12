    
@extends("admin.home")
@section("main_content")
<div id="content" class="content">
<!--     <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Users</a></li>
        <li class="active">form</li>
    </ol>
 --><!--     <h1 class="page-header">Users Update Form <small>users details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('users.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
 -->    <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('clients.index') !!}">
                                    <em class="fa fa-4x fa-users m-b-5"></em>
                                    <br/>
                                    <span class="h4">Clients</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('groups.index') !!}">
                                    <em class="fa fa-4x fa-diamond m-b-5"></em>
                                    <br/>
                                    <span class="h4">Groups</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>                
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('groupclients.index') !!}">
                                    <em class="fa fa-4x fa-street-view m-b-5"></em>
                                    <br/>
                                    <span class="h4">Group Clients</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>                

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('groupclientroles.index') !!}">
                                    <em class="fa fa-4x fa-chain m-b-5"></em>
                                    <br/>
                                    <span class="h4">Group Client Roles</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('clienttypes.index') !!}">
                                    <em class="fa fa-4x fa-cubes m-b-5"></em>
                                    <br/>
                                    <span class="h4">Client Types</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>                
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('clientcategories.index') !!}">
                                    <em class="fa fa-4x fa-sitemap m-b-5"></em>
                                    <br/>
                                    <span class="h4">Client Categories</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>                

                </div>  
                <div class="row">
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('changegrouprequests.index') !!}">
                                    <em class="fa fa-4x fa-key m-b-5"></em>
                                    <br/>
                                    <span class="h4">Change Group Request</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('changetyperequests.index') !!}">
                                    <em class="fa fa-4x fa-flash m-b-5"></em>
                                    <br/>
                                    <span class="h4">Change Client Type Request</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>                
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('clientofficers.index') !!}">
                                    <em class="fa fa-4x fa-external-link m-b-5"></em>
                                    <br/>
                                    <span class="h4">Client Officers</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>                

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('grouproles.index') !!}">
                                    <em class="fa fa-4x fa-sliders m-b-5"></em>
                                    <br/>
                                    <span class="h4">Group Roles</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>  
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="#" data-toggle="modal" data-target="#QueryModal">
                                    <em class="fa fa-4x fa-search m-b-5"></em>
                                    <br/>
                                    <span class="h4">Query</span>
                                    <br/>
                                </a>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="QueryModal" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <!-- <div class="modal-header"> -->
                                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                        <!-- <h4 class="modal-title">Query Client</h4> -->
                                    <!-- </div> -->
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <!-- <label for="clientNumber">Client Number:</label> -->
                                            <input type="text" class="form-control" name="clientNumber" id="clientNumber" placeholder="ENTER CLIENT NUMBER">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>NUMBER:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="number"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>NAME:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="name"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>CATEGORY:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="category"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>GROUP:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="group"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>NATIONAL ID:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="national_id"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>PHONE NUMBER:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="phone_number"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>LGF BALANCE:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="lgf_balance"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>LGF CONTRIBUTIONS:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="lgf_contributions"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>SHARES:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="shares"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>TOTAL LOAN TAKEN:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="total_loan_taken"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>TOTAL LOAN PAID:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="total_loan_paid"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>TOTAL LOAN BALANCE:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="total_loan_balance"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>PHOTO:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="photo"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>FINGER PRINT:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="finger_print"></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <span class="col-md-6 control-label"><strong>SIGNATURE:</strong></span>
                                                <span class="col-md-6 control-label text-left" id="signature"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('clientexits.index') !!}">
                                    <em class="fa fa-4x fa-lock m-b-5"></em>
                                    <br/>
                                    <span class="h4">Exit</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class=" panel b bg-green-lighter">
                            <div class="panel-body text-center">
                                <a class="link-unstyled  text-white" href="{!! route('client.enquiry.catalog.index') !!}">
                                    <em class="fa fa-4x fa-slack m-b-5"></em>
                                    <br/>
                                    <span class="h4">Customer enquiry</span>
                                    <br/>
                                    <small class=" text-white">View all &rarr;</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                </div>
            </div>
        </div>
</div>
@endsection
@section('script')
<script>
    // setup before functions
    var typingTimer;                // timer identifier
    var doneTypingInterval = 5000;  // time in ms, 5 second for example
    var $input = $('#clientNumber');

    // on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
        // reset
        $('#number').empty();
        $('#name').empty();
        $('#category').empty();
        $('#group').empty();
        $('#national_id').empty();
        $('#phone_number').empty();
        $('#lgf_balance').empty();
        $('#lgf_contributions').empty();
        $('#shares').empty();
        $('#total_loan_taken').empty();
        $('#total_loan_paid').empty();
        $('#total_loan_balance').empty();
        $('#photo').empty();
        $('#finger_print').empty();
        $('#signature').empty();
    });

    // on keydown, clear the countdown 
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    // user is "finished typing," do something
    function doneTyping () {
        // do something
        var formData = {
            clientNumber: $("#clientNumber").val()
        };

        $.ajax({
            type: "POST",
            url: "{!! route('client.query') !!}",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            // console.log(data);
            $('#number').prepend(data.number);
            $('#name').prepend(data.name);
            $('#category').prepend(data.category);
            $('#group').prepend(data.group);
            $('#national_id').prepend(data.national_id);
            $('#phone_number').prepend(data.phone_number);
            $('#lgf_balance').prepend('KSH ' + data.lgf_balance);
            $('#lgf_contributions').prepend('KSH ' + data.lgf_contributions);
            $('#shares').prepend('KSH ' + data.shares);
            $('#total_loan_taken').prepend('KSH ' + data.total_loan_taken);
            $('#total_loan_paid').prepend('KSH ' + data.total_loan_paid);
            $('#total_loan_balance').prepend('KSH ' + data.total_loan_balance);
            $('#photo').prepend("<img src='" + data.photo + "' alt='CLIENT PHOTO'/>");
            $('#finger_print').prepend("<img src='" + data.finger_print + "' alt='CLIENT FINGER PRINT'/>");
            $('#signature').prepend("<img src='" + data.signature + "' alt='CLIENT SIGNATURE'/>");
        });

        // event.preventDefault();
    }
</script>
@endsection
