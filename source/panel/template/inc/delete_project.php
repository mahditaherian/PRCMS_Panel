<?php
$rootPath = $_SERVER['DOCUMENT_ROOT'] . "/PRCMS_Panel/";
$projectsAddress = 'projects/';
$realPath = $rootPath . $projectsAddress;
$logFile = fopen("$rootPath" . "log.txt", "w+") or die("Unable to open file!");
$log = "";
$path = $rootPath . "main.json";
if (!file_exists($path)) {
    $log .= ("There is no any project json file.");
    fwrite($logFile, $log);
    fclose($logFile);
    return;
} else {
    $string = file_get_contents($path);
    $siteJson = json_decode($string, true);

}

$l_index = getLevelIndex($siteJson, $_POST['p_level']);
$log .="level index = $l_index\n";
if ($l_index < 0) {
    $log .= ("There is no such level.");
    fwrite($logFile, $log);
    fclose($logFile);
    return;
}
$levelJson = $siteJson["projectSections"][$l_index];
$p_index = getProjectIndex($levelJson, $_POST['p_name']);
$log .="project index = $p_index\n";
if ($p_index < 0) {
    $log .= ("There is no such project.");
    fwrite($logFile, $log);
    fclose($logFile);
    return;
}
unset($levelJson["projects"][$p_index]);

//unset($siteJson["projectSections"][$l_index]["projects"][$p_index]);
$siteJson["projectSections"][$l_index] = $levelJson;

$siteFile = fopen($path, "w+") or die("Unable to open file!");
fwrite($siteFile, json_encode($siteJson));
fclose($siteFile);

$log .="Successful\n";
fwrite($logFile, $log);
fclose($logFile);

function getLevelIndex($json, $levelName)
{
    $i = 0;
    foreach ($json["projectSections"] as $level) {

        if ($level["caption"] === $levelName) {
            return $i;
        }
        $i++;
    }
    return -1;
}

function getProjectIndex($levelJson, $projectName)
{
    $i = 0;
    foreach ($levelJson["projects"] as $project) {

        if ($project["name"] === $projectName) {
            return $i;
        }
        $i++;
    }
    return -1;
}