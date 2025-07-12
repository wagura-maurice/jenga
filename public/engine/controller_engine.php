
<?php
if(!empty($_POST["controller_name"])){
	$myfile = fopen("../../app/Http/Controllers/admin/".$_POST["controller_name"]."Controller.php", "w") or die("Unable to open file!");
	$txt = "<?php".$_POST["controller_script"];
	fwrite($myfile, $txt);
	fclose($myfile);
	echo "Controller Created Successfuly....";	
}else{
	echo "empty name";
}
?>