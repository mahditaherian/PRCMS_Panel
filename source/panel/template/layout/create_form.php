<div style="padding: 100px">


    Create new project: <br/>

    <form name="ajaxform" id="ajaxform" action="<?php echo $basePath ?>source/panel/template/inc/create_project.php" method="POST">

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


        <label for="p_coordinatex">
            Project coordination X:
        </label>
        <input type="text" name="p_coordinatex" id="p_coordinatex"/><br/>

        <label for="p_coordinatey">
            Project coordination Y:
        </label>
        <input type="text" name="p_coordinatey" id="p_coordinatey"/><br/>

        <label for="p_thumbnail">
            Thumbnail address:
        </label>
        <input type="text" name="p_thumbnail" id="p_thumbnail"/><br/>

        <div style="width: 500px; border: #0AF dashed thin; align-items: center; padding: 50px 50px ">
            <div id="mulitplefileuploader">Upload pictures</div>

            <div id="status"></div>
        </div>
        <input type="hidden" id="p_pictures" name="p_pictures"/>

    </form>
    <button id="simple-post" onclick='submit($("#ajaxform"))'>+Create</button>

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
