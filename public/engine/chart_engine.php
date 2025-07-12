<?php
$script="@extends(\"admin.home\")";
$script.="\n@section(\"main_content\")";
$script.="\n		<div id=\"content\" class=\"content\">";
$script.="\n			<ol class=\"breadcrumb pull-right\">";
$script.="\n				<li><a href=\"#\">Home</a></li>";
$script.="\n				<li><a href=\"#\">".$_POST["module_chart_name_"]."</a></li>";
$script.="\n				<li class=\"active\">Chart</li>";
$script.="\n			</ol>";
$script.="\n			<h1 class=\"page-header\">".$_POST["module_chart_name_"]." Chart <small>".strtolower($_POST["module_chart_name_"])." chart goes here...</small></h1>";
$script.="\n            <div class=\"row\">";
$script.="\n                <div class=\"col-md-12\">";
$script.="\n                    <a href=\"{!! route('".$_POST['module_chart_name'].".index') !!}\"><button type=\"button\" class=\"btn btn-inverse btn-icon btn-circle m-b-10\"><i class=\"fa fa-arrow-left\"></i></button></a>";
$script.="\n                </div>";
$script.="\n            </div>";
$script.="\n			<div class=\"row\">";
$script.="\n			    <div class=\"col-md-6\">";
$script.="\n                    <div class=\"panel panel-inverse\" data-sortable-id=\"chart-js-1\">";
$script.="\n                        <div class=\"panel-heading\">";
$script.="\n                            <div class=\"panel-heading-btn\">";
$script.="\n                                <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-default\" data-click=\"panel-expand\"><i class=\"fa fa-expand\"></i></a>";
$script.="\n                                <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-success\" data-click=\"panel-reload\"><i class=\"fa fa-repeat\"></i></a>";
$script.="\n                                <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-warning\" data-click=\"panel-collapse\"><i class=\"fa fa-minus\"></i></a>";
$script.="\n                                <a href=\"#\" class=\"btn btn-xs btn-icon btn-circle btn-danger\" data-click=\"panel-remove\"><i class=\"fa fa-times\"></i></a>";
$script.="\n                            </div>";
$script.="\n                            <h4 class=\"panel-title\">Line Chart</h4>";
$script.="\n                        </div>";
$script.="\n                        <div class=\"panel-body\">";
$script.="\n                            <p>";
$script.="\n                                A line chart is a way of plotting data points on a line.Often, it is used to show trend data, and the comparison of two data sets.";
$script.="\n                            </p>";
$script.="\n                            <div>";
$script.="\n                                <canvas id=\"line-chart\" data-render=\"chart-js\"></canvas>";
$script.="\n                            </div>";
$script.="\n                        </div>";
$script.="\n                    </div>";
$script.="\n		        </div>";
$script.="\n		    </div>";
$script.="\n		</div>";
$script.="\n@endsection";

if(!empty($_POST["chart_module_name"])){
    $directoryName="../../../resources/views/admin/".$_POST["chart_module_name"]."/";
    if(!is_dir($directoryName)){
        //Directory does not exist, so lets create it.
        mkdir($directoryName, 0755, true);
    }   
    $myfile = fopen("../../resources/views/admin/".$_POST["chart_module_name"]."/chart.blade.php", "w") or die("Unable to open file!");
    $txt = $script;
    fwrite($myfile, $txt);
    fclose($myfile);
    echo "Chart Created Successfuly....";   
}else{
    echo "empty name";
}
?>