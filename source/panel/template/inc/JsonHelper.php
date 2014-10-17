<?php

class JsonHelper
{
    static function updateSiteJson($pName, $pLevel, $pPictures, $pDetail, $pThumbnail, $pCoordX, $pCoordY)
    {
        $pictureAddresses = explode(";", $pPictures);
        $rootPath = $_SERVER['DOCUMENT_ROOT'] . "/PRCMS_Panel/";
        $projectsAddress = 'projects/';
        $realPath = $rootPath . $projectsAddress;
        $levelPath = $realPath . $pLevel . "/";
        $projectsPath = $levelPath . $pName . "/";
        JsonHelper::make_path($projectsPath);

        $projectJson = JsonHelper::makeJsonProject($pictureAddresses, $projectsPath, $pName, $pDetail, $pThumbnail, $pCoordX, $pCoordY);

        $carousel = array();

        $path = $rootPath . "main.json";
        if (!file_exists($path)) {
            $siteFile = fopen($path, "w+") or die("Unable to open file!");
            $siteJson = $carousel;
            $siteJson["homeCarousel"] = array();
            $siteJson["projectSections"] = array(array("caption" => $pLevel, "projects" => array()));
            //$log .= "caption was changed\n";
        } else {
            $string = file_get_contents($path);
            $siteJson = json_decode($string, true);
            $siteFile = fopen($path, "w+") or die("Unable to open file!");
        }


        $l_index = getLevelIndex($siteJson, $pLevel);
        if ($l_index < 0) {
            $levelJson = array("caption" => $pLevel, "projects" => array());
            $l_index = array_push($siteJson["projectSections"], $levelJson) - 1;
        } else {
            $levelJson = $siteJson["projectSections"][intval($l_index)];
        }

        if (!isset($levelJson["projects"]) || !is_array($levelJson["projects"])) {
            $levelJson["caption"] = $pLevel;
            $levelJson["projects"] = array();
        }

        array_push($levelJson["projects"], $projectJson);

//////////////////////////////////make site json////////////////////////////////
        $siteJson["homeCarousel"] = array();
        $siteJson["projectSections"][$l_index] = $levelJson;


        fwrite($siteFile, json_encode($siteJson));
        fclose($siteFile);

    }

    static function findFileName($path)
    {
        $index = strripos($path, "/");
        return substr($path, $index + 1);
    }

    static function getLevelIndex($json, $levelName)
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

    static function make_path($pathname, $is_filename = false)
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

        if (JsonHelper::make_path($next_pathname, $is_filename)) {
            if (!file_exists($pathname)) {
                return mkdir($pathname, $is_filename);
            }
        }
        return false;
    }

    static function makeSiteJson($rootPath, $pLevel)
    {
        $path = $rootPath . "main.json";
        if (!file_exists($path)) {
            $siteFile = fopen($path, "w+") or die("Unable to open file!");
            $siteJson = array();
            $siteJson["homeCarousel"] = array();
            $siteJson["projectSections"] = array(array("caption" => $pLevel, "projects" => array()));
            //$log .= "caption was changed\n";
        } else {
            $string = file_get_contents($path);
            $siteJson = json_decode($string, true);
            $siteFile = fopen($path, "w+") or die("Unable to open file!");
        }
        return $siteJson;

    }

    private static function makeJsonProject($pictureAddresses, $projectsPath, $pName, $pDetail, $pThumbnail, $pCoordX, $pCoordY)
    {
        $gallery = array();
        $i = 0;
        foreach ($pictureAddresses as $pictureAddress) {
            $fileName = JsonHelper::findFileName($pictureAddress);
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
        $projectJson["name"] = $pName;
        $projectJson["address"] = $pDetail;
        $projectJson["thumbnail"] = array("address" => $pThumbnail);
        $projectJson["coordinate"] = array("x" => $pCoordX, "y" => $pCoordY);

        $projectJson['gallery'] = $gallery;
        return $projectJson;
    }
} 