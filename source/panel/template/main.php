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
<!DOCTYPE html>
<html>
<head>
    <title>PR CMS Panel</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <style type="text/css">
        img {
            border-width: 0
        }

        * {
            font-family: 'Lucida Grande', sans-serif;
        }
    </style>
    <link href="<?php echo $basePath ?>source/panel/template/css/uploadfilemulti.css" rel="stylesheet">
    <link href="<?php echo $basePath ?>source/panel/template/css/tabcontent.css" rel="stylesheet">
    <script src="<?php echo $basePath ?>source/panel/template/js/jquery-1.8.0.min.js"></script>
    <script src="<?php echo $basePath ?>source/panel/template/js/jquery.fileuploadmulti.min.js"></script>
    <script src="<?php echo $basePath ?>source/panel/template/js/tabcontent.js"></script>

</head>
<body>
<?php include "layout/header.php" ?>

<?php include "layout/view_projects.php" ?>
<ul class="tabs">
    <li><a href="#view1">Create new project</a></li>
    <li><a href="#view2">Delete project</a></li>
    <li><a href="#view3">Update project</a></li>
</ul>
<div class="tabcontents">
    <div id="view1">
        <?php include "layout/create_form.php" ?>
    </div>
    <div id="view2">
        <?php include "layout/delete_form.php" ?>
    </div>
    <div id="view3">
        <?php include "layout/update_form.php" ?>
    </div>
    <?php include "layout/upload_pictures.php" ?>
</div>

<script>
    //    $("#simple-post").click(function () {
    function submit(form) {

        //var form = $("#ajaxform");
        form.submit(function (e) {

            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            $.ajax(
                {
                    url: formURL,
                    type: "POST",
                    data: postData,
                    success: function (data, textStatus, jqXHR) {
                        alert("Success")
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert("Failure")
                    }
                });
            e.preventDefault(); //STOP default action
            e.unbind(); //unbind. to stop multiple form submit.
        });
        form.submit(); //SUBMIT FORM
    }
</script>
<?php include "layout/footer.php" ?>
</body>
</html>