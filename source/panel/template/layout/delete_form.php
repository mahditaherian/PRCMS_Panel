<?php
//$rootPath = $_SERVER['DOCUMENT_ROOT'] . "/PRCMS_Panel/";
//$projectsAddress = 'projects/';
//$realPath = $rootPath . $projectsAddress;
//
//$path = $rootPath . "main.json";
//if (!file_exists($path)) {
//    echo "There is no any project json file.";
//    return;
//} else {
//    $string = file_get_contents($path);
//    $siteJson = json_decode($string, true);
//    //$siteFile = fopen($path, "w+") or die("Unable to open file!");
//}
//
//$levelJson = $siteJson["projectSections"];
//
?>
<?php $formID = "ajaxform_delete" ?>
<form name="<?php echo $formID ?>" id="<?php echo $formID ?>"
      action="<?php echo $basePath ?>source/panel/template/inc/delete_project.php"
      method="POST">
    <?php include "select_form.php" ?>
    <input type="submit" value="DELETE....Without ajax">
</form>
<button id="simple-post" onclick='submit($("#ajaxform_delete"))'>Delete</button>


