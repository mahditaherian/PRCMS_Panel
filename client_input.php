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
//    $firstLevelProjects['caption'] = "first level projects";
//    $projects = array();
//    for ($i = 0; $i < 2; $i++) {
//        $projects[$i] = array(
//            "name" => "name$i",
//            "address" => "address$i",
//            "thumbnail" => "media/projects/p$i/tmb.jpg",
//            "imageGallery" => array(
//                array(
//                    "address" => "i_address$i" . "_1.jpg",
//                    "caption" => "i_caption$i" . "_1",
//                ),
//                array(
//                    "address" => "i_address$i" . "_2.jpg",
//                    "caption" => "i_caption$i" . "_2",
//                ),
//            )
//        );
//    }
//    $firstLevelProjects['projects'] = $projects;
}

function getSecondLevelProjects()
{
    return getProjects("second");
//    $secondLevelProjects = array();
//    $secondLevelProjects['caption'] = "second level projects";
//    $projects = array();
//    for ($i = 0; $i < 2; $i++) {
//        $projects[$i] = array(
//            "name" => "name$i",
//            "address" => "address$i",
//            "thumbnail" => "media/projects/p$i/tmb.jpg",
//            "imageGallery" => array(
//                array(
//                    "address" => "i_address$i" . "_1.jpg",
//                    "caption" => "i_caption$i" . "_1",
//                ),
//                array(
//                    "address" => "i_address$i" . "_2.jpg",
//                    "caption" => "i_caption$i" . "_2",
//                ),
//            )
//        );
//    }
//    $secondLevelProjects['projects'] = $projects;
//    return $secondLevelProjects;
}

//$result = array(
//    "homeCarousel" => array(
//        array(
//            "name" => "media/home-carousel/slide1.jpg",
//            "index" => 0,
//            "active" => true
//        ),
//        array(
//            "name" => "media/home-carousel/slide2.jpg",
//            "index" => 1,
//            "active" => false
//        ),
//        array(
//            "name" => "media/home-carousel/slide3.jpg",
//            "index" => 2,
//            "active" => false
//        ),
//        array(
//            "name" => "media/home-carousel/slide3.jpg",
//            "index" => 3,
//            "active" => false
//        ),
//    ),
//    "projectSections" => array(
//        array(
//            "caption" => "first level projects",
//            "projects" => array(
//                array(
//                    "name" => "name1",
//                    "address" => "address1",
//                    "thumbnail" => "media/projects/p1/tmb.jpg",
//                    "imageGallery" => array(
//                        array(
//                            "address" => "i_address1.jpg",
//                            "caption" => "i_caption1",
//                        ),
//                        array(
//                            "address" => "i_address2.jpg",
//                            "caption" => "i_caption2",
//                        ),
//                    )
//                ),
//                array(
//                    "name" => "name2",
//                    "address" => "address2",
//                    "thumbnail" => "media/projects/p2/tmb.jpg",
//                    "imageGallery" => array(
//                        array(
//                            "address" => "i_address2_1.jpg",
//                            "caption" => "i_caption2_1",
//                        ),
//                        array(
//                            "address" => "i_address2_2.jpg",
//                            "caption" => "i_caption2_2",
//                        ),
//                    )
//                ),
//
//            ),
//        ),
//        array(
//            "caption" => "second level projects",
//            "projects" => array(
//                array(
//                    "name" => "name1",
//                    "address" => "address1",
//                    "thumbnail" => "media/projects/p1/tmb.jpg",
//                    "imageGallery" => array(
//                        array(
//                            "address" => "i_address1.jpg",
//                            "caption" => "i_caption1",
//                        ),
//                        array(
//                            "address" => "i_address2.jpg",
//                            "caption" => "i_caption2",
//                        ),
//                    )
//                ),
//                array(
//                    "name" => "name2",
//                    "address" => "address2",
//                    "thumbnail" => "media/projects/p2/tmb.jpg",
//                    "imageGallery" => array(
//                        array(
//                            "address" => "i_address2_1.jpg",
//                            "caption" => "i_caption2_1",
//                        ),
//                        array(
//                            "address" => "i_address2_2.jpg",
//                            "caption" => "i_caption2_2",
//                        ),
//                    )
//                ),
//
//            ),
//        ),
//    ),
//
//
//);
?>
