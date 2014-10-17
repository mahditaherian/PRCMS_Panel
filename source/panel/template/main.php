<!DOCTYPE html>
<html>
<head>
    <title>How to Upload multiple images jQuery Ajax using PHP | PGPGang.com</title>
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
    <li><a href="#view3">Update Code</a></li>
</ul>
<div class="tabcontents">
    <div id="view1">
        <?php include "layout/create_form.php" ?>
    </div>
    <div id="view2">
        <?php include "layout/delete_form.php" ?>
    </div>
    <div id="view3">
        <?php //include "layout/update_form.php" ?>
    </div>
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