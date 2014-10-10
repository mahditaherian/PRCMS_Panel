<?php
/**
 * Created by PhpStorm.
 * User: Mahdi
 * Date: 10/2/14
 * Time: 11:51 PM
 */
/*
This is a new feature to upload all files in a directory to server. it needs HTML5 simple form as following:
<form method="post" enctype="multipart/form-data">
    <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">
    <input class="button" type="submit" value="Upload" />
</form>
 */


$count = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    foreach ($_FILES['files']['name'] as $i => $name) {
        if (strlen($_FILES['files']['name'][$i]) > 1) {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], 'upload/'.$name)) {
                $count++;
            }
        }
    }
}
