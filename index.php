<?php
$basePath = substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/') + 1);
//$basePath = '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);;
$templatePath = "source/panel/template/";
//$basePath = "/PRCMS_Panel/"; //$_SERVER['REQUEST_URI'];
require $templatePath."main.php";