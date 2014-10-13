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

$levelJson = $siteJson["projectSections"];
?>
<form name="ajaxform_delete" id="ajaxform_delete" action="<?php echo $basePath ?>source/panel/template/inc/delete_project.php"
      method="POST">
    <label for="p_level">Project level:</label>
    <select name="p_level" id="p_level">

        <?php foreach ($levelJson as $level) {
            $caption = $level["caption"];
            echo "<option value=\"$caption\">$caption</option>";
        } ?>
    </select><br/>


    <label for="p_name">Project name:</label>;
    <input type="text" name="p_name" id="p_name"/><br/>;
</form>
<button id="simple-post" onclick='submit($("#ajaxform_delete"))'>+Create</button>


