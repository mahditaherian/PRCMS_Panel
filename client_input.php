<?php
/**
 * Created by PhpStorm.
 * User: Mahdi
 * Date: 10/3/14
 * Time: 7:39 PM
 */

$result['homeCarousel'] = getCarousels();
$result['projectSections'] = getProjectSections();
echo json_encode($result);


function getCarousels()
{
    $mainDir = 'projects/carousel/main.xml';
    $mainXml = simplexml_load_file($mainDir);

    $carousels = array();
    for ($i = 0; $i < $mainXml->count(); $i++) {
        $pic = $mainXml->pic[$i];

        $carousels[$i] = array(
            "name" => $pic['name'] . "",
            "index" => $pic['index'] . "",
            "active" => $pic['active'] . ""
        );
    }
//    for ($i = 0; $i < 4; $i++) {
//        $carousels[$i] = array(
//            "name" => "media/home-carousel/slide$i.jpg",
//            "index" => $i,
//            "active" => $i == 0
//        );
//    }
    return $carousels;
}

function getProjectSections()
{
    return array(
        getFirstLevelProjects(),
        getSecondLevelProjects(),
    );
}

function getProjectByXml($projectXml)
{
    $project = array();
    $project['name'] = $projectXml->name."";
    $project['address'] = $projectXml->address."";
    $project['thumbnail'] = $projectXml->thumbnail->pic['name']."";

    $projectGalleryXml = $projectXml->gallery->pic;
    $projectGallery = array();
    for ($i = 0; $i < $projectGalleryXml->count(); $i++) {
        $pic = $projectGalleryXml[$i];
        $projectGallery[$i] = array(
            'address' => $pic['name']."",
            'caption' => $pic['desc'].""
        );
    }
    $project['imageGallery'] = $projectGallery;
    return $project;
}
function getProjects($level){
    $firstLevelProjects = array();
    $firstLevelProjectsDir = "projects/$level/";
    $mainDir = $firstLevelProjectsDir . 'main.xml';
    $mainXml = simplexml_load_file($mainDir);
    $firstLevelProjects['caption'] = $mainXml->caption."";
    $projectsXml = $mainXml->projects->project;
    $projects = array();

    for ($i = 0; $i < $projectsXml->count(); $i++) {
        $projectName = $projectsXml[$i]['name'];

        $project = getProjectByXml(simplexml_load_file($firstLevelProjectsDir . $projectName . "/main.xml"));
        $projects[$i] = $project;
    }
    $firstLevelProjects['projects'] = $projects;

    return $firstLevelProjects;
}
function getFirstLevelProjects(){
    return getProjects("first");
}

function getSecondLevelProjects()
{
    return getProjects("second");
}

?>
