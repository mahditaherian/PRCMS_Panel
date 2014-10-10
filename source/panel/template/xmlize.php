<?php

//$posts = json_decode(stripslashes($_POST['level']));

$path = $_SERVER['DOCUMENT_ROOT'].'/PRCMS_Panel/upload/';
$myfile = fopen("$path"."newfile.txt", "w+") or die("Unable to open file!");
//$txt = json_encode($posts);
fwrite($myfile, $_POST['p_detail']);

fclose($myfile);
?>