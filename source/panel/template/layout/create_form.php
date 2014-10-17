<div >
    Create new project: <br/>
    <?php $formID = "updateform" ?>
    <form name="<?php echo $formID ?>" id="<?php echo $formID ?>"
          action="<?php echo $basePath ?>source/panel/template/inc/update_project.php"
          method="POST">
    <?php include "input_form.php" ?>
        </form>
    <button id="simple-post" onclick='submit($("#ajaxform"))'>+Create</button>
</div>
