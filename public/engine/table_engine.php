<?php
		$script="@extends(\"admin.home\")";
		$script.="\n@section(\"main_content\")";
		$script.="\n<style type=\"text/css\">\n\ttd div img{\n\t\tmax-width: 64px;\n\t}\n</style>";
		$script.="\n<div id=\"content\" class=\"content\">";
		$script.="\n    <ol class=\"breadcrumb pull-right\">";
		$script.="\n        <li><a href=\"#\">Home</a></li>";
		$script.="\n        <li><a href=\"#\">Public</a></li>";
		$script.="\n        <li><a href=\"#\">".$_POST['table_module_name']."</a></li>";
		$script.="\n        <li class=\"active\">Table</li>";
		$script.="\n    </ol>";
		$script.="\n    <h1 class=\"page-header\">".$_POST['table_module_name']." - DATA <small>".strtolower($_POST['table_module_name'])." data goes here...</small></h1>";
		$script.="\n    <div class=\"row\">";
		$script.="\n        <div class=\"col-md-12\">";
		$script.="\n            @if($".$_POST['module_table_name']."data['usersaccountsroles'][0]->_add==1)";
		$script.="\n            <a href=\"{!! route('".$_POST['module_table_name'].".create') !!}\"><button type=\"button\" class=\"btn btn-inverse btn-icon btn-circle m-b-10\"><i class=\"fa fa-plus\"></i></button></a>";
		$script.="\n            @endif";
		$script.="\n            @if($".$_POST['module_table_name']."data['usersaccountsroles'][0]->_report==1)";
		$script.="\n            <a href=\"{!! url('admin/".$_POST['module_table_name']."report') !!}\"><button type=\"button\" class=\"btn btn-inverse btn-icon btn-circle m-b-10\"><i class=\"fa fa-file-text-o\"></i></button></a>";
		$script.="\n            @endif";
		$script.="\n            @if($".$_POST['module_table_name']."data['usersaccountsroles'][0]->_report==1 || $".$_POST['module_table_name']."data['usersaccountsroles'][0]->_list==1)";
		$script.="\n            <a href=\"#modal-dialog\"  data-toggle=\"modal\"><button type=\"button\" class=\"btn btn-inverse btn-icon btn-circle m-b-10\"><i class=\"fa fa-filter\"></i></button></a>";		
		$script.="\n            @endif";
		
		$script.="\n        </div>";
		$script.="\n    </div>";
		$script.="\n    @if($".$_POST['module_table_name']."data['usersaccountsroles'][0]->_list==1)";
		$script.="\n    <div class=\"row\">";
		$script.="\n        <div class=\"col-md-12\">";
		$script.="\n            <div class=\"panel panel-inverse\">";
		$script.="\n                <div class=\"panel-heading\">";
		$script.="\n                    <div class=\"panel-heading-btn\">";
		$script.="\n                        <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-default\" data-click=\"panel-expand\"><i class=\"fa fa-expand\"></i></a>";
		$script.="\n                        <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-success\" data-click=\"panel-reload\"><i class=\"fa fa-repeat\"></i></a>";
		$script.="\n                        <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-warning\" data-click=\"panel-collapse\"><i class=\"fa fa-minus\"></i></a>";
		$script.="\n                        <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-danger\" data-click=\"panel-remove\"><i class=\"fa fa-times\"></i></a>";
		$script.="\n                    </div>";
		$script.="\n                    <h4 class=\"panel-title\">DataTable - Autofill</h4>";
		$script.="\n                </div>";
		$script.="\n                <div class=\"panel-body\">";
		$script.="\n                    <table id=\"data-table\" class=\"table table-striped table-bordered\">";
		$script.="\n                        <thead>";
		$script.=$_POST["header_script"];
		$script.="\n                        </thead>";
		$script.="\n                        <tbody>";
		$indexTypeArr=explode(",",$_POST["row_index_types"]);
		$indexValueArr=explode("#",$_POST["row_index_values"]);
		$rowFieldNameArr=explode(",",$_POST["row_field_names"]);
		$inputTypesArr=explode(",",$_POST['row_input_types']);
		$script.="\n                        @foreach ($".$_POST['module_table_name']."data['list'] as $".$_POST['module_table_name'].")";
		$script.="\n                            <tr>";
		$rowNameArr=explode(",",$_POST["row_name"]);
		for($r=0;$r<count($rowNameArr);$r++){
			if($r<8){
				$script.="\n                                <td class='table-text'><div>";
				if($indexTypeArr[$r]=="foreign_key"){
					$values=explode(",",$indexValueArr[$r]);
					for($c=0;$c<count($values);$c++){
						$script.="\n                                	{!! $".$_POST['module_table_name']."->".$rowFieldNameArr[$r]."model->".$values[$c]." !!}";	
					}
					
				}else{
					if($inputTypesArr[$r]=="image"){
						$script.="\n                                	<img src=\"{!!asset('uploads/images/'.$".$_POST['module_table_name']."->".$rowNameArr[$r].")!!}\" width='64' height='64'/>";

					}else if($inputTypesArr[$r]=="checkbox"){
						$script.="\n                                	@if($".$_POST['module_table_name']."->".$rowNameArr[$r]."=='1') YES @else NO @endif";
					}else{
						$script.="\n                                	{!! $".$_POST['module_table_name']."->".$rowNameArr[$r]." !!}";

					}
				}
				
				$script.="\n                                </div></td>";

			}
		}
		$script.="\n                                <td>";
		$script.="\n                <form action=\"{!! route('".$_POST['module_table_name'].".destroy',$".$_POST['module_table_name']."->id) !!}\" method=\"POST\">";
		$script.="\n                                        @if($".$_POST['module_table_name']."data['usersaccountsroles'][0]->_show==1)";
		$script.="\n                                        <a href=\"{!! route('".$_POST['module_table_name'].".show',$".$_POST["module_table_name"]."->id) !!}\" id='show-".$_POST['module_table_name']."-{!! $".$_POST['module_table_name']."->id !!}' class='btn btn-sm btn-circle btn-inverse'>";
		$script.="\n                                            <i class='fa fa-btn fa-eye'></i>";
		$script.="\n                                        </a>";		
		$script.="\n                                        @endif";
		$script.="\n                                        @if($".$_POST['module_table_name']."data['usersaccountsroles'][0]->_edit==1)";
		$script.="\n                                        <a href=\"{!! route('".$_POST['module_table_name'].".edit',$".$_POST["module_table_name"]."->id) !!}\" id='edit-".$_POST['module_table_name']."-{!! $".$_POST['module_table_name']."->id !!}' class='btn btn-sm btn-circle btn-warning'>";
		$script.="\n                                            <i class='fa fa-btn fa-edit'></i>";
		$script.="\n                                        </a>";
		$script.="\n                                        @endif";
		$script.="\n                                        @if($".$_POST['module_table_name']."data['usersaccountsroles'][0]->_delete==1)";
		$script.="\n                                        <input type=\"hidden\" name=\"_method\" value=\"delete\" />";		
		$script.="\n                                        {!! csrf_field() !!}";
		$script.="\n                                        {!! method_field('DELETE') !!}";
		$script.="\n                                        <button type='submit' id='delete-".$_POST['module_table_name']."-{!! $".$_POST['module_table_name']."->id !!}' class='btn btn-sm btn-circle btn-danger'>";
		$script.="\n                                            <i class='fa fa-btn fa-trash'></i>";
		$script.="\n                                        </button>";
		$script.="\n                                        @endif";
		$script.="\n                </form>";
		$script.="\n                                </td>";
		$script.="\n                            </tr>";
		$script.="\n                        @endforeach";
		$script.="\n                        </tbody>";
		$script.="\n                    </table>";
		$script.="\n                </div>";
		$script.="\n            </div>";
		$script.="\n        </div>";
		$script.="\n    </div>";
		$script.="\n</div>";
		$script.="\n    @endif";
		$script.="\n<div class=\"modal fade modal-message\" id=\"modal-dialog\">";
		$script.="\n    <div class=\"modal-dialog\">";
		$script.="\n        <div class=\"modal-content\">";
		$script.="\n            <div class=\"modal-header\">";
		$script.="\n                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">close</button>";
		$script.="\n                <h4 class=\"modal-title\">".$_POST['table_module_name']." - Filter Dialog</h4>";
		$script.="\n            </div>";
		$script.="\n            <div class=\"modal-body\">";
		$script.="\n    			<div class=\"row\">";
		$script.="\n                    <div class=\"col-md-12\">";
		$script.="\n                        <div class=\"panel panel-inverse\">";
		$script.="\n                            <div class=\"panel-heading\">";
		$script.="\n                                <div class=\"panel-heading-btn\">";
		$script.="\n                                    <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-default\" data-click=\"panel-expand\"><i class=\"fa fa-expand\"></i></a>";
		$script.="\n                                    <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-success\" data-click=\"panel-reload\"><i class=\"fa fa-repeat\"></i></a>";
		$script.="\n                                    <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-warning\" data-click=\"panel-collapse\"><i class=\"fa fa-minus\"></i></a>";
		$script.="\n                                    <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-danger\" data-click=\"panel-remove\"><i class=\"fa fa-times\"></i></a>";
		$script.="\n                                </div>";
		$script.="\n                                <h4 class=\"panel-title\">DataForm - Autofill</h4>";
		$script.="\n                            </div>";
		$script.="\n                            <div class=\"panel-body\">";
		$fieldNameArr=explode(",",$_POST["row_name"]);
		$inputCasedNameArr=explode(",",$_POST["row_input_cased_name"]);
		$indexTypesArr=explode(",",$_POST["row_index_types"]);
		$valuesArr=explode("#",$_POST["row_index_values"]);
		$parentModulesArr=explode(",",$_POST["row_parents"]);
		$keysArr=explode(",",$_POST["row_keys"]);
		
		$fieldSectionsArr=explode(",",$_POST["row_field_sections"]);
		$isRequiredArr=explode(",", $_POST["row_is_requireds"]);
		$fieldSectionsDescription=explode(",",$_POST["row_field_sections_description"]);


		$script.="\n                    <form id=\"form\"  class=\"form-horizontal\" action=\"{!! url('admin/".$_POST['module_table_name']."filter') !!}\" method=\"POST\">";

		$script.="\n                        {!! csrf_field() !!}";
		$formType=$_POST["row_form_type"];
		if($formType=="wizard"){
			$script.="\n								<div id=\"wizard\">";
			$script.="\n									<ol>";
			$sectionsArr=explode(",",$_POST["row_sections_name"]);
			$sectionsDescriptionArr=explode(",",$_POST["row_sections_description"]);
			for($s=0;$s<count($sectionsArr);$s++){
				$script.="\n										<li>";
				$script.="\n										".$sectionsArr[$s];
				$script.="\n										    <small>".$sectionsDescriptionArr[$s]."</small>";
				$script.="\n										</li>";
			}

			$script.="\n									</ol>";
			for($s=0;$s<count($sectionsArr);$s++){
				$script.="\n									<div>";
				$script.="\n                                        <fieldset>";
				$script.="\n                                            <legend class=\"pull-left width-full\">".$sectionsArr[$s]."</legend>";
				$script.="\n                                            <div class=\"row\">";
					// $script.="\n                                        {!! method_field('POST') !!}";
					for($r=0;$r<count($fieldNameArr);$r++){
						if($fieldSectionsArr["$r"]==$sectionsArr[$s]){
							if($inputTypesArr[$r]=="image" || $inputTypesArr[$r]=="file"){
							}else{
							$script.="\n                                <div class=\"form-group\">";
							$script.="\n                                    <label for=\"".$inputCasedNameArr[$r]."\" class=\"col-sm-3 control-label\">".$inputCasedNameArr[$r]."</label>";
							$script.="\n                                    <div class=\"col-sm-6\">";		
							}
							if($indexTypesArr[$r]=="foreign_key"){
								$script.="\n									    <select class=\"form-control selectpicker\" data-size=\"100000\" data-live-search=\"true\" data-style=\"btn-white\" name=\"$fieldNameArr[$r]\" ";

								$script.=" id=\"$fieldNameArr[$r]\">";
								$script.="\n                                            <option value=\"\" >Select ".$inputCasedNameArr[$r]."</option>";
								$script.="				                                @foreach ($".$_POST["module_table_name"]."data['".strtolower($parentModulesArr[$r])."'] as $".strtolower($parentModulesArr[$r]).")";
								$script.="\n				                                <option value=\"{!! $".strtolower($parentModulesArr[$r])."->".$keysArr[$r]." !!}\">
								";
								$values=explode(",",$valuesArr[$r]);
								for($c=0;$c<count($values);$c++){
									
									$script.="\n				                                {!! $".strtolower($parentModulesArr[$r])."->".$values[$c]."!!}";

								}
								$script.="\n				                                </option>";
								$script.="\n				                                @endforeach";
								$script.="\n                                        </select>";
							}else{
								if($inputTypesArr[$r]=="date"){

									$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."from\"";


								$script.=" id=\"".$fieldNameArr[$r]."from\" class=\"form-control m-b-5\" placeholder=\"".$inputCasedNameArr[$r]." From\" value=\"\">";

									$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."to\"";
									

								$script.=" id=\"".$fieldNameArr[$r]."to\" class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]." To\" value=\"\">";


								}else if($inputTypesArr[$r]=="textarea"){
									$script.="\n                                        <Textarea name=\"".$fieldNameArr[$r]."\" ";

								$script.=" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" row=\"5\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\"></textarea>";

								}else if($inputTypesArr[$r]=="phonenumber"){
									$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."\"  ";

								$script.=" placeholder=\"(999) 999-9999\" id=\"masked-input-phone\" class=\"form-control\"  value=\"\">";

								}else if($inputTypesArr[$r]=="emailaddress"){
									$script.="\n                                        <input type=\"email\" name=\"".$fieldNameArr[$r]."\"  ";

								$script.="  class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

								}else if($inputTypesArr[$r]=="image"){
									$script.="\n                                        <input type=\"file\" name=\"".$fieldNameArr[$r]."\" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" ";

								$script.=" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

								}else if($inputTypesArr[$r]=="file"){
									$script.="\n                                        <input type=\"file\" name=\"".$fieldNameArr[$r]."\" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" ";

								$script.=" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

								}else if($inputTypesArr[$r]=="checkbox"){
									$script.="\n                                        <input type=\"checkbox\" name=\"".$fieldNameArr[$r]."\" id=\"".$fieldNameArr[$r]."\" ";

								$script.="  placeholder=\"".$inputCasedNameArr[$r]."\" value=\"1\">";

								}else{
									$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."\" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" ";

								$script.=" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

								}
							
							}
							if($inputTypesArr[$r]=="image" || $inputTypesArr[$r]=="file"){
							}else{				
								$script.="\n                                    </div>";
								$script.="\n                                </div>";
							}


						}
					}


				$script.="\n                                            </div>";
				$script.="\n                                        </fieldset>";
				$script.="\n									</div>";

			}

			$script.="\n								</div>";
		}else{
			// $script.="\n                                        {!! method_field('POST') !!}";
			for($r=0;$r<count($fieldNameArr);$r++){
				if($inputTypesArr[$r]=="image" || $inputTypesArr[$r]=="file"){
				}else{
				$script.="\n                                <div class=\"form-group\">";
				$script.="\n                                    <label for=\"".$inputCasedNameArr[$r]."\" class=\"col-sm-3 control-label\">".$inputCasedNameArr[$r]."</label>";
				$script.="\n                                    <div class=\"col-sm-6\">";		
				}
				if($indexTypesArr[$r]=="foreign_key"){
					$script.="\n									    <select class=\"form-control selectpicker\" data-size=\"100000\" data-live-search=\"true\" data-style=\"btn-white\" name=\"$fieldNameArr[$r]\" ";

								$script.=" id=\"$fieldNameArr[$r]\">";
					$script.="\n                                            <option value=\"\" >Select ".$inputCasedNameArr[$r]."</option>";
					$script.="				                                @foreach ($".$_POST["module_table_name"]."data['".strtolower($parentModulesArr[$r])."'] as $".strtolower($parentModulesArr[$r]).")";
					$script.="\n				                                <option value=\"{!! $".strtolower($parentModulesArr[$r])."->".$keysArr[$r]." !!}\">
					";
					$values=explode(",",$valuesArr[$r]);
					for($c=0;$c<count($values);$c++){
						
						$script.="\n				                                {!! $".strtolower($parentModulesArr[$r])."->".$values[$c]."!!}";

					}
					$script.="\n				                                </option>";
					$script.="\n				                                @endforeach";
					$script.="\n                                        </select>";
				}else{
					if($inputTypesArr[$r]=="date"){


									$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."from\"";


								$script.=" id=\"".$fieldNameArr[$r]."from\" class=\"form-control m-b-5\" placeholder=\"".$inputCasedNameArr[$r]." From\" value=\"\">";

									$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."to\"";
									

								$script.=" id=\"".$fieldNameArr[$r]."to\" class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]." To\" value=\"\">";


					}else if($inputTypesArr[$r]=="textarea"){
						$script.="\n                                        <Textarea name=\"".$fieldNameArr[$r]."\" id=\"".$fieldNameArr[$r]."\" ";

								$script.=" class=\"form-control\" row=\"5\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\"></textarea>";

					}else if($inputTypesArr[$r]=="phonenumber"){
						$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."\" ";

								$script.=" id=\"masked-input-phone\" placeholder=\"(999) 999-9999\"  class=\"form-control\"  value=\"\">";

					}else if($inputTypesArr[$r]=="emailaddress"){
												$script.="\n                                        <input type=\"email\" name=\"".$fieldNameArr[$r]."\"  ";

											$script.="  class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\"/>";

					}else if($inputTypesArr[$r]=="image"){

					}else if($inputTypesArr[$r]=="file"){

					}else if($inputTypesArr[$r]=="checkbox"){
						$script.="\n                                        <input type=\"checkbox\" name=\"".$fieldNameArr[$r]."\" ";

								$script.=" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"1\">";

					}else{
						$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."\" ";

								$script.=" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

					}
				
				}
				if($inputTypesArr[$r]=="image" || $inputTypesArr[$r]=="file"){
				}else{				
					$script.="\n                                    </div>";
					$script.="\n                                </div>";
				}
			}

		}	
		$script.="\n                                <div class=\"form-group\">";
		$script.="\n                                    <div class=\"col-sm-offset-3 col-sm-6\">";
		$script.="\n                                    <div class=\"col-sm-offset-3 col-sm-6\">";
		$script.="\n                                        <button type=\"submit\" class=\"btn btn-sm btn-inverse\">";
		$script.="\n                                            <i class=\"fa fa-btn fa-search\"></i> Search ".$_POST['table_module_name'];
		$script.="\n                                        </button>";
		$script.="\n                                    </div>";
		$script.="\n                                </div>";			
		$script.="\n                    </form>";

		$script.="\n                            </div>";
		$script.="\n                        </div>";
		$script.="\n                    </div>";
		$script.="\n                </div>";
		$script.="\n            </div>";
		$script.="\n            <div class=\"modal-footer\">";
		$script.="\n                <a href=\"javascript:;\" class=\"btn btn-sm btn-white\" data-dismiss=\"modal\">Close</a>";
		$script.="\n            </div>";
		$script.="\n        </div>";
		$script.="\n    </div>";
		$script.="\n</div>";
		$script.="\n@endsection";
		$script.="\n@section('script')";
		for($r=0;$r<count($fieldNameArr);$r++){
			if($inputTypesArr[$r]=="date"){
				$script.="\n<script language=\"javascript\" type=\"text/javascript\">";
				$script.="\n$(\"#".$fieldNameArr[$r]."from\").datepicker({todayHighlight:!0,autoclose:!0});";
				$script.="\n$(\"#".$fieldNameArr[$r]."to\").datepicker({todayHighlight:!0,autoclose:!0});";
				$script.="\n</script>";

			}
		}
		$script.="\n@endsection";

if(!empty($_POST["table_name"])){
	$directoryName="../../resources/views/admin/".$_POST["table_name"]."/";
	if(!is_dir($directoryName)){
	    //Directory does not exist, so lets create it.
	    mkdir($directoryName, 0755, true);
	}	
	$myfile = fopen("../../resources/views/admin/".$_POST["table_name"]."/index.blade.php", "w") or die("Unable to open file!");
	$txt = $script;
	fwrite($myfile, $txt);
	fclose($myfile);
	echo "table Created Successfuly....";	
}else{
	echo "empty name";
}

?>