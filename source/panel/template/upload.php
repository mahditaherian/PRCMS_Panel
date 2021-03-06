<?php

$realOutput_dir = $_SERVER['DOCUMENT_ROOT'] . '/PRCMS_Panel/upload/';
//$output_dir = $_SERVER['REMOTE_HOST'] . '/PRCMS_Panel/upload/';
if (isset($_FILES["myfile"])) {
    $ret = array();

    $error = $_FILES["myfile"]["error"];
    {

        if (!is_array($_FILES["myfile"]['name'])) //single file
        {
            $RandomNum = time();

            $ImageName = str_replace(' ', '-', strtolower($_FILES['myfile']['name']));
            $ImageType = $_FILES['myfile']['type']; //"image/png", image/jpeg etc.

            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.', '', $ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName . '.' . $ImageExt;

            move_uploaded_file($_FILES["myfile"]["tmp_name"], $realOutput_dir . $NewImageName);
            $ret["fileName"] = $realOutput_dir . $NewImageName;
        } else {
            $fileCount = count($_FILES["myfile"]['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                $RandomNum = time();

                $ImageName = str_replace(' ', '-', strtolower($_FILES['myfile']['name'][$i]));
                $ImageType = $_FILES['myfile']['type'][$i]; //"image/png", image/jpeg etc.

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt = str_replace('.', '', $ImageExt);
                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName = $ImageName . '.' . $ImageExt;
                move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $realOutput_dir . $NewImageName);
                $ret["fileName"] = $realOutput_dir . $NewImageName;
            }
        }
    }
    echo json_encode($ret);

}