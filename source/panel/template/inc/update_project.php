<?php
require "JsonHelper.php";
echo "do you wanna dick?";
JsonHelper::deleteProject(
    $_POST['p_names'],
    $_POST['p_levels']
);
JsonHelper::updateSiteJson(
    $_POST['p_name'],
    $_POST['p_level'],
    $_POST['p_pictures'],
    $_POST['p_detail'],
    $_POST['p_thumbnail'],
    $_POST['p_coordinatex'],
    $_POST['p_coordinatey']
);
