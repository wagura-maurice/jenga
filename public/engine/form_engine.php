<?php
		$script="@extends(\"admin.home\")";
		$script.="\n@section(\"main_content\")";
		$script.="\n<div id=\"content\" class=\"content\">";
		$script.="\n    <ol class=\"breadcrumb pull-right\">";
		$script.="\n        <li><a href=\"#\">Home</a></li>";
		$script.="\n        <li><a href=\"#\">public</a></li>";
		$script.="\n        <li><a href=\"#\">".$_POST['form_module_name']."</a></li>";
		$script.="\n        <li class=\"active\">form</li>";
		$script.="\n    </ol>";
		$script.="\n    <h1 class=\"page-header\">".$_POST['form_module_name']." Form <small>".strtolower($_POST['form_module_name'])." details goes here...</small></h1>";
		$script.="\n    <div class=\"row\">";
		$script.="\n        <div class=\"col-md-12\">";
		$script.="\n            <a href=\"{!! route('".$_POST['module_form_name'].".index') !!}\"><button type=\"button\" class=\"btn btn-inverse btn-icon btn-circle m-b-10\"><i class=\"fa fa-arrow-left\"></i></button></a>";
		$script.="\n        </div>";
		$script.="\n    </div>";
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
		$script.="\n                    <h4 class=\"panel-title\">DataForm - Autofill</h4>";
		$script.="\n                </div>";
		$script.="\n                <div class=\"panel-body\">";
		$fieldNameArr=explode(",",$_POST["field_names"]);
		$inputCasedNameArr=explode(",",$_POST["input_cased_name"]);
		$indexTypesArr=explode(",",$_POST["index_types"]);
		$valuesArr=explode("#",$_POST["values"]);
		$parentModulesArr=explode(",",$_POST["parent_modules"]);
		$keysArr=explode(",",$_POST["keys"]);
		$inputTypesArr=explode(",",$_POST['input_types']);
		$fieldSectionsArr=explode(",",$_POST["field_sections"]);
		$isRequiredArr=explode(",", $_POST["is_requireds"]);
		$fieldSectionsDescription=explode(",",$_POST["field_sections_description"]);


		$script.="\n                    <form id=\"form\"  class=\"form-horizontal\" enctype=\"multipart/form-data\">";

		$script.="\n                        {!! csrf_field() !!}";
		$formType=$_POST["form_type"];
		if($formType=="wizard"){
			$script.="\n								<div id=\"wizard\">";
			$script.="\n									<ol>";
			$sectionsArr=explode(",",$_POST["sections_name"]);
			$sectionsDescriptionArr=explode(",",$_POST["sections_description"]);
			for($s=0;$s<count($sectionsArr);$s++){
				$script.="\n										<li>";
				$script.="\n										".$sectionsArr[$s];
				$script.="\n										    <small>".$sectionsDescriptionArr[$s]."</small>";
				$script.="\n										</li>";
			}
			$script.="\n										<li>";
			$script.="\n										Completed";
			$script.="\n										    <small>Final Section</small>";
			$script.="\n										</li>";

			$script.="\n									</ol>";
			for($s=0;$s<count($sectionsArr);$s++){
				$script.="\n									<div>";
				$script.="\n                                        <fieldset>";
				$script.="\n                                            <legend class=\"pull-left width-full\">".$sectionsArr[$s]."</legend>";
				$script.="\n                                            <div class=\"row\">";
					// $script.="\n                                        {!! method_field('POST') !!}";
					for($r=0;$r<count($fieldNameArr);$r++){
						if($fieldSectionsArr["$r"]==$sectionsArr[$s]){
							$script.="\n                                <div class=\"form-group\">";
							$script.="\n                                    <label for=\"".$inputCasedNameArr[$r]."\" class=\"col-sm-3 control-label\">".$inputCasedNameArr[$r]."</label>";
							$script.="\n                                    <div class=\"col-sm-6\">";
							if($indexTypesArr[$r]=="foreign_key"){
								$script.="\n									    <select class=\"form-control selectpicker\" data-size=\"100000\" data-live-search=\"true\" data-style=\"btn-white\" name=\"$fieldNameArr[$r]\" ";

								$script.=" id=\"$fieldNameArr[$r]\">";
								$script.="\n                                            <option value=\"\" >Select ".$inputCasedNameArr[$r]."</option>";
								$script.="				                                @foreach ($".$_POST["module_form_name"]."data['".strtolower($parentModulesArr[$r])."'] as $".strtolower($parentModulesArr[$r]).")";
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

									$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."\"";

								$script.=" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\" data-date-format=\"dd-mm-yyyy\" data-date-end-date=\"Date.default\">";

								}else if($inputTypesArr[$r]=="time"){
									$script.="\n								        <div class=\"input-group date\" id=\"".$fieldNameArr[$r]."\">";
									$script.="\n                                            <input type=\"text\" class=\"form-control\" name=\"".$fieldNameArr[$r]."\" />";
									$script.="\n                                            <span class=\"input-group-addon\">";
									$script.="\n                                                <span class=\"glyphicon glyphicon-time\"></span>";
									$script.="\n                                            </span>";
									$script.="\n                                        </div>";

								}else if($inputTypesArr[$r]=="textarea"){
									$script.="\n                                        <Textarea name=\"".$fieldNameArr[$r]."\" ";

								$script.=" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" row=\"20\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\"></textarea>";

								}else if($inputTypesArr[$r]=="phonenumber"){
									$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."\"  ";

								$script.=" placeholder=\"(999) 999-9999\" id=\"".$fieldNameArr[$r]."\" class=\"form-control\"  value=\"\">";

								}else if($inputTypesArr[$r]=="emailaddress"){
									$script.="\n                                        <input type=\"email\" name=\"".$fieldNameArr[$r]."\"  ";

								$script.="  class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\"/>";

								}else if($inputTypesArr[$r]=="image"){
									$script.="\n                                        <input type=\"file\" name=\"".$fieldNameArr[$r]."\" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" ";

								$script.=" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

								}else if($inputTypesArr[$r]=="file"){
									$script.="\n                                        <input type=\"file\" name=\"".$fieldNameArr[$r]."\" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" ";

								$script.=" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

								}else if($inputTypesArr[$r]=="checkbox"){
									$script.="\n                                        <label class='control-label'><input type=\"checkbox\" name=\"".$fieldNameArr[$r]."\" id=\"".$fieldNameArr[$r]."\" ";

								$script.="  placeholder=\"".$inputCasedNameArr[$r]."\" value=\"1\"></label>";

								}else{
									$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."\" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" ";

								$script.=" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

								}
							
							}
							$script.="\n                                    </div>";
							$script.="\n                                </div>";

						}
					}
					// $script.="\n                                <div class=\"form-group\">";
					// $script.="\n                                    <div class=\"col-sm-offset-3 col-sm-6\">";
					// $script.="\n                                    <div class=\"col-sm-offset-3 col-sm-6\">";
					// $script.="\n                                        <button type=\"submit\" class=\"btn btn-sm btn-primary\">";
					// $script.="\n                                            <i class=\"fa fa-btn fa-plus\"></i> Add ".$_POST['form_module_name'];
					// $script.="\n                                        </button>";
					// $script.="\n                                    </div>";
					// $script.="\n                                </div>";

				$script.="\n                                            </div>";
				$script.="\n                                        </fieldset>";
				$script.="\n									</div>";

			}
			$script.="\n									<div>";
			$script.="\n									    <div class=\"jumbotron m-b-0 text-center\">";
			$script.="\n                                            <p>Final section. Review the data then click submit to complete registration wizard</p>";
			$script.="\n                                            <button class=\"btn-success btn-lg btn\" type='button' onclick='save()' id=\"btn-save\">Finish</button>";
			$script.="\n									</div>";
			$script.="\n								</div>";
		}else{
			// $script.="\n                                        {!! method_field('POST') !!}";
			for($r=0;$r<count($fieldNameArr);$r++){
				$script.="\n                                <div class=\"form-group\">";
				$script.="\n                                    <label for=\"".$inputCasedNameArr[$r]."\" class=\"col-sm-3 control-label\">".$inputCasedNameArr[$r]."</label>";
				$script.="\n                                    <div class=\"col-sm-6\">";
				if($indexTypesArr[$r]=="foreign_key"){
					$script.="\n									    <select class=\"form-control selectpicker\" data-size=\"100000\" data-live-search=\"true\" data-style=\"btn-white\" name=\"$fieldNameArr[$r]\" ";

								$script.=" id=\"$fieldNameArr[$r]\">";
					$script.="\n                                            <option value=\"\" >Select ".$inputCasedNameArr[$r]."</option>";
					$script.="				                                @foreach ($".$_POST["module_form_name"]."data['".strtolower($parentModulesArr[$r])."'] as $".strtolower($parentModulesArr[$r]).")";
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

						$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."\" ";

								$script.=" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

					}else if($inputTypesArr[$r]=="time"){
									$script.="\n								        <div class=\"input-group date\" id=\"".$fieldNameArr[$r]."\">";
									$script.="\n                                            <input type=\"text\" class=\"form-control\" name=\"".$fieldNameArr[$r]."\" data-date-format=\"dd-mm-yyyy\" data-date-end-date=\"Date.default\"/>";
									$script.="\n                                            <span class=\"input-group-addon\">";
									$script.="\n                                                <span class=\"glyphicon glyphicon-time\"></span>";
									$script.="\n                                            </span>";
									$script.="\n                                        </div>";

								}else if($inputTypesArr[$r]=="textarea"){
						$script.="\n                                        <Textarea name=\"".$fieldNameArr[$r]."\" id=\"".$fieldNameArr[$r]."\" ";

								$script.=" class=\"form-control\" row=\"20\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\"></textarea>";

					}else if($inputTypesArr[$r]=="phonenumber"){
						$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."\" ";

								$script.=" id=\"".$fieldNameArr[$r]."\" placeholder=\"(999) 999-9999\"  class=\"form-control\"  value=\"\">";

					}else if($inputTypesArr[$r]=="emailaddress"){
								
									$script.="\n                                        <input type=\"email\" name=\"".$fieldNameArr[$r]."\"  ";

								$script.="  class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\"/>";

					}else if($inputTypesArr[$r]=="image"){
						$script.="\n                                        <input type=\"file\" ";

								$script.=" name=\"".$fieldNameArr[$r]."\" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

					}else if($inputTypesArr[$r]=="file"){
						$script.="\n                                        <input type=\"file\" name=\"".$fieldNameArr[$r]."\" ";

								$script.=" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

					}else if($inputTypesArr[$r]=="checkbox"){
						$script.="\n                                        <label class='control-label'><input type=\"checkbox\" name=\"".$fieldNameArr[$r]."\" ";

								$script.=" id=\"".$fieldNameArr[$r]."\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"1\"></label>";

					}else{
						$script.="\n                                        <input type=\"text\" name=\"".$fieldNameArr[$r]."\" ";

								$script.=" id=\"".$fieldNameArr[$r]."\" class=\"form-control\" placeholder=\"".$inputCasedNameArr[$r]."\" value=\"\">";

					}
				
				}
				$script.="\n                                    </div>";
				$script.="\n                                </div>";
			}
			$script.="\n                                <div class=\"form-group\">";
			$script.="\n                                    <div class=\"col-sm-offset-3 col-sm-6\">";
			$script.="\n                                        <button type=\"button\" onclick=\"save()\" class=\"btn btn-sm btn-primary\" id=\"btn-save\">";
			$script.="\n                                            <i class=\"fa fa-btn fa-plus\"></i> Add ".$_POST['form_module_name'];
			$script.="\n                                        </button>";
			$script.="\n                                    </div>";
			$script.="\n                                </div>";

		}		
		$script.="\n                    </form>";
		$script.="\n                </div>";
		$script.="\n            </div>";
		$script.="\n        </div>";
		$script.="\n    </div>";
		$script.="\n</div>";
		$script.="\n<script language=\"javascript\" type=\"text/javascript\">";
		$script.="\nfunction save(){";
		$script.="\n\t$(\"#btn-save\").attr(\"disable\",true);";
		$script.="\n\tvar formData = new FormData($('#form')[0]);";
		$script.="\n\t$.ajax({";
		$script.="\n\t\ttype:'POST',";
		$script.="\n\t\turl: \"{!! route('".$_POST["module_form_name"].".store')!!}\",";
		$script.="\n\t\tdata:formData,";
		$script.="\n\t\tcache:false,";
		$script.="\n\t\tcontentType: false,";
		$script.="\n\t\tprocessData: false,";
		$script.="\n\t\tsuccess:function(data){";
		$script.="\n\t\t$(\"#btn-save\").attr(\"disable\",false);";
		$script.="\n\t\t\tvar obj = jQuery.parseJSON( data );";
		$script.="\n\t\t\tif(obj.status=='1'){";
		$script.="\n\t\t\t\t$.gritter.add({";
		$script.="\n\t\t\t\t\ttitle: 'Success',";
		$script.="\n\t\t\t\t\ttext: obj.message,";
		$script.="\n\t\t\t\t\tsticky: false,";
		$script.="\n\t\t\t\t\ttime: '1000',";
		$script.="\n\t\t\t\t});";
		$script.="\n\t\t\t\t$(\"#form\")[0].reset();";
		$script.="\n\t\t\t}else{";
		$script.="\n\t\t\t\t$.gritter.add({";
		$script.="\n\t\t\t\t\ttitle: 'Fail',";
		$script.="\n\t\t\t\t\ttext: obj.message,";
		$script.="\n\t\t\t\t\tsticky: false,";
		$script.="\n\t\t\t\t\ttime: '5000',";
		$script.="\n\t\t\t\t});";
		$script.="\n\t\t\t}";
		$script.="\n\t\t},";
		$script.="error: function(data){";
		$script.="\nconsole.log(data)";
		$script.="\n\t\t\t$.gritter.add({";
		$script.="\n\t\t\t\ttitle: 'Error',";
		$script.="\n\t\t\t\ttext: 'An Error occured. Please review your data then submit again!!',";
		$script.="\n\t\t\t\tsticky: false,";
		$script.="\n\t\t\t\ttime: '5000',";
		$script.="\n\t\t\t});";		
		$script.="\n\t\t}";
		$script.="\n\t});";
		$script.="\n\treturn false;";
		$script.="\n}";
		$script.="\n</script>";
		$script.="\n@endsection";
		$script.="\n@section('script')";
		$script.="\n<script language=\"javascript\" type=\"text/javascript\">";
		for($r=0;$r<count($fieldNameArr);$r++){
			
			if($inputTypesArr[$r]=="date"){
				
				$script.="\n$(\"#".$fieldNameArr[$r]."\").datepicker({todayHighlight:!0,autoclose:!0});";
				

			}else if($inputTypesArr[$r]=="time"){
				
				$script.="\n$(\"#".$fieldNameArr[$r]."\").datetimepicker({format:\"LT\"});";

				

			}else if($inputTypesArr[$r]=="phonenumber"){
				$script.="\n$(\"#".$fieldNameArr[$r]."\").mask(\"(999) 999-9999\");";
			}
			
		}
		$script.="\n</script>";
		$script.="\n@endsection";		

if(!empty($_POST["form_name"])){
	$directoryName="../../resources/views/admin/".$_POST["form_name"]."/";
	if(!is_dir($directoryName)){
	    //Directory does not exist, so lets create it.
	    mkdir($directoryName, 0755, true);
	}	
	$myfile = fopen("../../resources/views/admin/".$_POST["form_name"]."/create.blade.php", "w") or die("Unable to open file!");
	$txt = $script;
	fwrite($myfile, $txt);
	fclose($myfile);
	echo "Form Created Successfuly....";	
}else{
	echo "empty name";
}
?>