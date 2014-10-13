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
    <script src="<?php echo $basePath ?>source/panel/template/js/jquery-1.8.0.min.js"></script>
    <script src="<?php echo $basePath ?>source/panel/template/js/jquery.fileuploadmulti.min.js"></script>

</head>
<body>
<?php include "layout/header.php" ?>

<?php //include "layout/create_form.php" ?>
<?php include "layout/delete_form.php" ?>

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