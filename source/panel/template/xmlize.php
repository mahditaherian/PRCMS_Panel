<?php

//$path = $_SERVER['DOCUMENT_ROOT'] . '/PRCMS_Panel/upload/';
//$myfile = fopen("$path" . "newfile.txt", "w+") or die("Unable to open file!");
//fwrite($myfile, $_POST['p_detail']);

$pictureAddresses = explode(";", $_POST['p_pictures']);
$rootPath = $_SERVER['DOCUMENT_ROOT'] . "/PRCMS_Panel/";
$projectsAddress = 'projects/';
$realPath = $rootPath . $projectsAddress;
$levelPath = $realPath . $_POST['p_level'] . "/";
$projectsPath = $levelPath . $_POST['p_name'] . "/";
make_path($projectsPath);

$projectJson = makeJsonProject($pictureAddresses,$projectsPath);
//$mainProjectFile = fopen("$projectsPath" . "main.json", "w+") or die("Unable to open file!");
//fwrite($mainProjectFile, json_encode($projectJson));
//fclose($mainProjectFile);

$logFile = fopen("$rootPath" . "log.txt", "w+") or die("Unable to open file!");
$log = "";








//////////////////////////////////////make level json//////////////////////////////
//$siteJson = makeSiteJson($rootPath);
//public $siteJson ;
$path = $rootPath . "main.json";
if (!file_exists($path)) {
    $siteFile = fopen($path, "w+") or die("Unable to open file!");
    $siteJson = array();
    $siteJson["homeCarousel"] = array();
    $siteJson["projectSections"] = array(array("caption" => $_POST['p_level'], "projects" => array()));
    //$log .= "caption was changed\n";
} else {
    $string = file_get_contents($path);
    $siteJson = json_decode($string, true);
    $siteFile = fopen($path, "w+") or die("Unable to open file!");
}


//return $siteJson;
$l_index = getLevelIndex($siteJson, $_POST['p_level']);
//$log .= "$l_index\n";
if ($l_index < 0) {
    $levelJson = array("caption" => $_POST['p_level'], "projects" => array());
    $log.=json_encode($levelJson);
    $l_index = array_push($siteJson["projectSections"], $levelJson) - 1;
//    $log.=json_encode($siteJson["projectSections"]);
} else {
//$log .= "$l_index\n";
    $levelJson = $siteJson["projectSections"][intval($l_index)];
}

if (!isset($levelJson["projects"]) || !is_array($levelJson["projects"])) {
    $levelJson["caption"] = $_POST['p_level'];
    $levelJson["projects"] = array();
}

array_push($levelJson["projects"], $projectJson);

//////////////////////////////////make site json////////////////////////////////
$siteJson["homeCarousel"] = array();
$siteJson["projectSections"][$l_index] = $levelJson;


fwrite($siteFile, json_encode($siteJson));
fclose($siteFile);


fwrite($logFile, $log);
fclose($logFile);










function findFileName($path)
{
    $index = strripos($path, "/");
    return substr($path, $index + 1);
}

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

//function getProjectIndex($json, $projectName)
//{
//    return 0;
//}

function make_path($pathname, $is_filename = false)
{
    if ($is_filename) {
        $pathname = substr($pathname, 0, strrpos($pathname, '/'));
    }

    // Check if directory already exists
    if (is_dir($pathname) || empty($pathname)) {
        return true;
    }

    // Ensure a file does not already exist with the same name
    $pathname = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $pathname);
    if (is_file($pathname)) {
        trigger_error('mkdirr() File exists', E_USER_WARNING);
        return false;
    }

    // Crawl up the directory tree
    $next_pathname = substr($pathname, 0, strrpos($pathname, DIRECTORY_SEPARATOR));

    if (make_path($next_pathname, $mode)) {
        if (!file_exists($pathname)) {
            return mkdir($pathname, $mode);
        }
    }
    return false;
}

function makeSiteJson($rootPath){
    $path = $rootPath . "main.json";
    if (!file_exists($path)) {
        $siteFile = fopen($path, "w+") or die("Unable to open file!");
        $siteJson = array();
        $siteJson["homeCarousel"] = array();
        $siteJson["projectSections"] = array(array("caption" => $_POST['p_level'], "projects" => array()));
        //$log .= "caption was changed\n";
    } else {
        $string = file_get_contents($path);
        $siteJson = json_decode($string, true);
        $siteFile = fopen($path, "w+") or die("Unable to open file!");
    }
    return $siteJson;

}

function makeJsonProject($pictureAddresses,$projectsPath){
    $gallery = array();
    $i = 0;
    foreach ($pictureAddresses as $pictureAddress) {
        $fileName = findFileName($pictureAddress);
        $newRealPath = $projectsPath . $fileName;
//    $newPath = $imagesPath . $fileName;

        if (copy($pictureAddress, $newRealPath)) {
            unlink($pictureAddress);
            $picture = array();
            $picture['address'] = $fileName;
            $picture['caption'] = "No caption available yet.";
            $gallery[$i] = $picture;
            $i++;
        }
    }
    $projectJson = array();
    $projectJson["name"] = $_POST['p_name'];
    $projectJson["address"] = $_POST['p_detail'];
    $projectJson["thumbnail"] = array("address" => "Nothing yet(thumbnail)");
    $projectJson["coordinate"] = array("x,y" => "Nothing yet(coordinate)");

    $projectJson['gallery'] = $gallery;
    return $projectJson;
}

?>