<?php
$script="@extends('admin.home')";
$script.="\n@section('main_content')";
$script.="\n		<div id=\"content\" class=\"content\">";
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
$fieldNameArr=explode(",",$_POST["field_names"]);
$inputCasedNameArr=explode(",",$_POST["input_cased_name"]);
$indexTypesArr=explode(",",$_POST["index_types"]);
$valuesArr=explode("#",$_POST["values"]);
$parentModulesArr=explode(",",$_POST["parent_modules"]);
$keysArr=explode(",",$_POST["keys"]);
$inputTypesArr=explode(",",$_POST['input_types']);
$fieldSectionsArr=explode(",",$_POST["field_sections"]);
$fieldSectionsDescription=explode(",",$_POST["field_sections_description"]);
$sectionsArr=explode(",",$_POST["sections_name"]);
$formType=$_POST["form_type"];
$script.="\n            <div class=\"profile-container\">";
$script.="\n                <div class=\"profile-section\">";
$script.="\n                        <div class=\"profile-info\">";
$script.="\n                            <div class=\"table-responsive\">";
$script.="\n                                <table class=\"table table-profile\">";
$script.="\n                                    <thead>";
$script.="\n                                    	<tr class=\"highlight\">";
$script.="\n                                    		<td>".$_POST['form_module_name']."</td>";
$script.="\n                                    		<td>Profile Data</td>";
$script.="\n                                    	</tr>";
$script.="\n                                        <tr class=\"divider\">";
$script.="\n                                            <td colspan=\"2\"></td>";
$script.="\n                                        </tr>";
$script.="\n                                    </thead>";
$script.="\n                                    <tbody>";
if($formType=="wizard"){
	
	$sectionsDescriptionArr=explode(",",$_POST["sections_description"]);

	if($sectionsArr!=null){
		for($s=0;$s<count($sectionsArr);$s++){
			$script.="\n                                    	<tr class=\"highlight\">";
			$script.="\n                                    		<td>".$sectionsArr[$s]."</td>";
			$script.="\n                                    		<td>".$sectionsDescriptionArr[$s]."</td>";
			$script.="\n                                    	</tr>";
			// $script.="\n                                        <tr class=\"divider\">";
			// $script.="\n                                            <td colspan=\"2\"></td>";
			// $script.="\n                                        </tr>";
				for($r=0;$r<count($fieldNameArr);$r++){
					if($fieldSectionsArr["$r"]==$sectionsArr[$s]){
						$script.="\n                                        <tr>";
						$script.="\n                                            <td class=\"field\">".$inputCasedNameArr[$r]."</td>";
						$script.="\n                                            <td>";

							if($indexTypesArr[$r]=="foreign_key"){
								$script.="				                                @foreach ($".$_POST["module_form_name"]."data['".strtolower($parentModulesArr[$r])."'] as $".strtolower($parentModulesArr[$r]).")";
								$script.="\n				                                @if( $".strtolower($parentModulesArr[$r])."->".$keysArr[$r]."  ==  $".$_POST["module_form_name"]."data['data']->".$fieldNameArr[$r]."  )";
								$values=explode(",",$valuesArr[$r]);
								for($c=0;$c<count($values);$c++){
									
									$script.="\n				                                {!! $".strtolower($parentModulesArr[$r])."->".$values[$c]."!!}";

								}							
								$script.="\n				                                @endif";				

								$script.="\n				                                @endforeach";							
							}else{
								if($inputTypesArr[$r]=="image"){
									$script.="<img src=\"{!!asset('uploads/images/'.$".$_POST["module_form_name"]."data['data']->".$fieldNameArr[$r].")!!}\" width='164' height='164'/>";
								}else{
									$script.="\n                                            {!! $".$_POST["module_form_name"]."data['data']->".$fieldNameArr[$r]." !!}";
								}
								
							}

						$script.="\n                                            </td>";
						$script.="\n                                        </tr>";

					}
				}

		}


	}

	
}else{

			for($r=0;$r<count($fieldNameArr);$r++){
						$script.="\n                                        <tr>";
						$script.="\n                                            <td class=\"field\">".$inputCasedNameArr[$r]."</td>";
						$script.="\n                                            <td>";

							if($indexTypesArr[$r]=="foreign_key"){
								$script.="				                                @foreach ($".$_POST["module_form_name"]."data['".strtolower($parentModulesArr[$r])."'] as $".strtolower($parentModulesArr[$r]).")";
								$script.="\n				                                @if( $".strtolower($parentModulesArr[$r])."->".$keysArr[$r]."  ==  $".$_POST["module_form_name"]."data['data']->".$fieldNameArr[$r]."  )";
								$values=explode(",",$valuesArr[$r]);
								for($c=0;$c<count($values);$c++){
									
									$script.="\n				                                {!! $".strtolower($parentModulesArr[$r])."->".$values[$c]."!!}";

								}							
								$script.="\n				                                @endif";				

								$script.="\n				                                @endforeach";							
							}else{
								if($inputTypesArr[$r]=="image"){
									$script.="<img src=\"{!!asset('uploads/images/'.$".$_POST["module_form_name"]."data['data']->".$fieldNameArr[$r].")!!}\" width='164' height='164'/>";
								}else{
									$script.="\n                                            {!! $".$_POST["module_form_name"]."data['data']->".$fieldNameArr[$r]." !!}";
								}
							}
						$script.="\n                                            </td>";
						$script.="\n                                        </tr>";

					

			}
			

}

$script.="\n                                    </tbody>";
$script.="\n                                </table>";
$script.="\n                            </div>";
$script.="\n                        </div>";
$script.="\n                </div>";
$script.="\n            </div>";
$script.="\n		</div>";
if(!empty($_POST["form_name"])){
	$directoryName="../../resources/views/admin/".$_POST["form_name"]."/";
	if(!is_dir($directoryName)){
	    //Directory does not exist, so lets create it.
	    mkdir($directoryName, 0755, true);
	}	
	$myfile = fopen("../../resources/views/admin/".$_POST["form_name"]."/show.blade.php", "w") or die("Unable to open file!");
	$txt = $script;
	fwrite($myfile, $txt);
	fclose($myfile);
	echo "Profile Created Successfuly....";	
	
}else{
	echo "empty name";
}