<?php
echo "Go hell";
require "JsonHelper.php";
JsonHelper::updateSiteJson(
    $_POST['p_name'],
    $_POST['p_level'],
    $_POST['p_pictures'],
    $_POST['p_detail'],
    $_POST['p_thumbnail'],
    $_POST['p_coordinatex'],
    $_POST['p_coordinatey']
);