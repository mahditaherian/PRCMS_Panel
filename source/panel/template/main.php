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
    <!--    <script>
        //    var data = {'bob':'foo','paul':'dog'};
        function sendXML() {
            var data = {
                'level': $("#p_level").val(),
                'name': $("#p_name").val(),
                'detail': $("#p_detail").val(),
                'sample': "sampleeeeee"
            };
            var path = "<?php echo $basePath ?>source/panel/template/xmlize.php";
            $.ajax({
                url: path,
                type: 'POST',
                contentType: 'application/json',
                data: /*data,//*/JSON.stringify(data),
                dataType: 'json'
            });
        }
    </script>-->

</head>
<body>
<?php include "layout/header.php" ?>
<div style="padding: 100px">


    Create new project: <br/>

    <form name="ajaxform" id="ajaxform" action="<?php echo $basePath ?>source/panel/template/xmlize.php" method="POST">

        <label for="p_name">
            Project name:
        </label>
        <input type="text" name="p_name" id="p_name"/><br/>

        <label for="p_level">Project level:</label>
        <select name="p_level" id="p_level">
            <option value="first">First level project</option>
            <option value="second">Second level project</option>
        </select><br/>

        <label for="p_detail">
            Project detail:
        </label>
        <textarea rows="4" cols="50" name="p_detail" id="p_detail"></textarea><br/>

        <div style="width: 500px; border: #0AF dashed thin; align-items: center; padding: 50px 50px ">
            <div id="mulitplefileuploader">Upload pictures</div>

            <div id="status"></div>
        </div>
        <input type="hidden" id="p_pictures" name="p_pictures"/>

    </form>
    <button id="simple-post" onclick="submit()">+Create</button>

</div>
<script>
    //////////////////////////FILE UPLOADER SCRIPT///////////////////////////////////////
    $(document).ready(function () {
        var path = "<?php echo $basePath ?>source/panel/template/";
        var settings = {
            url: path + "upload.php",
            method: "POST",
            allowedTypes: "jpg,png,gif",
            fileName: "myfile",
            multiple: true,
            onSuccess: function (files, data, xhr) {
                $("#status").html("<font color='>Upload is success</font>");
                var p_pictures = $("#p_pictures");
//                alert(JSON.parse(data).fileName);
                p_pictures.val(p_pictures.val() + ";" + JSON.parse(data).fileName);
            },
            afterUploadAll: function () {
                alert("all images uploaded!!");
            },
            onError: function (files, status, errMsg) {
                $("#status").html("<font color='red'>Upload is Failed</font>");
            }
        };
        $("#mulitplefileuploader").uploadFile(settings);

    });
    //END FILE UPLOADER
</script>
<script>
    //    $("#simple-post").click(function () {
    function submit() {
        var form = $("#ajaxform");
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