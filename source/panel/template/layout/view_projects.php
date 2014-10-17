<?php
$rootPath = $_SERVER['DOCUMENT_ROOT'] . "/PRCMS_Panel/";
$projectsAddress = 'projects/';
$realPath = $rootPath . $projectsAddress;

$path = $rootPath . "main.json";

if (!file_exists($path)) {
    echo "There is no any project json file.";
    return;
} else {
    $string = file_get_contents($path);
    $siteJson = json_decode($string, true);
    //$siteFile = fopen($path, "w+") or die("Unable to open file!");
}
$levelsJson = $siteJson["projectSections"];
?>

<table align="center" style="width: 50%; border: 1px dashed #00AAFF;" >

    <?php

    foreach ($levelsJson as $level) {
        $projectsJson = $level["projects"];
        $caption = $level["caption"];
        echo "<tr style='background-color: #00AAFF; text-align: center'><td colspan='2'>$caption</td></tr>";
        echo "<tr style='background-color: #EEE;'>" .
            "<td>name</td>" .
            "<td>address</td>" .
            "</tr>";
        foreach ($projectsJson as $project) {
            $name = $project["name"];
            $address = $project["address"];
            echo "<tr>" .
                "<td>$name</td>" .
                "<td>$address</td>" .
                "</tr>";
        }

    }
    ?>
</table>