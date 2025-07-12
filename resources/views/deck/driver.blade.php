@extends('admin.home')

@section('main_content')	
		
		<!-- begin #content -->
		<div id="content" class="content">

			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Caterpillar</a></li>
				<li class="active">Deck</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Driver Panel <small>create module here...</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->	
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-md-12">

                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Database Configuration</h4>
                        </div>
                        <div class="panel-body ">
                            <form class="form-horizontal" id="database_form">

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Server</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="server" id="server" class="form-control" placeholder="ex: localhost" value="localhost"  />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Datebase</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="database" id="database" class="form-control" placeholder="ex: school_db" value="microfinance_v1"  />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Username</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="username" id="username" class="form-control" placeholder="ex: root"  value="root" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Password</label>
									<div class="col-md-6 m-t-10">
										<input type="password" name="password" id="password" class="form-control" placeholder="ex: mypass"  value="Database@2020"/>
									</div>
								</div>
								<div class="form-group">
									
									<div class="col-md-6 m-t-10">
										<input type="hidden" class="form-control" placeholder="" name="script" id="script"/>
									</div>
								</div>

							</form>
							<form id="model_form">
								<div class="form-group">
									
									<div class="col-md-6 m-t-10">
										<input type="hidden" class="form-control" placeholder="" name="model_script" id="model_script"/>

										<input type="hidden" class="form-control" placeholder="" name="model_name" id="model_name"/>

									</div>
								</div>
								
							</form>
							<form id="controller_form">
									<input type="hidden" class="form-control" placeholder="" name="controller_script" id="controller_script"/>

									<input type="hidden" class="form-control" placeholder="" name="controller_name" id="controller_name"/>
								
							</form>
							<form id="table_form">
									<input type="hidden" class="form-control" placeholder="" name="header_script" id="header_script"/>

									<input type="hidden" class="form-control" placeholder="" name="row_name" id="row_name"/>

									<input type="hidden" class="form-control" placeholder="" name="row_field_names" id="row_field_names"/>

									<input type="hidden" class="form-control" placeholder="" name="row_input_cased_name" id="row_input_cased_name"/>


									<input type="hidden" class="form-control" placeholder="" name="row_parents" id="row_parents"/>


									<input type="hidden" class="form-control" placeholder="" name="table_name" id="table_name"/>

									<input type="hidden" class="form-control" placeholder="" name="module_table_name" id="module_table_name"/>

									<input type="hidden" class="form-control" placeholder="" name="table_module_name" id="table_module_name"/>								

									<input type="hidden" class="form-control" placeholder="" name="row_index_types" id="row_index_types"/>

									<input type="hidden" class="form-control" placeholder="" name="row_index_values" id="row_index_values"/>

									<input type="hidden" class="form-control" placeholder="" name="row_keys" id="row_keys"/>
									<input type="hidden" class="form-control" placeholder="" name="row_is_requireds" id="row_is_requireds"/>
									<input type="hidden" class="form-control" placeholder="" name="row_input_types" id="row_input_types"/>

									<input type="hidden" class="form-control" placeholder="" name="row_field_sections" id="row_field_sections"/>

									<input type="hidden" class="form-control" placeholder="" name="row_field_sections_description" id="row_field_sections_description"/>	

									<input type="hidden" class="form-control" placeholder="" name="row_form_type" id="row_form_type"/>

									<input type="hidden" class="form-control" placeholder="" name="row_sections_name" id="row_sections_name"/>

									<input type="hidden" class="form-control" placeholder="" name="row_sections_description" id="row_sections_description"/>

								
							</form>							
							<form id="form_form">
									<input type="hidden" class="form-control" placeholder="" name="form_script" id="form_script"/>

									<input type="hidden" class="form-control" placeholder="" name="field_names" id="field_names"/>

									<input type="hidden" class="form-control" placeholder="" name="input_cased_name" id="input_cased_name"/>

									<input type="hidden" class="form-control" placeholder="" name="keys" id="keys"/>
									<input type="hidden" class="form-control" placeholder="" name="is_requireds" id="is_requireds"/>

									<input type="hidden" class="form-control" placeholder="" name="values" id="values"/>

									<input type="hidden" class="form-control" placeholder="" name="parent_modules" id="parent_modules"/>

									<input type="hidden" class="form-control" placeholder="" name="index_types" id="index_types"/>

									<input type="hidden" class="form-control" placeholder="" name="field_types" id="field_types"/>

									<input type="hidden" class="form-control" placeholder="" name="form_name" id="form_name"/>

									<input type="hidden" class="form-control" placeholder="" name="module_form_name" id="module_form_name"/>	

									<input type="hidden" class="form-control" placeholder="" name="form_module_name" id="form_module_name"/>							

									<input type="hidden" class="form-control" placeholder="" name="input_types" id="input_types"/>

									<input type="hidden" class="form-control" placeholder="" name="field_sections" id="field_sections"/>

									<input type="hidden" class="form-control" placeholder="" name="field_sections_description" id="field_sections_description"/>	

									<input type="hidden" class="form-control" placeholder="" name="form_type" id="form_type"/>

									<input type="hidden" class="form-control" placeholder="" name="sections_name" id="sections_name"/>

									<input type="hidden" class="form-control" placeholder="" name="sections_description" id="sections_description"/>

								
							</form>								
							<form id="report_form">
									<input type="hidden" class="form-control" placeholder="" name="report_header_script" id="report_header_script"/>

									<input type="hidden" class="form-control" placeholder="" name="report_script" id="report_script"/>

									<input type="hidden" class="form-control" placeholder="" name="report_row_name" id="report_row_name"/>									

									<input type="hidden" class="form-control" placeholder="" name="report_name" id="report_name"/>

									<input type="hidden" class="form-control" placeholder="" name="module_report_name" id="module_report_name"/>

									<input type="hidden" class="form-control" placeholder="" name="report_module_name" id="report_module_name"/>
									<input type="hidden" class="form-control" placeholder="" name="report_row_index_types" id="report_row_index_types"/>

									<input type="hidden" class="form-control" placeholder="" name="report_row_index_values" id="report_row_index_values"/>

									<input type="hidden" class="form-control" placeholder="" name="report_row_field_names" id="report_row_field_names"/>									
									<input type="hidden" class="form-control" placeholder="" name="report_row_input_types" id="report_row_input_types"/>

								
							</form>				

							<form id="menu_form">
									<input type="hidden" class="form-control" placeholder="" name="url" id="url"/>

									<input type="hidden" class="form-control" placeholder="" name="menu" id="menu"/>
									<input type="hidden" class="form-control" placeholder="" name="menu_controller" id="menu_controller"/>
								
							</form>								
                        </div>
                    </div>
                    <!-- end panel -->


                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Module Details</h4>
                        </div>
                        <div class="panel-body ">

                        	<form id="usersaccountsroles_form">
                        		{!! csrf_field() !!}
                        		<input type="hidden" name="module_name" id="usr_module_name" />
                        		<input type="hidden" name="user_account" value="{{$driversdata['usersaccounts'][0]->id}}"/>
                        		<input type="hidden" name="_add" value="1"/>
                        		<input type="hidden" name="_list" value="1"/>
                        		<input type="hidden" name="_edit" value="1"/>
                        		<input type="hidden" name="_delete" value="1"/>
                        		<input type="hidden" name="_show" value="1"/>
                        		<input type="hidden" name="_report" value="1"/>

                        	</form>
                            <form class="form-horizontal" id="modules_form">
                            	{{ csrf_field() }}
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Parent Name</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="parent_name" id="parent_name" class="form-control" placeholder="ex: User Management"  />
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Module Name (plural)</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="_name" id="module_name" class="form-control" placeholder="ex: Users"  />
										<input type="hidden" name="name" id="_module_name" class="form-control" placeholder="ex: Users"  />

									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Description</label>
									<div class="col-md-6 m-t-10">
										<textarea class="form-control" name="description" id="module_description" placeholder="ex : Basic User Details" rows="3"></textarea>

									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Is Idepented</label>
									<div class="col-md-6 m-t-10">
										<input type="checkbox" value="1" name="is_indepented" />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Parent</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control" name="module_parent" id="module_parent">
                                            <option value="" >Select Parent</option>
                                        </select>										
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Add To Dashboard</label>
									<div class="col-md-6 m-t-10">
										<input type="checkbox" value="1" name="dashboard" />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Notify When Added/Updated</label>
									<div class="col-md-6 m-t-10">
										<input type="checkbox" value="1" name="notification"  />
									</div>
								</div>

								
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Notification Title</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="notification_title" id="notification_title" class="form-control" placeholder="ex: User Registration" />
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Notification Description</label>
									<div class="col-md-6 m-t-10">
										<textarea class="form-control" placeholder="ex: New User was Registered..." rows="3" name="notification_description" id="notification_description"></textarea>
									</div>
								</div>																			

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Form Type</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control"onchange="formType()" name="_form_type" id="_form_type">
                                            <option value="" >Select Type</option>
                                            <option value="single_form" >Single Form</option>
                                            <option value="wizard" >Wizard</option>
                                        </select>										
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Completion Message</label>
									<div class="col-md-6 m-t-10">
										<textarea class="form-control" disabled="disabled" placeholder="ex : Please Review You Details then click the button below" name="completion_message" id="completion_message" rows="3"></textarea>

									</div>
								</div>								

							</form>
                        </div>
                    </div>
                    <!-- end panel -->

                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Wizard Details</h4>
                        </div>
                        <div class="panel-body ">
                            <form class="form-horizontal" id="_sections_form">
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Section Name</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="section_name" id="section_name" class="form-control" placeholder="ex : Basic Details " />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Description</label>
									<div class="col-md-6 m-t-10">
										<textarea class="form-control" name="section_description" id="section_description" placeholder="ex : Basic User Details" rows="3"></textarea>

									</div>
								</div>
							
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10"></label>
									<div class="col-md-6 m-t-10">
									    <button type="button" id="add_section" onclick="addSection()" class="btn btn-sm btn-primary">Add Section</button>
									</div>
								</div>								
							</form>
                        </div>
                    </div>
                    <!-- end panel -->


                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Module Fields</h4>
                        </div>
                        <div class="panel-body ">
                            <form class="form-horizontal" id="fields_form">
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Field Name</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="field_name" id="field_name" class="form-control" placeholder="ex : First Name" />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Field Type</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control" onchange="fieldType()" id="field_type" name="field_type">
                                            <option value="" >Select Type</option>
                                            <option value="string">String</option>
                                            <option value="int">Integer</option>
                                            <option value="decimal">Decimal</option>
                                            <option value="boolean">Boolean</option>
                                        </select>										
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Is Required</label>
									<div class="col-md-6 m-t-10">
										<input type="checkbox" value="1" name="is_required" id="is_required" />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Is Index</label>
									<div class="col-md-6 m-t-10">
										<input type="checkbox" value="1" name="is_index" onchange="enableIndex()" id="is_index" />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Index Type</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control" disabled name="index_type" id="index_type" onchange="enableParentModules()">
                                            <option value="" >Select Index</option>
                                            <option value="unique_key">Unique Key</option>
                                            <option value="foreign_key">Foreign key</option>
                                        </select>										
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Parent Module</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control" disabled name="parent_module" id="parent_module">
                                            <option value="" >Select Parent</option>
				                                @foreach ($driversdata['modules'] as $module)
				                                <option value="{{ $module->name }}">{{ $module->name }}</option>
				                                @endforeach                                            
                                        </select>										
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Parent Module Table</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="parent_module_table" id="parent_module_table" class="form-control" placeholder="table" value="" />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Key(id)</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="key" id="key" class="form-control" placeholder="id" value="id" />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Value(comma seperated)</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="value" id="value" class="form-control" placeholder="ex: value 1,value 2" value="" />
									</div>
								</div>



								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Input Type</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control" id="input_type" name="input_type">
                                            <option value="" >Select Type</option>
                                            <option value="text">Text</option>
                                            <option value="date">Date</option>
                                            <option value="time">Time</option>
                                            <option value="phonenumber">Phone Number</option>
                                            <option value="emailaddress">Email Address</option>
                                            <option value="select">Select</option>
                                            <option value="image">Image</option>
                                            <option value="file">File</option>
                                            <option value="textarea">Textarea</option>
                                            <option value="checkbox">Check Box</option>
                                        </select>										
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Section</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control" id="field_section" name="field_section">
                                            <option value="" >Select Section</option>
                                        </select>										
									</div>
								</div>

								

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10"></label>
									<div class="col-md-6 m-t-10">
									    <button type="button" id="add_field" name="add_field" onclick="addField()" class="btn btn-sm btn-primary">Add Field</button>
									</div>
								</div>

							</form>
                        </div>
                    </div>
                    <!-- end panel -->


		        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Fields</h4>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Field Name</th>
                                        <th>Field Type</th>
                                        <th>Is Index</th>
                                        <th>Index Type</th>
                                        <th>Parent Module</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="fields_tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->                    

                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Module Chart</h4>
                        </div>
                        <div class="panel-body ">
                            <form class="form-horizontal" id="chart_form">
                            	<input type="hidden" class="form-control" placeholder="" name="chart_module_name" id="chart_module_name"/>

                            	<input type="hidden" class="form-control" placeholder="" name="chart_script" id="chart_script"/>

								<input type="hidden" class="form-control" placeholder="" name="module_chart_name" id="module_chart_name"/>

								<input type="hidden" class="form-control" placeholder="" name="module_chart_name_" id="module_chart_name_"/>

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Chart Name</label>
									<div class="col-md-6 m-t-10">
										<input type="text" name="chart_name" id="chart_name" class="form-control" placeholder="ex : User Analysis" />
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Chart Type</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control" name="chart_type" id="chart_type">
                                            <option value="" >Select Type</option>
                                            <option value="pie_chart">Pie Chart</option>
                                            <option value="bar_chart">Bar Chart</option>
                                            <option value="line_chart">Line Chart</option>
                                        </select>										
									</div>
								</div>	


								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">X Axis : Parent</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control" name="x_axis_parent" id="x_axis_parent">
                                            <option value="" >Select Type</option>
                                        </select>										
									</div>
								</div>	


								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">X Axis : Field</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control" name="x_axis_field" id="x_axis_field">
                                            <option value="" >Select Type</option>
                                        </select>										
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Y Axis : Parent</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control" name="y_axis_parent" id="y_axis_parent">
                                            <option value="" >Select Type</option>
                                        </select>										
									</div>
								</div>								

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Y Axis : Field</label>
									<div class="col-md-6 m-t-10">
									    <select class="form-control" name="y_axis_field" id="y_axis_field">
                                            <option value="" >Select Type</option>
                                        </select>										
									</div>
								</div>	
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Chart Description</label>
									<div class="col-md-6 m-t-10">
										<textarea class="form-control" name="chart_description" id="chart_description" placeholder="ex : A Pie Chart Showing Number of Users activity Per Day" rows="3"></textarea>
									</div>
								</div>															
								<div class="form-group">
									<label class="control-label col-md-4 m-t-10">Add To Dashboard</label>
									<div class="col-md-6 m-t-10">
										<input type="checkbox" value="1" name="chart_dashboard" id="chart_dashboard" />
									</div>
								</div>
								

								<div class="form-group">
									<label class="control-label col-md-4 m-t-10"></label>
									<div class="col-md-6 m-t-10">
									    <button type="button" class="btn btn-sm btn-primary" name="add_chart" id="add_chart">Add Chart</button>
									</div>
								</div>

							</form>
                        </div>
                    </div>
                    <!-- end panel -->


                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Engine</h4>
                        </div>
                        <div class="panel-body ">
                        	<div class="row">
								<div class="col-md-6 m-t-10">
								    <button type="button" class="btn btn-sm btn-primary" name="start_engine" id="start_engine" onclick="startEngine()">Start Engine</button>
								</div>
                        		
                        	</div>
                        	<div class="row">
								<div class="alert alert-primary m-t-10">
									<h4 class="block">Dashboard</h4>
									<p>
										 Engine running will be displayed below....
									</p>
								</div>
                        		
                        	</div>

							<div class="row">
								<div class="col-md-6 m-t-10">
								<div class="form-group">
									<label class="control-label">Engine Progress :: </label>
	                                <div class="progress progress-striped active">
	                                    <div class="progress-bar progress-bar-inverse" style="width: 0%" id="database_progress">Creating Database</div>
	                                </div>								
								</div>									
								
	                                <div class="progress progress-striped active">
	                                    <div class="progress-bar progress-bar-inverse" id="model_progress" style="width: 0%">Creating Model</div>
	                                </div>								
	                                <div class="progress progress-striped active">
	                                    <div class="progress-bar progress-bar-inverse" id="controller_progress" style="width: 0%">Creating Controller</div>
	                                </div>								
	                                <div class="progress progress-striped active">
	                                    <div class="progress-bar progress-bar-inverse" id="table_progress" style="width: 0%">Creating Table</div>
	                                </div>	                                
	                                <div class="progress progress-striped active">
	                                    <div class="progress-bar progress-bar-inverse" id="form_progress" style="width: 0%">Creating Form</div>
	                                </div>								
	                                <div class="progress progress-striped active">
	                                    <div class="progress-bar progress-bar-inverse" id="edit_form_progress" style="width: 0%">Creating Editing Form</div>
	                                </div>								

	                                <div class="progress progress-striped active">
	                                    <div class="progress-bar progress-bar-inverse" id="report_progress" style="width: 0%">Creating Report</div>
	                                </div>																
	                                <div class="progress progress-striped active">
	                                    <div class="progress-bar progress-bar-inverse" id="chart_progress" style="width: 0%">Creating Chart</div>
	                                </div>								
	                                <div class="progress progress-striped active">
	                                    <div class="progress-bar progress-bar-inverse" id="menu_progress" style="width: 0%">Creating Routes</div>
	                                </div>	                                								
	                                <div class="progress progress-striped active">
	                                    <div class="progress-bar progress-bar-inverse" id="module_progress" style="width: 0%">Creating Modules</div>
	                                </div>	                                								
								</div>
							</div>
                        </div>
                    </div>
                    <!-- end panel -->

                </div>
                <!-- end col-6 -->
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->
@endsection


