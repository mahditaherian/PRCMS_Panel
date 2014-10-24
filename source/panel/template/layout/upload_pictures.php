<div id="upload_container" style="border: #0AF dashed thin; align-items: center; padding: 5px 5px">
    <div id="mulitplefileuploader">Upload pictures</div>

    <div id="status"></div>
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