<?php
if(!empty($_POST["model_name"])){
	$myfile = fopen("../../app/".$_POST["model_name"].".php", "w") or die("Unable to open file!");
	$txt = "<?php".$_POST["model_script"];
	fwrite($myfile, $txt);
	fclose($myfile);
	echo "Model Created Successfuly....";	
}else{
	echo "empty name";
}
?>