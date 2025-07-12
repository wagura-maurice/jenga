<?php
$script="\n                    <li>";
$script.="\n                        <a href=\"{!! route('".$_POST['url'].".index') !!}\">";
$script.="\n                            <span>".$_POST['menu']."</span>";
$script.="\n                        </a>";
$script.="\n                    </li>";


 $myfile = file_put_contents('../../resources/views/admin/sidebar.blade.php', $script.PHP_EOL , FILE_APPEND | LOCK_EX);

 $script="\n//".$_POST['menu_controller']." routes .....";

 $myfile = file_put_contents('../../routes/web.php', $script.PHP_EOL , FILE_APPEND | LOCK_EX);


 $script="\nRoute::resource('admin/".$_POST['url']."','admin\\".$_POST['menu_controller']."Controller');";

 $myfile = file_put_contents('../../routes/web.php', $script.PHP_EOL , FILE_APPEND | LOCK_EX);


$script="\nRoute::get('/admin/".$_POST['url']."report', 'admin\\".$_POST['menu_controller']."Controller@report');";
$myfile = file_put_contents('../../routes/web.php', $script.PHP_EOL , FILE_APPEND | LOCK_EX);

$script="\nRoute::post('/admin/".$_POST['url']."filter', 'admin\\".$_POST['menu_controller']."Controller@filter');";

 $myfile = file_put_contents('../../routes/web.php', $script.PHP_EOL , FILE_APPEND | LOCK_EX);