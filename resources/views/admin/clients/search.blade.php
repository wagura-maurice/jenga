@extends('admin.home')
@section('main_content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li><a href="javascript:;">Clients</a></li>
            <li class="active">Search Results</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Search Results <small>3 results found</small></h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <div class="result-container">
                    <!-- <form id="search_form" method="post" action="{!! url('admin/searchclient') !!}"> -->
                    <div class="input-group m-b-20">

                        {!! csrf_field() !!}

                        <input type="text" class="form-control input-white" id="search_text"
                            name="search_text"placeholder="Enter keywords here...client number or id number or any name of fullname (last_name,middle_name,first_name)"
                            onKeyDown="if(event.keyCode==13) search();" />
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-inverse" onclick="search()"><i class="fa fa-search"></i>
                                Search</button>
                            <!--                             <button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="javascript:;">Action</a></li>
                                                <li><a href="javascript:;">Another action</a></li>
                                                <li><a href="javascript:;">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="javascript:;">Separated link</a></li>
                                            </ul>
                 -->
                        </div>

                    </div>
                    <!-- </form> -->
                    <div class="dropdown pull-left">
                        <a href="javascript:;" class="btn btn-white btn-white-without-border dropdown-toggle"
                            data-toggle="dropdown">
                            Filters by <span class="caret m-l-5"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:;">Posted Date</a></li>
                            <li><a href="javascript:;">View Count</a></li>
                            <li><a href="javascript:;">Total View</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:;">Location</a></li>
                        </ul>
                    </div>
                    <div class="btn-group m-l-10 m-b-20">
                        <a href="javascript:;" class="btn btn-white btn-white-without-border"><i class="fa fa-list"></i></a>
                        <a href="javascript:;" class="btn btn-white btn-white-without-border"><i class="fa fa-th"></i></a>
                        <a href="javascript:;" class="btn btn-white btn-white-without-border"><i
                                class="fa fa-th-large"></i></a>
                    </div>
                    <!--                 <ul class="pagination pagination-without-border pull-right m-t-0">
                                    <li class="disabled"><a href="javascript:;">«</a></li>
                                    <li class="active"><a href="javascript:;">1</a></li>
                                    <li><a href="javascript:;">2</a></li>
                                    <li><a href="javascript:;">3</a></li>
                                    <li><a href="javascript:;">4</a></li>
                                    <li><a href="javascript:;">5</a></li>
                                    <li><a href="javascript:;">6</a></li>
                                    <li><a href="javascript:;">7</a></li>
                                    <li><a href="javascript:;">»</a></li>
                                </ul> -->
                    <ul class="result-list" id="result-list">
                    </ul>
                    <div class="clearfix">
                        <!--                     <ul class="pagination pagination-without-border pull-right">
                                        <li class="disabled"><a href="javascript:;">«</a></li>
                                        <li class="active"><a href="javascript:;">1</a></li>
                                        <li><a href="javascript:;">2</a></li>
                                        <li><a href="javascript:;">3</a></li>
                                        <li><a href="javascript:;">4</a></li>
                                        <li><a href="javascript:;">5</a></li>
                                        <li><a href="javascript:;">6</a></li>
                                        <li><a href="javascript:;">7</a></li>
                                        <li><a href="javascript:;">»</a></li>
                                    </ul> -->
                    </div>
                </div>
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->
@endsection
@section('script')
    <script language="javascript" type="text/javascript">
        $("#date_of_birthfrom").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
        $("#date_of_birthto").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });

        function search() {
            var formData = new FormData($('#search_form')[0]);
            var searchText = $("#search_text").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('admin/searchclient') !!}",
                data: JSON.stringify({
                    "search_text": searchText,
                    '_token': "{{ csrf_token() }}"
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    $("#result-list li").remove();
                    var list = obj.list;
                    for (var c = 0; c < list.length; c++) {
                        console.log(list[c]);
                        var client = list[c];
                        var row =
                            "<li><div class=\"result-image\"><a href=\"javascript:;\"><img src=\"{!! asset('uploads/images/' . '+client.client_photo+') !!}\" alt=\"\" onerror=\"this.src='{!! asset('uploads/images/default-user.png') !!}'\" /></a></div><div class=\"result-info\"><h4 class=\"title\"><a href=\"javascript:;\">" +
                            client.first_name + " " + client.middle_name + " " + client.last_name +
                            "</a></h4><p class=\"location\">" + client.client_number +
                            "</p><p class=\"desc\">" + client.id_number +
                            "</p><div class=\"btn-row\"><a href=\"javascript:;\" data-toggle=\"tooltip\" data-container=\"body\" data-title=\"Analytics\"><i class=\"fa fa-fw fa-bar-chart-o\"></i></a><a href=\"javascript:;\" data-toggle=\"tooltip\" data-container=\"body\" data-title=\"Tasks\"><i class=\"fa fa-fw fa-tasks\"></i></a><a href=\"javascript:;\" data-toggle=\"tooltip\" data-container=\"body\" data-title=\"Configuration\"><i class=\"fa fa-fw fa-cog\"></i></a><a href=\"javascript:;\" data-toggle=\"tooltip\" data-container=\"body\" data-title=\"Performance\"><i class=\"fa fa-fw fa-tachometer\"></i></a><a href=\"javascript:;\" data-toggle=\"tooltip\" data-container=\"body\" data-title=\"Users\"><i class=\"fa fa-fw fa-user\"></i></a></div></div></li>";
                        $("#result-list").append(row);
                    }
                    console.log(obj);
                },
                error: function(data) {

                }
            });

        }
    </script>
@endsection
