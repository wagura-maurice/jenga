<?php
        $script="@extends('admin.home')";
        $script.="\n@section('main_content')";
        $script.="\n<style type=\"text/css\">\n#report-header{\n\twidth: 100%;\n\theight: 162px;\n\tfont-weight: bold;\n\tcolor:#000;\n}\n#report-header table{\n\twidth:100%;\n}\n#report-header table tbody tr td{\n\twidth:33%;\n}\n</style>";
        $script.="\n<div id='content' class='content'>";
        $script.="\n            <ol class=\"breadcrumb hidden-print pull-right\">";
        $script.="\n                <li><a href=\"javascript:;\">Home</a></li>";
        $script.="\n                <li class=\"active\">".$_POST["report_module_name"]."</li>";
        $script.="\n            </ol>";
        $script.="\n            <h1 class=\"page-header hidden-print\">".$_POST["report_module_name"]." <small>".strtolower($_POST["report_module_name"])." report goes here...</small></h1>";
        $script.="\n            <div class=\"row no-print\">";
        $script.="\n                <div class=\"col-md-12 hidden-print\">";
        $script.="\n                    <a href=\"{!! route('".$_POST['module_report_name'].".index') !!}\"><button type=\"button\" class=\"btn btn-inverse btn-icon btn-circle m-b-10\"><i class=\"fa fa-arrow-left\"></i></button></a>";
        $script.="\n                </div>";
        $script.="\n            </div>";        
        $script.="\n            <div class=\"invoice\">";
        $script.="\n                <div class=\"invoice-company\">";
        $script.="\n                    <span class=\"pull-right hidden-print\">";
        $script.="\n                    <a href=\"javascript:;\" class=\"btn btn-sm btn-success m-b-10\"><i class=\"fa fa-download m-r-5\"></i> Export as PDF</a>";
        $script.="\n                    <a href=\"javascript:;\" onclick=\"window.print()\" class=\"btn btn-sm btn-success m-b-10\"><i class=\"fa fa-print m-r-5\"></i> Print</a>";        
        $script.="\n                    </span>";
        $script.="\n                </div>";
        $script.="\n                <div class=\"text-center\" id=\"report-header\" >";        
        $script.="\n                    <table>";
        $script.="\n                        <tbody>";
        $script.="\n                            <tr>
                                <td></td><td><img src=\"{!!asset('uploads/images/'.$".$_POST['module_report_name']."data['company'][0]->logo)!!}\"   height='70px'/></td><td></td>
                            </tr>";
        $script.="\n                    <div class=\"invoice-date\">";
        $script.="\n                            <tr>
                                <td></td><td class=\"text-center\" style=\"font-size:18px; font-weight:bold; color:#000;\">{!! $".$_POST['module_report_name']."data['company'][0]->name!!}</td><td></td></tr>";
        $script.="\n                            <tr>
                                <td></td><td class=\"text-center\" style=\"color:#000; font-weight: bold; font-family: segoi-ui;\">{!! $".$_POST['module_report_name']."data['company'][0]->street!!} {!! $".$_POST['module_report_name']."data['company'][0]->address!!}</td><td></td>
                                
                            </tr>";
        $script.="\n                            <tr>
                                <td></td><td class=\"text-center\" style=\"color:#000; font-weight: bold; font-family: segoi-ui;\">{!! $".$_POST['module_report_name']."data['company'][0]->city!!}, {!! $".$_POST['module_report_name']."data['company'][0]->zip_code!!}</td><td></td>
                                
                            </tr>";
        $script.="\n                            <tr>
                                <td></td><td class=\"text-center\" style=\"color:#000; font-weight: bold; font-family: segoi-ui;\">Phone: {!! $".$_POST['module_report_name']."data['company'][0]->phone_number!!}</td><td></td>
                                
                            </tr>";
        $script.="\n                        </tbody>";
        $script.="\n                    </table>";
        $script.="\n                </div>";

        $script.="\n                <div class=\"invoice-content\">";
        $script.="\n                    <div class=\"table-responsive\">";
        $script.="\n                        <table class=\"table table-invoice\">";
        $script.="\n                        <thead>";
        $script.=$_POST["report_header_script"];
        $script.="\n                        </thead>";
        $script.="\n                        <tbody>";
        $script.="\n                        @foreach ($".$_POST['module_report_name']."data['list'] as $".$_POST['module_report_name'].")";
        $script.="\n                            <tr>";
        $indexTypeArr=explode(",",$_POST["report_row_index_types"]);
        $indexValueArr=explode("#",$_POST["report_row_index_values"]);
        $rowFieldNameArr=explode(",",$_POST["report_row_field_names"]);
        $inputTypesArr=explode(",",$_POST['report_row_input_types']);
        $rowNameArr=explode(",",$_POST["report_row_name"]);
        for($r=0;$r<count($rowNameArr);$r++){
            if($r<8){
                $script.="\n                                <td class='table-text'><div>";
                if($indexTypeArr[$r]=="foreign_key"){
                    $values=explode(",",$indexValueArr[$r]);
                    for($c=0;$c<count($values);$c++){
                        $script.="\n                                    {!! $".$_POST['module_report_name']."->".$rowFieldNameArr[$r]."model->".$values[$c]." !!}";    
                    }
                    
                }else{
                    if($inputTypesArr[$r]=="image"){
                        $script.="\n                                    <img src=\"{!!asset('uploads/images/'.$".$_POST['module_report_name']."->".$rowNameArr[$r].")!!}\" width='64' height='64'/>";

                    }else if($inputTypesArr[$r]=="checkbox"){
                        $script.="\n                                    @if($".$_POST['module_report_name']."->".$rowNameArr[$r]."=='1') YES @else NO @endif";
                    }else{
                        $script.="\n                                    {!! $".$_POST['module_report_name']."->".$rowNameArr[$r]." !!}";

                    }                    
                    
                }
                
                $script.="\n                                </div></td>";    
            }
  
        }

        $script.="\n                            </tr>";
        $script.="\n                        @endforeach";
        $script.="\n                        </tbody>";
        $script.="\n                        </table>";
        $script.="\n                    </div>";
        $script.="\n                    <div class=\"invoice-price\">";
        $script.="\n                        <div class=\"invoice-price-left\">";
        $script.="\n                            <div class=\"invoice-price-row\">";
        // $script.="\n                                <div class=\"sub-price\">";
        // $script.="\n                                    <small>SUBTOTAL</small>";
        // $script.="\n                                    $4,500.00";
        // $script.="\n                                </div>";
        // $script.="\n                                <div class=\"sub-price\">";
        // $script.="\n                                    <i class=\"fa fa-plus\"></i>";
        // $script.="\n                                </div>";
        // $script.="\n                                <div class=\"sub-price\">";
        // $script.="\n                                    <small>PAYPAL FEE (5.4%)</small>";
        // $script.="\n                                    $108.00";
        // $script.="\n                                </div>";
        $script.="\n                            </div>";
        $script.="\n                        </div>";
        $script.="\n                        <div class=\"invoice-price-right\">";
        $script.="\n                            <small>TOTAL COUNT</small> {!!count($".$_POST['module_report_name']."data['list'])!!}";
        $script.="\n                        </div>";
        $script.="\n                    </div>";
        $script.="\n                </div>";
        // $script.="\n                <div class=\"invoice-note\">";
        // $script.="\n                    * Make all cheques payable to {!! $".$_POST['module_report_name']."data['company'][0]->name!!}<br />";
        // $script.="\n                    * Payment is due within 30 days<br />";
        // $script.="\n                    * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]";
        // $script.="\n                </div>";
        $script.="\n                <div class=\"invoice-footer text-muted\">";
        $script.="\n                    <p class=\"text-center m-b-5\">";
        $script.="\n                    </p>";
        $script.="\n                    <p class=\"text-center\">";
        $script.="\n                        <span class=\"m-r-10\"><i class=\"fa fa-globe\"></i> {!! $".$_POST['module_report_name']."data['company'][0]->website!!}</span>";
        $script.="\n                        <span class=\"m-r-10\"><i class=\"fa fa-phone\"></i> T:{!! $".$_POST['module_report_name']."data['company'][0]->phone_number!!}</span>";
        $script.="\n                        <span class=\"m-r-10\"><i class=\"fa fa-envelope\"></i> {!! $".$_POST['module_report_name']."data['company'][0]->email_address!!}</span>";
        $script.="\n                    </p>";
        $script.="\n                </div>";
        $script.="\n            </div>";
        $script.="\n</div>";
        $script.="\n@endsection";


if(!empty($_POST["report_name"])){
    $directoryName="../../resources/views/admin/".$_POST["report_name"]."/";
    if(!is_dir($directoryName)){
        //Directory does not exist, so lets create it.
        mkdir($directoryName, 0755, true);
    }   
    $myfile = fopen("../../resources/views/admin/".$_POST["report_name"]."/report.blade.php", "w") or die("Unable to open file!");
    $txt = $script;
    fwrite($myfile, $txt);
    fclose($myfile);
    echo "Report Created Successfuly....";   
}else{
    echo "empty name";
}
?>