<script type="text/javascript">
	function enableIndex(){
		if($("#is_index").is(":checked")){
			$("#index_type").attr("disabled",false);
		}else{
			$("#index_type").attr("disabled",true);
			$("#parent_module").attr("disabled",true);
			$("#index_type").val("");
			$("#parent_module").val("");
		}


	}
	function enableParentModules(){
		
			if($("#index_type").val()=="foreign_key"){
				if($("#field_type").val()=="int"){
					$("#parent_module").attr("disabled",false);
					$("#input_type").val("select");
				}else{
		            $.gritter.add({
		                // (string | mandatory) the heading of the notification
		                title: 'Notice',
		                // (string | mandatory) the text inside the notification
		                text: "Foreign Key Must Be Integer",
		                // (string | optional) the image to display on the left
		                // image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',
		                // (bool | optional) if you want it to fade out on its own or just sit there
		                sticky: false,
		                // (int | optional) the time you want it to be alive for before fading out
		                time: ''
		        	});
					

					$("#index_type").val("");
				}

				
			}else{
				$("#parent_module").attr("disabled",true);
			}
	}
	
	var r=0;
	var fieldData=[];
	
	function addField(){
		var fieldName=$("#field_name").val();
		if(fieldName!=""){
			var fieldType=$("#field_type").val();

			if(fieldType==""){
				alert("must select field type");
				return false;
			}

			if($("#_form_type").val()=="wizard"){
				if($("#field_section").val()==""){
					alert("Must Select Field Section :: Wizard");
					return false;
				}

			}
			var isIndex=$("#is_index").is(":checked");
			var isRequired=$("#is_required").is(":checked");
			var indexType=$("#index_type").val();
			var parentModule=$("#parent_module").val();
			var key=$("#key").val();
			var value=$("#value").val();
			var inputType=$("#input_type").val();
			var fieldSection=$("#field_section").val();
			var parentModuleTable=$("#parent_module_table").val();

			if(indexType=="foreign_key"){
				if(value=="" || key=="" || parentModule==""){
					alert("Either Parent Module, Value or Key is Missing :: Foreign key");
					return false;
				}
			}

			var data=[];
			data["field_name"]=fieldName;
			data["field_type"]=fieldType;
			data["is_index"]=isIndex;
			data["is_required"]=isRequired;
			data["index_type"]=indexType;
			data["parent_module"]=parentModule;
			data["key"]=key;
			data["value"]=value;
			data["input_type"]=inputType;
			data["field_section"]=fieldSection;
			data["parent_module_table"]=parentModuleTable;

			fieldData.push(data);
			
			if(r==0){
				$("#fields_tbody tr").remove();
			}
			r++;
			
			$("#fields_tbody").append("<tr><td>"+fieldName+"</td><td>"+fieldType+"</td><td>"+isIndex+"</td><td>"+indexType+"</td><td>"+parentModule+"</td><td></td></tr>");
			$("#fields_form")[0].reset();

		}else{
			alert("field name empty");
		}
		console.log(fieldData);
	}

	function getFormattedName(name){
		var formattedName=name.toLowerCase();
		formattedName=formattedName.trim();
		formattedName=formattedName.replace(/ /g,"_");
		return formattedName;

	}


	function createDatabase(){
		if(fieldData.length>0 && $("#module_name").val()!=""){
			var script="create table "+getFormattedName($("#module_name").val())+"(id int(10) unsigned auto_increment not null primary key,";
			var w=(Number(fieldData.length)-1)/100;
			for( var r=0;r<fieldData.length;r++){
				var fields=fieldData[r];
				var width=100*r;
				var fieldScript=getFormattedName(fields["field_name"]);
				if(fields["field_type"]=="int"){
					fieldScript+=" int(10) ";
				}else if(fields["field_type"]=="decimal"){
					fieldScript+=" decimal(10,2) ";
				}else if(fields["field_type"]=="boolean"){
					fieldScript+=" tinyint(1) ";
				}else if(fields['input_type']=="textarea"){
					fieldScript+=" varchar(1000) ";

				}else{
					fieldScript+=" varchar(300) ";

				}
				if(fields["is_required"]){
					fieldScript+=" not null ";
				}
				if(fields["index_type"]=="unique_key"){
					fieldScript+=",unique("+getFormattedName(fields["field_name"])+"),";
				}else if(fields["index_type"]=="foreign_key"){
					fieldScript+=" unsigned not null,foreign key("+getFormattedName(fields["field_name"])+") references "+fields["parent_module_table"]+"(id) on delete restrict on update cascade,";
				}else{
					fieldScript+=",";
				}
				script+=fieldScript;


				$('#database_progress').css('width', ""+width+"%");
				
			}

			script+="created_at timestamp,updated_at timestamp)ENGINE=InnoDB;";
			var database=$("#database").val();
			var username=$("#username").val();
			var password=$("#password").val();
			var server=$("#server").val();
			var d={"script":script,"datebase":database,"server":server,"username":username,"password":password};
			console.log(d);

			$("#script").val(script);

		    var formData = new FormData($('#database_form')[0]);
	        $.ajax({
	            type:'POST',
	            url: 'engine/database_engine.php',
	            data:formData,
	            cache:false,
	            contentType: false,
	            processData: false,
	            success:function(data){
	            	console.log(data);
	                // var d=jQuery.parseJSON(data);
	                $('#database_progress').css('width', "100%");
	            }
	        });


			
		}else{
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Notice',
                // (string | mandatory) the text inside the notification
                text: "You must have atleast one field or Module Name Missing!!!",
                // (string | optional) the image to display on the left
                // image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: ''
        	});


		}

	}
	function getNameCase(name){
		var str=name.replace(/(?:^|\s)\w/g, function(match) {
        	return match.toUpperCase();
    	});
		str=str.split(" ").join("");
		return str;
	}
	function getCasedName(name){
		var str=name.replace(/(?:^|\s)\w/g, function(match) {
        	return match.toUpperCase();
    	});
    	return str;		
	}
	function createModel(){
		var moduleName=getNameCase($("#module_name").val());
		var script="";
		script+="\n/**";
		script+="\n* @author Wanjala Innocent Khaemba";
		script+="\n*Model - ("+$("#module_description").val()+")";
		script+="\n*/";
		script+="\nnamespace App;";
		script+="\nuse Illuminate\\Database\\Eloquent\\Model;";
		script+="\nclass "+moduleName+" extends Model";
		script+="\n{";
		for(var k=0;k<fieldData.length;k++){

			if(fieldData[k]["index_type"]=="foreign_key"){
				script+="\n\tpublic function "+getNameCase(fieldData[k]["field_name"]).toLowerCase()+"model(){";
				script+="\n\t\treturn $this->belongsTo("+fieldData[k]["parent_module"]+"::class, '"+getFormattedName(fieldData[k]["field_name"]).toLowerCase()+"');";
				script+="\n\t}";
			}
		}		
		script+="\n}";
		$("#model_script").val(script);
		
		$("#model_name").val(moduleName);
	    var formData = new FormData($('#model_form')[0]);
        $.ajax({
            type:'POST',
            url: 'engine/model_engine.php',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            	console.log(data);
            	$('#model_progress').css('width', "100%");
                // var d=jQuery.parseJSON(data);
            }
        });		
	}
	function createController(){
		var moduleName=getNameCase($("#module_name").val());
		var formattedName=getFormattedName($("#module_name").val());
		var script="";
		script+="\n/**";
		script+="\n* @author Wanjala Innocent Khaemba";
		script+="\n*Controller - ("+$("#module_description").val()+")";
		script+="\n*/";
		script+="\nnamespace App\\Http\\Controllers\\admin;";
		script+="\nuse Illuminate\\Http\\Request;";
		script+="\nuse App\\Http\\Requests;";
		script+="\nuse App\\"+moduleName+";";
		script+="\nuse App\\Companies;";
		script+="\nuse App\\Modules;";
		script+="\nuse App\\Users;";
		var ki=0;
		for(var k=0;k<fieldData.length;k++){
			if(fieldData[k]["index_type"]=="foreign_key"){
				script+="\nuse App\\"+getNameCase(fieldData[k]["parent_module"])+";";
			}
		}		
		script+="\nuse App\\Http\\Controllers\\Controller;";
		script+="\nuse Illuminate\\Support\\Facades\\Auth;";
		script+="\nuse App\\UsersAccountsRoles;"
		script+="\nclass "+moduleName+"Controller extends Controller";
		script+="\n{";
		script+="\n";
		script+="\n\tpublic function __construct(){";
		script+="\n\t\t$this->middleware('auth');";
		script+="\n\t}";
		script+="\n\tpublic function index(){";
		for(var k=0;k<fieldData.length;k++){

			if(fieldData[k]["index_type"]=="foreign_key"){
				script+="\n\t\t$"+moduleName.toLowerCase()+"data['"+getNameCase(fieldData[k]["parent_module"]).toLowerCase()+"']="+getNameCase(fieldData[k]["parent_module"])+"::all();";
			}
		}

		script+="\n\t\t$"+moduleName.toLowerCase()+"data['list']="+moduleName+"::all();";
		script+="\n\t\t$user=Users::where([['id','=',Auth::id()]])->get();";
		script+="\n\t\t$module=Modules::where([['name','=','"+moduleName+"']])->get();"
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();";

		script+="\n\t\tif(isset($"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]) && $"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_add']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_list']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_edit']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_edit']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_show']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_delete']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_report']==0){";
		script+="\n\t\t\treturn view('admin.error.denied',compact('"+moduleName.toLowerCase()+"data'));";
		script+="\n\t\t}else{"
		script+="\n\t\t\treturn view('admin."+formattedName+".index',compact('"+moduleName.toLowerCase()+"data'));";
		script+="\n\t\t}";
		script+="\n\t}";

		script+="\n";
		script+="\n\tpublic function create(){";
		script+="\n\t\t$"+moduleName.toLowerCase()+"data;";
		for(var k=0;k<fieldData.length;k++){

			if(fieldData[k]["index_type"]=="foreign_key"){
				script+="\n\t\t$"+moduleName.toLowerCase()+"data['"+getNameCase(fieldData[k]["parent_module"]).toLowerCase()+"']="+getNameCase(fieldData[k]["parent_module"])+"::all();";
			}
		}
		script+="\n\t\t$user=Users::where([['id','=',Auth::id()]])->get();";
		script+="\n\t\t$module=Modules::where([['name','=','"+moduleName+"']])->get();"
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();";

		script+="\n\t\tif(isset($"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]) && $"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_add']==0){";
		script+="\n\t\t\treturn view('admin.error.denied',compact('"+moduleName.toLowerCase()+"data'));";
		script+="\n\t\t}else{"
		script+="\n\t\t\treturn view('admin."+formattedName+".create',compact('"+moduleName.toLowerCase()+"data'));";
		script+="\n\t\t}";
		script+="\n\t}";
		script+="\n";
		script+="\n\tpublic function filter(Request $request){";
		for(var k=0;k<fieldData.length;k++){

			if(fieldData[k]["index_type"]=="foreign_key"){
				script+="\n\t\t$"+moduleName.toLowerCase()+"data['"+getNameCase(fieldData[k]["parent_module"]).toLowerCase()+"']="+getNameCase(fieldData[k]["parent_module"])+"::all();";
			}
		}		
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['list']="+moduleName+"::where([";
		for( var r=0;r<fieldData.length;r++){
			var fields=fieldData[r];
			var fieldName=getFormattedName(fields["field_name"]);
			if(fields["input_type"]!="image" && fields["input_type"]!="file" && fields["input_type"]!="date"){
				script+="['"+fieldName+"','LIKE','%'.$request->get('"+fieldName+"').'%'],";
			}
			
		}		
		script+="])";
		
		for( var r=0;r<fieldData.length;r++){
			var fields=fieldData[r];
			var fieldName=getFormattedName(fields["field_name"]);
			if(fields["input_type"]=="date"){
				script+="->orWhereBetween('"+fieldName+"',[$request->get('"+fieldName+"from'),$request->get('"+fieldName+"to')])";
				
			}
			
		}		
			
		script+="->get();";
		script+="\n\t\t$user=Users::where([['id','=',Auth::id()]])->get();";
		script+="\n\t\t$module=Modules::where([['name','=','"+moduleName+"']])->get();"
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();";

		script+="\n\t\tif(isset($"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]) && $"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_add']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_list']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_edit']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_edit']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_show']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_delete']==0&&$"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_report']==0){";
		script+="\n\t\t\treturn view('admin.error.denied',compact('"+moduleName.toLowerCase()+"data'));";
		script+="\n\t\t}else{"
		script+="\n\t\t\treturn view('admin."+formattedName+".index',compact('"+moduleName.toLowerCase()+"data'));";
		script+="\n\t\t}";
		script+="\n\t}";
		script+="\n";
		script+="\n\tpublic function report(){";
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['company']=Companies::all();";
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['list']="+moduleName+"::all();";
		script+="\n\t\t$user=Users::where([['id','=',Auth::id()]])->get();";
		script+="\n\t\t$module=Modules::where([['name','=','"+moduleName+"']])->get();"
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();";

		script+="\n\t\tif(isset($"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]) && $"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_report']==0){";
		script+="\n\t\t\treturn view('admin.error.denied',compact('"+moduleName.toLowerCase()+"data'));";
		script+="\n\t\t}else{"
		script+="\n\t\t\treturn view('admin."+formattedName+".report',compact('"+moduleName.toLowerCase()+"data'));";
		script+="\n\t\t}";
		script+="\n\t}";
		script+="\n";	
		script+="\n\tpublic function chart(){";
		script+="\n\t\treturn view('admin."+formattedName+".chart');";
		script+="\n\t}";
		script+="\n";			
		script+="\n\tpublic function store(Request $request){";
		script+="\n\t\t$"+moduleName.toLowerCase()+"=new "+moduleName+"();";
		for( var r=0;r<fieldData.length;r++){
			var fields=fieldData[r];
			var fieldName=getFormattedName(fields["field_name"]);
			
			if(fields["input_type"]=="image"){
				script+="\n\t\t$"+moduleName.toLowerCase()+"->"+fieldName+"=time() . '_' . rand(1000, 9999) . '.jpg';";
			}else{
				script+="\n\t\t$"+moduleName.toLowerCase()+"->"+fieldName+"=$request->get('"+fieldName+"');";
			}
			

		}
		script+="\n\t\t$response=array();";
		script+="\n\t\t$user=Users::where([['id','=',Auth::id()]])->get();";
		script+="\n\t\t$module=Modules::where([['name','=','"+moduleName+"']])->get();"
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();";

		script+="\n\t\tif(isset($"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]) && $"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_show']==1){";		
		script+="\n\t\t\ttry{";
		script+="\n\t\t\t\tif($"+moduleName.toLowerCase()+"->save()){";
		for( var r=0;r<fieldData.length;r++){
			var fields=fieldData[r];
			if(fields["input_type"]=="image"){
				var fieldName=getFormattedName(fields["field_name"]);
				var casedFieldName=getNameCase(fields["field_name"]);
				script+="\n\t\t\t$"+casedFieldName+"Image = $request->file('"+fieldName+"');";
				script+="\n\t\t\t$"+casedFieldName+"Image->move('uploads/images',$"+moduleName.toLowerCase()+"->"+fieldName+");";

			}
		}		
		script+="\n\t\t\t\t\t$response['status']='1';";
		script+="\n\t\t\t\t\t$response['message']='"+$("#module_name").val()+" Added successfully';";
		script+="\n\t\t\t\t\treturn json_encode($response);";
		script+="\n\t\t\t}else{";
		script+="\n\t\t\t\t\t$response['status']='0';";
		script+="\n\t\t\t\t\t$response['message']='Failed to add "+$("#module_name").val()+". Please try again';";
		script+="\n\t\t\t\t\treturn json_encode($response);";
		script+="\n\t\t\t\t}";
		script+="\n\t\t\t}";
		script+="\n\t\t\tcatch(Exception $e){";
		script+="\n\t\t\t\t\t$response['status']='0';";
		script+="\n\t\t\t\t\t$response['message']='An Error occured while attempting to add "+$("#module_name").val()+". Please try again';";
		script+="\n\t\t\t\t\treturn json_encode($response);";
		script+="\n\t\t\t}";
		script+="\n\t\t}else{";
		script+="\n\t\t\t$response['status']='0';";
		script+="\n\t\t\t$response['message']='Access Denied!';";		
		script+="\n\t\t\treturn json_encode($response);";
		script+="\n\t\t}";
		script+="\n\t}";
		script+="\n";
		script+="\n\tpublic function edit($id){";

		for(var k=0;k<fieldData.length;k++){
			if(fieldData[k]["index_type"]=="foreign_key"){
				script+="\n\t\t$"+moduleName.toLowerCase()+"data['"+getNameCase(fieldData[k]["parent_module"]).toLowerCase()+"']="+getNameCase(fieldData[k]["parent_module"])+"::all();";
			}
		}		
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['data']="+moduleName+"::find($id);";
		script+="\n\t\t$user=Users::where([['id','=',Auth::id()]])->get();";
		script+="\n\t\t$module=Modules::where([['name','=','"+moduleName+"']])->get();"
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();";

		script+="\n\t\tif(isset($"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]) && $"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_edit']==0){";
		script+="\n\t\t\treturn view('admin.error.denied',compact('"+moduleName.toLowerCase()+"data'));";
		script+="\n\t\t}else{"
		script+="\n\t\treturn view('admin."+formattedName.toLowerCase()+".edit',compact('"+moduleName.toLowerCase()+"data','id'));";
		script+="\n\t\t}";
		script+="\n\t}";

		script+="\n";
		script+="\n\tpublic function show($id){";
		for(var k=0;k<fieldData.length;k++){
			if(fieldData[k]["index_type"]=="foreign_key"){
				script+="\n\t\t$"+moduleName.toLowerCase()+"data['"+getNameCase(fieldData[k]["parent_module"]).toLowerCase()+"']="+getNameCase(fieldData[k]["parent_module"])+"::all();";
			}
		}		
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['data']="+moduleName+"::find($id);";
		script+="\n\t\t$user=Users::where([['id','=',Auth::id()]])->get();";
		script+="\n\t\t$module=Modules::where([['name','=','"+moduleName+"']])->get();"
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();";

		script+="\n\t\tif(isset($"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]) && $"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_show']==0){";
		script+="\n\t\t\treturn view('admin.error.denied',compact('"+moduleName.toLowerCase()+"data'));";
		script+="\n\t\t}else{"
		script+="\n\t\treturn view('admin."+formattedName.toLowerCase()+".show',compact('"+moduleName.toLowerCase()+"data','id'));";
		script+="\n\t\t}";
		script+="\n\t}";


		script+="\n";
		script+="\n\tpublic function update(Request $request,$id){";

		script+="\n\t\t$"+moduleName.toLowerCase()+"="+moduleName+"::find($id);";
		for(var k=0;k<fieldData.length;k++){
			if(fieldData[k]["index_type"]=="foreign_key"){
				script+="\n\t\t$"+moduleName.toLowerCase()+"data['"+getNameCase(fieldData[k]["parent_module"]).toLowerCase()+"']="+getNameCase(fieldData[k]["parent_module"])+"::all();";
			}
		}		
		
		for( var r=0;r<fieldData.length;r++){
			var fields=fieldData[r];
			var fieldName=getFormattedName(fields["field_name"]);
			if(fields["input_type"]!="image"){
				script+="\n\t\t$"+moduleName.toLowerCase()+"->"+fieldName+"=$request->get('"+fieldName+"');";
			}

		}

		script+="\n\t\t$user=Users::where([['id','=',Auth::id()]])->get();";
		script+="\n\t\t$module=Modules::where([['name','=','"+moduleName+"']])->get();"
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();";

		script+="\n\t\tif($"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_edit']==0){";
		script+="\n\t\t\treturn view('admin.error.denied',compact('"+moduleName.toLowerCase()+"data'));";
		script+="\n\t\t}else{"
		script+="\n\t\t$"+moduleName.toLowerCase()+"->save();";
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['data']="+moduleName+"::find($id);";

		script+="\n\t\treturn view('admin."+formattedName.toLowerCase()+".edit',compact('"+moduleName.toLowerCase()+"data','id'));";
		script+="\n\t\t}";
		script+="\n\t}";

		script+="\n";
		script+="\n\tpublic function destroy($id){";
		script+="\n\t\t$"+moduleName.toLowerCase()+"="+moduleName+"::find($id);";
		script+="\n\t\t$user=Users::where([['id','=',Auth::id()]])->get();";
		script+="\n\t\t$module=Modules::where([['name','=','"+moduleName+"']])->get();"
		script+="\n\t\t$"+moduleName.toLowerCase()+"data['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();";
		script+="\n\t\tif(isset($"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]) && $"+moduleName.toLowerCase()+"data['usersaccountsroles'][0]['_delete']==1){";
		script+="\n\t\t\t$"+moduleName.toLowerCase()+"->delete();";
		script+="\n\t\t}";
		script+="return redirect('admin/"+moduleName.toLowerCase()+"')->with('success','"+$("#module_name").val()+" has been deleted!');";
		script+="\n\t}";
		script+="\n}";
		$("#controller_name").val(moduleName);
		$("#controller_script").val(script);

	    var formData = new FormData($('#controller_form')[0]);
        $.ajax({
            type:'POST',
            url: 'engine/controller_engine.php',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            	console.log(data);
            	$('#controller_progress').css('width', "100%");
                // var d=jQuery.parseJSON(data);
            }
        });	




	}

	function createTable(){
		var formattedName=getFormattedName($("#module_name").val());
		var moduleName=getNameCase($("#module_name").val()).toLowerCase();
		var tableModuleName=getCasedName($("#module_name").val());
		var headerScript="\n                                    <tr>";

		var indexType="";
		var value="";

		for(var r=0;r<fieldData.length;r++){
			var field=fieldData[r];
			if(r<(fieldData.length-1)){
				indexType+=field["index_type"]+",";
				value+=field["value"]+"#";

			}else{
				indexType+=field["index_type"];
				value+=field["value"];

			}
			
		}	
		$("#row_index_types").val(indexType);
		$("#row_index_values").val(value);


		$("#table_script").val(script);
		$("#table_name").val(formattedName);
		$("#module_table_name").val(moduleName);
		$("#table_module_name").val(tableModuleName);

		for(var r=0;r<fieldData.length;r++){
			var field=fieldData[r];
			if(r<8){

			headerScript+="\n                                        <th>"+getCasedName(field["field_name"])+"</th>";			

			}
		}
		headerScript+="\n                                        <th>Action</th>";
		headerScript+="                                    </tr>";

		$("#header_script").val(headerScript);

		var rowName="";
		var rowFieldName="";
		var rowParent="";
		var inputCasedName="";
		var inputTypes="";
		var fieldSections="";
		var fieldSectionsDescription="";
		var isRequired="";
		var key="";

		for(var r=0;r<fieldData.length;r++){
			var field=fieldData[r];
			if(r<(fieldData.length-1)){
				rowName+=getFormattedName(field["field_name"])+",";
				rowFieldName+=getNameCase(field["field_name"]).toLowerCase()+",";
				rowParent+=getNameCase(field["parent_module"])+",";
				inputCasedName+=getCasedName(field["field_name"])+",";
				inputTypes+=field["input_type"]+",";
				isRequired+=field["is_required"]+",";
				fieldSections+=sectionsData.length==0?"":sectionsData[field["field_section"]]["name"]+",";
				fieldSectionsDescription+=sectionsData.length==0?"":sectionsData[field["field_section"]]["description"]+",";
				key+=field["key"]+",";

			}else{
				rowName+=getFormattedName(field["field_name"]);
				rowFieldName+=getNameCase(field["field_name"]).toLowerCase();
				rowParent+=getNameCase(field["parent_module"]);
				inputCasedName+=getCasedName(field["field_name"]);
				inputTypes+=field["input_type"];
				isRequired+=field["is_required"];
				fieldSections+=sectionsData.length==0?"":sectionsData[field["field_section"]]["name"];
				fieldSectionsDescription+=sectionsData.length==0?"":sectionsData[field["field_section"]]["description"];
				key+=field["key"];

			}
			
		}	

		var sectionsName="";
		var sectionsDescription="";
		if(sectionsData.length!=0){
			for(var r=0;r<sectionsData.length;r++){
				if(r<(sectionsData.length-1)){
					sectionsName+=sectionsData[r]["name"]+",";
					sectionsDescription+=sectionsData[r]["description"]+",";
				}else{
					sectionsName+=sectionsData[r]["name"];
					sectionsDescription+=sectionsData[r]["description"];
				}
			}

		}


		$("#row_name").val(rowName);
		$("#row_field_names").val(rowFieldName);
		$("#row_parents").val(rowParent);
		$("#row_input_cased_name").val(inputCasedName);
		$("#row_input_types").val(inputTypes);
		$("#row_field_sections").val(fieldSections);
		$("#row_field_sections_description").val(fieldSectionsDescription);
		$("#row_keys").val(key);
		$("#row_is_requireds").val(isRequired);		
		$("#row_sections_name").val(sectionsName);
		$("#row_sections_description").val(sectionsDescription);
		$("#row_form_type").val($("#_form_type").val());



	    var formData = new FormData($('#table_form')[0]);
        $.ajax({
            type:'POST',
            url: 'engine/table_engine.php',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            	console.log(data);
            	$('#table_progress').css('width', "100%");
                // var d=jQuery.parseJSON(data);
            }
        });

	}
	function fieldType(){
		if($("#field_type").val()=="boolean"){
			$("#input_type").val("checkbox");
		}else{
			$("#input_type").val("text");
		}
	}
	var sectionsData=[];
	var s=0;
	function addSection(){
		var sectionName=$("#section_name").val();
		var sectionDescription=$("#section_description").val();
		
		if(sectionName!=""){
			if($("#_form_type").val()!="wizard"){
				$("#_form_type").val("wizard");
				$("#completion_message").attr("disabled",false);
			}
			var section=[];
			section["name"]=sectionName;
			section["description"]=sectionDescription;
			sectionsData.push(section);
			var option="<option value='"+s+"'>"+sectionName+"</option>";
			$("#field_section").append(option);
			s++;
		}
		console.log(sectionsData);
		$("#_sections_form")[0].reset();
	}

	function createForm(){
		var formattedName=getFormattedName($("#module_name").val());
		var moduleName=getNameCase($("#module_name").val()).toLowerCase();
		var formModuleName=getCasedName($("#module_name").val());
		var script="";
		$("#form_script").val(script);
		$("#form_name").val(formattedName);
		$("#module_form_name").val(moduleName);
		$("#form_module_name").val(formModuleName);

		console.log(sectionsData);

		var fieldType="";
		var fieldName="";
		var inputCasedName="";
		var indexType="";
		var isRequired="";
		var key="";
		var value="";
		var parentModule="";
		var inputTypes="";
		var fieldSections="";
		var fieldSectionsDescription="";
		for(var r=0;r<fieldData.length;r++){
			var field=fieldData[r];
			if(r<(fieldData.length-1)){
				fieldType+=field["field_type"]+",";
				fieldName+=getFormattedName(field["field_name"])+",";
				inputCasedName+=getCasedName(field["field_name"])+",";
				indexType+=field["index_type"]+",";
				key+=field["key"]+",";
				value+=field["value"]+"#";
				parentModule+=field["parent_module"]+",";
				inputTypes+=field["input_type"]+",";
				isRequired+=field["is_required"]+",";
				fieldSections+=sectionsData.length==0?"":sectionsData[field["field_section"]]["name"]+",";
				fieldSectionsDescription+=sectionsData.length==0?"":sectionsData[field["field_section"]]["description"]+",";

			}else{
				fieldType+=field["field_type"];
				fieldName+=getFormattedName(field["field_name"]);
				inputCasedName+=getCasedName(field["field_name"]);
				indexType+=field["index_type"];
				key+=field["key"];
				value+=field["value"];
				parentModule+=field["parent_module"];
				inputTypes+=field["input_type"];
				isRequired+=field["is_required"];
				fieldSections+=sectionsData.length==0?"":sectionsData[field["field_section"]]["name"];
				fieldSectionsDescription+=sectionsData.length==0?"":sectionsData[field["field_section"]]["description"];


			}
			
		}	
		var sectionsName="";
		var sectionsDescription="";
		if(sectionsData.length!=0){
			for(var r=0;r<sectionsData.length;r++){
				if(r<(sectionsData.length-1)){
					sectionsName+=sectionsData[r]["name"]+",";
					sectionsDescription+=sectionsData[r]["description"]+",";
				}else{
					sectionsName+=sectionsData[r]["name"];
					sectionsDescription+=sectionsData[r]["description"];
				}
			}

		}

		
		$("#sections_name").val(sectionsName);
		$("#sections_description").val(sectionsDescription);
		$("#form_type").val($("#_form_type").val());
		$("#field_names").val(fieldName);
		$("#field_types").val(fieldType);
		$("#input_cased_name").val(inputCasedName);
		$("#index_types").val(indexType);
		$("#keys").val(key);
		$("#is_requireds").val(isRequired);
		$("#values").val(value);
		$("#parent_modules").val(parentModule);
		$("#input_types").val(inputTypes);
		$("#field_sections").val(fieldSections);
		$("#field_sections_description").val(fieldSectionsDescription);

	    var formData = new FormData($('#form_form')[0]);
        $.ajax({
            type:'POST',
            url: 'engine/form_engine.php',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            	console.log(data);
            	$('#form_progress').css('width', "100%");
                // var d=jQuery.parseJSON(data);
            }
        });

	}

	function createEditForm(){
		var formattedName=getFormattedName($("#module_name").val());
		var moduleName=getNameCase($("#module_name").val()).toLowerCase();
		var formModuleName=getCasedName($("#module_name").val());
		var script="";
		$("#form_script").val(script);
		$("#form_name").val(formattedName);
		$("#module_form_name").val(moduleName);
		$("#form_module_name").val(formModuleName);

		var fieldType="";
		var fieldName="";
		var inputCasedName="";
		var indexType="";
		var key="";
		var value="";
		var parentModule="";
		var inputTypes="";
		for(var r=0;r<fieldData.length;r++){
			var field=fieldData[r];
			if(r<(fieldData.length-1)){
				fieldType+=field["field_type"]+",";
				fieldName+=getFormattedName(field["field_name"])+",";
				inputCasedName+=getCasedName(field["field_name"])+",";
				indexType+=field["index_type"]+",";
				key+=field["key"]+",";
				value+=field["value"]+"#";
				parentModule+=field["parent_module"]+",";
				inputTypes+=field["input_type"]+",";

			}else{
				fieldType+=field["field_type"];
				fieldName+=getFormattedName(field["field_name"]);
				inputCasedName+=getCasedName(field["field_name"]);
				indexType+=field["index_type"];
				key+=field["key"];
				value+=field["value"];
				parentModule+=field["parent_module"];
				inputTypes+=field["input_type"];

			}
			
		}	

		$("#field_names").val(fieldName);
		$("#field_types").val(fieldType);
		$("#input_cased_name").val(inputCasedName);
		$("#index_types").val(indexType);
		$("#keys").val(key);
		$("#values").val(value);
		$("#parent_modules").val(parentModule);
		$("#input_types").val(inputTypes);
		
	    var formData = new FormData($('#form_form')[0]);
        $.ajax({
            type:'POST',
            url: 'engine/edit_engine.php',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            	console.log(data);
            	$('#edit_form_progress').css('width', "100%");
                // var d=jQuery.parseJSON(data);
            }
        });

	}	

	function createReport(){
		var formattedName=getFormattedName($("#module_name").val());
		var moduleName=getNameCase($("#module_name").val()).toLowerCase();
		var reportModuleName=getCasedName($("#module_name").val());
		var script="";
		$("#report_script").val(script);
		$("#report_name").val(formattedName);
		$("#module_report_name").val(moduleName);
		$("#report_module_name").val(reportModuleName);
		var headerScript="\n                                    <tr>";

		for(var r=0;r<fieldData.length;r++){
			var field=fieldData[r];
			if(r<8){
				headerScript+="\n                                        <th>"+getCasedName(field["field_name"])+"</th>";			

			}

		}
		headerScript+="                                    </tr>";

		$("#report_header_script").val(headerScript);

		var rowName="";

		for(var r=0;r<fieldData.length;r++){
			var field=fieldData[r];
			if(r<(fieldData.length-1)){
				rowName+=getFormattedName(field["field_name"])+",";
			}else{
				rowName+=getFormattedName(field["field_name"]);

			}
			
		}	
		$("#report_row_name").val(rowName);		

		var indexType="";
		var value="";
		var rowFieldName="";
		var inputTypes="";

		for(var r=0;r<fieldData.length;r++){
			var field=fieldData[r];
			if(r<(fieldData.length-1)){
				indexType+=field["index_type"]+",";
				value+=field["value"]+"#";
				inputTypes+=field["input_type"]+",";
				rowFieldName+=getNameCase(field["field_name"]).toLowerCase()+",";

			}else{
				indexType+=field["index_type"];
				value+=field["value"];
				inputTypes+=field["input_type"];
				rowFieldName+=getNameCase(field["field_name"]).toLowerCase();

			}
			
		}	
		$("#report_row_index_types").val(indexType);
		$("#report_row_index_values").val(value);
		$("#report_row_field_names").val(rowFieldName);
		$("#report_row_input_types").val(inputTypes);


	    var formData = new FormData($('#report_form')[0]);
        $.ajax({
            type:'POST',
            url: 'engine/report_engine.php',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            	console.log(data);
            	$('#report_progress').css('width', "100%");
                // var d=jQuery.parseJSON(data);
            }
        });

	}
	function createChart(){
		var formattedName=getFormattedName($("#module_name").val());
		var moduleName=getNameCase($("#module_name").val()).toLowerCase();
		var chartModuleName=getCasedName($("#module_name").val());		
		var script="";
		$("#chart_script").val(script);
		$("#chart_module_name").val(formattedName);
		$("#module_chart_name").val(moduleName);
		$("#module_chart_name_").val(chartModuleName);


	    var formData = new FormData($('#chart_form')[0]);
        $.ajax({
            type:'POST',
            url: 'engine/chart_engine.php',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            	console.log(data);
            	$('#chart_progress').css('width', "100%");
                // var d=jQuery.parseJSON(data);
            }
        });

	}

	function createMenu(){
		var url=getNameCase($("#module_name").val()).toLowerCase();
		var menu=getCasedName($("#module_name").val());
		var controller=getNameCase($("#module_name").val());
		$("#menu").val(menu);
		$("#url").val(url);
		$("#menu_controller").val(controller);

	    var formData = new FormData($('#menu_form')[0]);
        $.ajax({
            type:'POST',
            url: 'engine/route_engine.php',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            	console.log(data);
            	$('#menu_progress').css('width', "100%");
                // var d=jQuery.parseJSON(data);
            }
        });

	}
	function createModule(){

		$("#_module_name").val(getNameCase($("#module_name").val()));
	    var formData = new FormData($('#modules_form')[0]);
        $.ajax({
            type:'POST',
            url: "{{route('modules.store')}}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            	console.log(data);
            	$('#module_progress').css('width', "100%");
                // var d=jQuery.parseJSON(data);
            }
        });

	}
	function createUserAccountsRoles(){

		$("#usr_module_name").val(getNameCase($("#module_name").val()));
	    var formData = new FormData($('#usersaccountsroles_form')[0]);
        $.ajax({
            type:'POST',
            url: "{{route('usersaccountsroles.store')}}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            	console.log(data);
            	$('#module_progress').css('width', "100%");
                // var d=jQuery.parseJSON(data);
            }
        });

	}

	function formType(){
		if($("#_form_type").val()=="wizard"){
			$("#completion_message").attr("disabled",false);
		}else{
			$("#completion_message").attr("disabled",true);
		}
	}
	function startEngine(){
		if(fieldData.length>0 && $("#module_name").val()!=""){
			createDatabase();
			createModel();
			// createUserAccountsRoles();
			createController();
			createTable();
			createForm();
			createEditForm();
			createReport();
			createChart();
			createMenu();
			createModule();
		}else{
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Notice',
                // (string | mandatory) the text inside the notification
                text: "You must have atleast one field or Module Name Missing!!!",
                // (string | optional) the image to display on the left
                // image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: ''
        	});			
		}
	}
</script>